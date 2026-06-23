<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $form->title }} - {{ config('app.name') }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            line-height: 1.6;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 40px;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .form-description {
            font-size: 16px;
            color: #666;
        }

        .form-field {
            margin-bottom: 24px;
        }

        .form-field.width-half {
            display: inline-block;
            width: calc(50% - 12px);
            margin-right: 12px;
        }

        .form-field.width-third {
            display: inline-block;
            width: calc(33.333% - 16px);
            margin-right: 12px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        label.required::after {
            content: ' *';
            color: #e53e3e;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="tel"],
        input[type="url"],
        input[type="date"],
        input[type="time"],
        input[type="datetime-local"],
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .help-text {
            font-size: 13px;
            color: #718096;
            margin-top: 6px;
        }

        .radio-group,
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .radio-item,
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .heading {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 30px 0 20px;
        }

        .heading.h1 { font-size: 32px; }
        .heading.h2 { font-size: 28px; }
        .heading.h3 { font-size: 24px; }
        .heading.h4 { font-size: 20px; }
        .heading.h5 { font-size: 18px; }
        .heading.h6 { font-size: 16px; }

        .paragraph {
            color: #4a5568;
            margin-bottom: 20px;
        }

        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 30px 0;
        }

        .rating {
            display: flex;
            gap: 10px;
        }

        .rating input[type="radio"] {
            display: none;
        }

        .rating label {
            cursor: pointer;
            font-size: 32px;
            color: #cbd5e0;
            transition: color 0.2s;
        }

        .rating input[type="radio"]:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #fbbf24;
        }

        .submit-button {
            background: #4299e1;
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .submit-button:hover {
            background: #3182ce;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
        }

        .submit-button:disabled {
            background: #a0aec0;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #fc8181;
        }

        .error-message {
            color: #e53e3e;
            font-size: 13px;
            margin-top: 6px;
        }

        {{ $form->custom_css }}
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1 class="form-title">{{ $form->title }}</h1>
            @if($form->description)
                <p class="form-description">{{ $form->description }}</p>
            @endif
        </div>

        <div id="alert-container"></div>

        <form id="custom-form" method="POST" action="{{ route('forms.submit', $form->slug) }}" enctype="multipart/form-data">
            @csrf

            @foreach($form->fields->sortBy('order') as $field)
                @php
                    $widthClass = '';
                    if ($field->width === 'half') $widthClass = 'width-half';
                    if ($field->width === 'third') $widthClass = 'width-third';
                @endphp

                @if($field->type === 'heading')
                    <div class="heading {{ $field->settings['heading_level'] ?? 'h3' }}">
                        {{ $field->label }}
                    </div>
                @elseif($field->type === 'paragraph')
                    <div class="paragraph">
                        {{ $field->help_text }}
                    </div>
                @elseif($field->type === 'divider')
                    <div class="divider"></div>
                @elseif($field->type === 'html')
                    <div class="html-content">
                        {!! $field->settings['html_content'] ?? '' !!}
                    </div>
                @else
                    <div class="form-field {{ $widthClass }}" data-field-name="{{ $field->name }}">
                        @if(!in_array($field->type, ['checkbox_single', 'hidden']))
                            <label for="{{ $field->name }}" class="{{ $field->required ? 'required' : '' }}">
                                {{ $field->label }}
                            </label>
                        @endif

                        @if($field->type === 'text')
                            <input type="text"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   placeholder="{{ $field->placeholder }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'textarea')
                            <textarea id="{{ $field->name }}"
                                      name="{{ $field->name }}"
                                      rows="4"
                                      placeholder="{{ $field->placeholder }}"
                                      {{ $field->required ? 'required' : '' }}>{{ $field->default_value }}</textarea>

                        @elseif($field->type === 'email')
                            <input type="email"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   placeholder="{{ $field->placeholder }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'number')
                            <input type="number"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   placeholder="{{ $field->placeholder }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'phone')
                            <input type="tel"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   placeholder="{{ $field->placeholder }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'url')
                            <input type="url"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   placeholder="{{ $field->placeholder }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'date')
                            <input type="date"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'time')
                            <input type="time"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'datetime')
                            <input type="datetime-local"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   value="{{ $field->default_value }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'select')
                            <select id="{{ $field->name }}"
                                    name="{{ $field->name }}"
                                    {{ $field->required ? 'required' : '' }}>
                                <option value="">{{ $field->placeholder ?: 'Seçiniz' }}</option>
                                @if($field->options)
                                    @foreach($field->options as $value => $label)
                                        <option value="{{ $value }}" {{ $field->default_value == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                        @elseif($field->type === 'radio')
                            <div class="radio-group">
                                @if($field->options)
                                    @foreach($field->options as $value => $label)
                                        <div class="radio-item">
                                            <input type="radio"
                                                   id="{{ $field->name }}_{{ $loop->index }}"
                                                   name="{{ $field->name }}"
                                                   value="{{ $value }}"
                                                   {{ $field->default_value == $value ? 'checked' : '' }}
                                                   {{ $field->required ? 'required' : '' }}>
                                            <label for="{{ $field->name }}_{{ $loop->index }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        @elseif($field->type === 'checkbox')
                            <div class="checkbox-group">
                                @if($field->options)
                                    @foreach($field->options as $value => $label)
                                        <div class="checkbox-item">
                                            <input type="checkbox"
                                                   id="{{ $field->name }}_{{ $loop->index }}"
                                                   name="{{ $field->name }}[]"
                                                   value="{{ $value }}">
                                            <label for="{{ $field->name }}_{{ $loop->index }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        @elseif($field->type === 'checkbox_single')
                            <div class="checkbox-item">
                                <input type="checkbox"
                                       id="{{ $field->name }}"
                                       name="{{ $field->name }}"
                                       value="1"
                                       {{ $field->required ? 'required' : '' }}>
                                <label for="{{ $field->name }}" class="{{ $field->required ? 'required' : '' }}">
                                    {{ $field->label }}
                                </label>
                            </div>

                        @elseif(in_array($field->type, ['file', 'image']))
                            <input type="file"
                                   id="{{ $field->name }}"
                                   name="{{ $field->name }}"
                                   accept="{{ $field->settings['accept'] ?? '' }}"
                                   {{ $field->required ? 'required' : '' }}>

                        @elseif($field->type === 'rating')
                            <div class="rating">
                                @for($i = ($field->settings['max'] ?? 5); $i >= ($field->settings['min'] ?? 1); $i--)
                                    <input type="radio"
                                           id="{{ $field->name }}_{{ $i }}"
                                           name="{{ $field->name }}"
                                           value="{{ $i }}"
                                           {{ $field->required ? 'required' : '' }}>
                                    <label for="{{ $field->name }}_{{ $i }}">★</label>
                                @endfor
                            </div>

                        @elseif($field->type === 'hidden')
                            <input type="hidden"
                                   name="{{ $field->name }}"
                                   value="{{ $field->default_value }}">
                        @endif

                        @if($field->help_text && !in_array($field->type, ['paragraph']))
                            <div class="help-text">{{ $field->help_text }}</div>
                        @endif

                        <div class="error-message" id="error-{{ $field->name }}"></div>
                    </div>
                @endif
            @endforeach

            <button type="submit" class="submit-button" id="submit-btn">
                {{ $form->submit_button_text }}
            </button>
        </form>
    </div>

    <script>
        document.getElementById('custom-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = document.getElementById('submit-btn');
            const alertContainer = document.getElementById('alert-container');

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            alertContainer.innerHTML = '';

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Gönderiliyor...';

            try {
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    alertContainer.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    form.reset();

                    if (data.redirect_url) {
                        setTimeout(() => {
                            window.location.href = data.redirect_url;
                        }, 2000);
                    }
                } else {
                    if (data.errors) {
                        for (const [field, messages] of Object.entries(data.errors)) {
                            const errorEl = document.getElementById('error-' + field);
                            if (errorEl) {
                                errorEl.textContent = messages[0];
                            }
                        }
                    }

                    alertContainer.innerHTML = `<div class="alert alert-error">${data.error || 'Lütfen formu kontrol edin.'}</div>`;
                }
            } catch (error) {
                // Error occurred
                alertContainer.innerHTML = `<div class="alert alert-error">Bir hata oluştu. Lütfen tekrar deneyin.</div>`;
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = '{{ $form->submit_button_text }}';
            }
        });

        {{ $form->custom_js }}
    </script>
</body>
</html>

