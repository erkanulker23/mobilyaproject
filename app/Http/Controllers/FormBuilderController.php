<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FormBuilderController extends Controller
{
    public function index()
    {
        return view('forms.builder');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'fields' => 'required|array|min:1',
        ], [
            'name.required' => 'Form adı zorunludur.',
            'title.required' => 'Form başlığı zorunludur.',
            'fields.required' => 'En az bir alan eklemelisiniz.',
            'fields.min' => 'En az bir alan eklemelisiniz.',
        ]);

        try {
            DB::beginTransaction();

            // Create form
            $form = Form::create([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->name),
                'submit_button_text' => $request->submit_button_text ?? 'Gönder',
                'success_message' => $request->success_message ?? 'Formunuz başarıyla gönderildi. Teşekkür ederiz!',
                'is_active' => true,
                'save_submissions' => true,
                'allow_multiple_submissions' => true,
                'require_login' => false,
            ]);

            // Create form fields
            foreach ($request->fields as $index => $fieldData) {
                FormField::create([
                    'form_id' => $form->id,
                    'type' => $fieldData['type'],
                    'name' => $fieldData['name'],
                    'label' => $fieldData['label'],
                    'placeholder' => $fieldData['placeholder'] ?? '',
                    'help_text' => $fieldData['help_text'] ?? '',
                    'required' => $fieldData['required'] ?? false,
                    'order' => $index,
                    'width' => $fieldData['width'] ?? 'full',
                    'options' => $fieldData['options'] ?? [],
                    'validation_rules' => $fieldData['validation_rules'] ?? [],
                    'conditional_logic' => $fieldData['conditional_logic'] ?? [],
                    'settings' => $fieldData['settings'] ?? [],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Form başarıyla kaydedildi',
                'form' => [
                    'id' => $form->id,
                    'slug' => $form->slug,
                    'url' => route('forms.show', $form->slug),
                    'admin_url' => route('filament.admin.resources.forms.edit', $form->id),
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Form kaydedilirken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function load($id)
    {
        $form = Form::with('fields')->findOrFail($id);

        $formData = [
            'id' => $form->id,
            'name' => $form->name,
            'title' => $form->title,
            'description' => $form->description,
            'submit_button_text' => $form->submit_button_text,
            'success_message' => $form->success_message,
            'fields' => $form->fields->map(function ($field) {
                return [
                    'id' => 'field_' . $field->id,
                    'type' => $field->type,
                    'name' => $field->name,
                    'label' => $field->label,
                    'placeholder' => $field->placeholder,
                    'help_text' => $field->help_text,
                    'required' => $field->required,
                    'width' => $field->width,
                    'options' => $field->options,
                    'validation_rules' => $field->validation_rules,
                    'conditional_logic' => $field->conditional_logic,
                    'settings' => $field->settings,
                ];
            })->toArray()
        ];

        return response()->json($formData);
    }

    public function duplicate($id)
    {
        $originalForm = Form::with('fields')->findOrFail($id);

        try {
            DB::beginTransaction();

            // Create new form
            $newForm = $originalForm->replicate();
            $newForm->name = $originalForm->name . ' (Kopya)';
            $newForm->slug = Str::slug($newForm->name);
            $newForm->save();

            // Duplicate fields
            foreach ($originalForm->fields as $field) {
                $newField = $field->replicate();
                $newField->form_id = $newForm->id;
                $newField->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Form başarıyla kopyalandı',
                'form' => [
                    'id' => $newForm->id,
                    'slug' => $newForm->slug,
                    'url' => route('forms.show', $newForm->slug),
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Form kopyalanırken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export($id)
    {
        $form = Form::with('fields')->findOrFail($id);

        $exportData = [
            'form' => [
                'name' => $form->name,
                'title' => $form->title,
                'description' => $form->description,
                'submit_button_text' => $form->submit_button_text,
                'success_message' => $form->success_message,
                'settings' => $form->settings,
            ],
            'fields' => $form->fields->map(function ($field) {
                return [
                    'type' => $field->type,
                    'name' => $field->name,
                    'label' => $field->label,
                    'placeholder' => $field->placeholder,
                    'help_text' => $field->help_text,
                    'required' => $field->required,
                    'width' => $field->width,
                    'options' => $field->options,
                    'validation_rules' => $field->validation_rules,
                    'conditional_logic' => $field->conditional_logic,
                    'settings' => $field->settings,
                ];
            })->toArray()
        ];

        return response()->json($exportData);
    }

    public function import(Request $request)
    {
        $request->validate([
            'form_data' => 'required|array',
            'form_data.form' => 'required|array',
            'form_data.fields' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            $formData = $request->form_data['form'];
            $fieldsData = $request->form_data['fields'];

            // Create form
            $form = Form::create([
                'name' => $formData['name'],
                'title' => $formData['title'],
                'description' => $formData['description'] ?? '',
                'slug' => Str::slug($formData['name']),
                'submit_button_text' => $formData['submit_button_text'] ?? 'Gönder',
                'success_message' => $formData['success_message'] ?? 'Formunuz başarıyla gönderildi. Teşekkür ederiz!',
                'is_active' => true,
                'save_submissions' => true,
                'allow_multiple_submissions' => true,
                'require_login' => false,
                'settings' => $formData['settings'] ?? [],
            ]);

            // Create form fields
            foreach ($fieldsData as $index => $fieldData) {
                FormField::create([
                    'form_id' => $form->id,
                    'type' => $fieldData['type'],
                    'name' => $fieldData['name'],
                    'label' => $fieldData['label'],
                    'placeholder' => $fieldData['placeholder'] ?? '',
                    'help_text' => $fieldData['help_text'] ?? '',
                    'required' => $fieldData['required'] ?? false,
                    'order' => $index,
                    'width' => $fieldData['width'] ?? 'full',
                    'options' => $fieldData['options'] ?? [],
                    'validation_rules' => $fieldData['validation_rules'] ?? [],
                    'conditional_logic' => $fieldData['conditional_logic'] ?? [],
                    'settings' => $fieldData['settings'] ?? [],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Form başarıyla içe aktarıldı',
                'form' => [
                    'id' => $form->id,
                    'slug' => $form->slug,
                    'url' => route('forms.show', $form->slug),
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Form içe aktarılırken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }
}
