@php
use Spatie\LaravelSettings\Exceptions\MissingSettings;

try {
    $generalSettings = app(\App\Settings\GeneralSettings::class);
} catch (MissingSettings $e) {
    // Settings not configured yet, use defaults
    $generalSettings = null;
}
@endphp

<!DOCTYPE html>
<html lang="tr">
<head>
    <!-- Console Override - Load Very First -->
    <script>
    // Completely disable console and browser messaging
    (function() {
        // Override all console methods to be silent
        if (window.console) {
            console.log = function() {};
            console.warn = function() {};
            console.error = function() {};
            console.info = function() {};
            console.debug = function() {};
            console.trace = function() {};
            console.group = function() {};
            console.groupEnd = function() {};
            console.groupCollapsed = function() {};
            console.assert = function() {};
            console.count = function() {};
            console.countReset = function() {};
            console.clear = function() {};
            console.table = function() {};
            console.time = function() {};
            console.timeEnd = function() {};
            console.timeLog = function() {};
            console.dir = function() {};
            console.dirxml = function() {};
            console.profile = function() {};
            console.profileEnd = function() {};
        }

        // Disable browser console completely
        if (window.chrome && window.chrome.runtime && window.chrome.runtime.onConnect) {
            // Chrome extension console
            window.chrome.runtime.onConnect = function() {};
        }

        // Override browser error reporting
        window.onerror = function() { return true; };
        window.addEventListener('error', function(e) { e.preventDefault(); return true; });
        window.addEventListener('unhandledrejection', function(e) { e.preventDefault(); return true; });

        // Override network error logging
        const originalFetch = window.fetch;
        window.fetch = function() {
            return originalFetch.apply(this, arguments).catch(function(error) {
                // Silent error handling
                return Promise.reject(error);
            });
        };

        // Disable browser developer tools console
        if (window.DevToolsAPI) {
            window.DevToolsAPI = undefined;
        }

        // Override browser's internal console
        if (window.console && window.console._commandLineAPI) {
            window.console._commandLineAPI = undefined;
        }

        // Disable browser's internal error reporting
        if (window.chrome && window.chrome.runtime) {
            window.chrome.runtime.onMessage = function() {};
        }

        // Override browser's internal logging
        if (window.performance && window.performance.mark) {
            const originalMark = window.performance.mark;
            window.performance.mark = function() {};
        }

        // Disable browser's internal error tracking
        if (window.reportError) {
            window.reportError = function() {};
        }

        // Override browser's internal console API
        if (window.console && window.console._commandLineAPI) {
            window.console._commandLineAPI = undefined;
        }

        // Disable browser's internal error reporting
        if (window.chrome && window.chrome.runtime && window.chrome.runtime.onMessage) {
            window.chrome.runtime.onMessage = function() {};
        }
    })();
    </script>

    <x-seo::meta />
    <meta charset="utf-8">
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('storage/'.$generalSettings->favicon) }}">

    @stack('metas')

    @yield('head')

    @stack('styles')

    @livewireStyles
    @vite('resources/js/app.js')

    {!! $header_codes !!}
    <style>
        {!! $styles !!}
    </style>
</head>

<body class="@yield('bodyClass')">
<x-popup />
    @if(optional($generalSettings)->show_cookie_consent_banner)
        @include('cookie-consent::index')
    @endif

    @yield('body')

    @livewireScriptConfig
    {!! $scripts !!}
    @stack('scripts')
</body>
</html>
