<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use App\Notifications\FormSubmissionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function show($slug)
    {
        $form = Form::where('slug', $slug)
            ->where('is_active', true)
            ->with('fields')
            ->firstOrFail();

        // Giriş kontrolü
        if ($form->require_login && !auth()->check()) {
            return redirect()->route('login')->with('error', 'Bu formu doldurmak için giriş yapmalısınız.');
        }

        // Çoklu gönderim kontrolü
        if (!$form->allow_multiple_submissions && auth()->check()) {
            $existingSubmission = FormSubmission::where('form_id', $form->id)
                ->where('user_id', auth()->id())
                ->exists();

            if ($existingSubmission) {
                return view('forms.already-submitted', compact('form'));
            }
        }

        return view('forms.show', compact('form'));
    }

    public function submit(Request $request, $slug)
    {
        $form = Form::where('slug', $slug)
            ->where('is_active', true)
            ->with('fields')
            ->firstOrFail();

        // Giriş kontrolü
        if ($form->require_login && !auth()->check()) {
            return response()->json(['error' => 'Giriş yapmalısınız'], 401);
        }

        // Çoklu gönderim kontrolü
        if (!$form->allow_multiple_submissions && auth()->check()) {
            $existingSubmission = FormSubmission::where('form_id', $form->id)
                ->where('user_id', auth()->id())
                ->exists();

            if ($existingSubmission) {
                return response()->json(['error' => 'Bu formu zaten gönderdiniz'], 422);
            }
        }

        // Validation rules oluştur
        $rules = [];
        $messages = [];

        foreach ($form->fields as $field) {
            if (in_array($field->type, ['heading', 'paragraph', 'divider', 'html'])) {
                continue;
            }

            $fieldRules = [];

            if ($field->required) {
                $fieldRules[] = 'required';
            }

            // Tip bazlı validation
            switch ($field->type) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'url':
                    $fieldRules[] = 'url';
                    break;
                case 'file':
                case 'image':
                    $fieldRules[] = 'file';
                    if (isset($field->settings['max_size'])) {
                        $fieldRules[] = 'max:' . ($field->settings['max_size'] * 1024);
                    }
                    break;
            }

            // Custom validation rules
            if ($field->validation_rules) {
                $fieldRules = array_merge($fieldRules, $field->validation_rules);
            }

            if (!empty($fieldRules)) {
                $rules[$field->name] = $fieldRules;
            }

            $messages[$field->name . '.required'] = $field->label . ' alanı zorunludur.';
        }

        // Validate
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Dosya yüklemeleri
        $submissionData = [];

        foreach ($form->fields as $field) {
            if (in_array($field->type, ['heading', 'paragraph', 'divider', 'html'])) {
                continue;
            }

            if (in_array($field->type, ['file', 'image']) && $request->hasFile($field->name)) {
                $file = $request->file($field->name);
                $path = $file->store('form-submissions/' . $form->id, 'public');
                $submissionData[$field->name] = $path;
            } else {
                $submissionData[$field->name] = $request->input($field->name);
            }
        }

        // Gönderiyi kaydet
        if ($form->save_submissions) {
            $submission = FormSubmission::create([
                'form_id' => $form->id,
                'user_id' => auth()->id(),
                'data' => $submissionData,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // E-posta bildirimi gönder
            if ($form->send_email_notification && $form->notification_email) {
                try {
                    Notification::route('mail', $form->notification_email)
                        ->notify(new FormSubmissionNotification($form, $submission));
                } catch (\Exception $e) {
                    \Log::error('Form notification error: ' . $e->getMessage());
                }
            }
        }

        // Response
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $form->success_message,
                'redirect_url' => $form->redirect_url,
            ]);
        }

        if ($form->redirect_url) {
            return redirect($form->redirect_url)->with('success', $form->success_message);
        }

        return back()->with('success', $form->success_message);
    }

    public function embed($id)
    {
        $form = Form::where('id', $id)
            ->where('is_active', true)
            ->with('fields')
            ->firstOrFail();

        return view('forms.embed', compact('form'));
    }
}

