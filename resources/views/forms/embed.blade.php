<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }

        .form-header {
            margin-bottom: 20px;
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .form-description {
            font-size: 14px;
            color: #666;
        }

        .form-field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
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
            padding: 10px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4299e1;
        }

        .submit-button {
            background: #4299e1;
            color: white;
            padding: 12px 28px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
        }

        .submit-button:hover {
            background: #3182ce;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-success {
            background: #c6f6d5;
            color: #22543d;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
        }

        {{ $form->custom_css }}
    </style>
</head>
<body>
    <div class="form-header">
        <h2 class="form-title">{{ $form->title }}</h2>
        @if($form->description)
            <p class="form-description">{{ $form->description }}</p>
        @endif
    </div>

    <div id="alert-container"></div>

    <form id="embed-form" method="POST" action="{{ route('forms.submit', $form->slug) }}" enctype="multipart/form-data">
        @csrf

        @foreach($form->fields->sortBy('order') as $field)
            @if(!in_array($field->type, ['heading', 'paragraph', 'divider', 'html', 'hidden']))
                <div class="form-field">
                    <label for="{{ $field->name }}" class="{{ $field->required ? 'required' : '' }}">
                        {{ $field->label }}
                    </label>

                    @if($field->type === 'textarea')
                        <textarea id="{{ $field->name }}"
                                  name="{{ $field->name }}"
                                  rows="3"
                                  placeholder="{{ $field->placeholder }}"
                                  {{ $field->required ? 'required' : '' }}></textarea>
                    @elseif($field->type === 'select')
                        <select id="{{ $field->name }}"
                                name="{{ $field->name }}"
                                {{ $field->required ? 'required' : '' }}>
                            <option value="">Seçiniz</option>
                            @if($field->options)
                                @foreach($field->options as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            @endif
                        </select>
                    @else
                        <input type="{{ $field->type }}"
                               id="{{ $field->name }}"
                               name="{{ $field->name }}"
                               placeholder="{{ $field->placeholder }}"
                               {{ $field->required ? 'required' : '' }}>
                    @endif
                </div>
            @endif
        @endforeach

        <button type="submit" class="submit-button" id="submit-btn">
            {{ $form->submit_button_text }}
        </button>
    </form>

    <script>
        document.getElementById('embed-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = document.getElementById('submit-btn');
            const alertContainer = document.getElementById('alert-container');

            alertContainer.innerHTML = '';
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
                } else {
                    alertContainer.innerHTML = `<div class="alert alert-error">${data.error || 'Hata oluştu'}</div>`;
                }
            } catch (error) {
                alertContainer.innerHTML = `<div class="alert alert-error">Bir hata oluştu</div>`;
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = '{{ $form->submit_button_text }}';
            }
        });

        {{ $form->custom_js }}
    </script>
</body>
</html>

