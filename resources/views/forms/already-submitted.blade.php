<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .message-container {
            max-width: 600px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 60px 40px;
            text-align: center;
        }

        .icon {
            width: 80px;
            height: 80px;
            background: #e3f2fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 40px;
        }

        h1 {
            font-size: 24px;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background: #4299e1;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: #3182ce;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="message-container">
        <div class="icon">✓</div>
        <h1>Bu formu zaten gönderdiniz</h1>
        <p>{{ $form->title }} formunu daha önce doldurmuşsunuz. Aynı form için birden fazla gönderime izin verilmemektedir.</p>
        <a href="{{ url('/') }}" class="back-button">Ana Sayfaya Dön</a>
    </div>
</body>
</html>

