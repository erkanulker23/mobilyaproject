<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'user_id',
        'data',
        'ip_address',
        'user_agent',
        'is_read',
        'notes',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDataAttribute(): array
    {
        $formatted = [];
        $fields = $this->form->fields;

        foreach ($this->data as $key => $value) {
            $field = $fields->firstWhere('name', $key);

            if ($field) {
                $formatted[] = [
                    'label' => $field->label,
                    'value' => $value,
                    'type' => $field->type,
                ];
            }
        }

        return $formatted;
    }
}

