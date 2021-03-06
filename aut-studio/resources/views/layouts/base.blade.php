<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <title>AUT Studio</title>
    <meta name="description" content="Amirkabir Game Studio">

    <link rel="icon" href="images/favicon.ico">

    <script>
        // Setup Polymer options
        window.Polymer = {
            dom: 'shadow',
            lazyRegister: true,
        };

        // Load webcomponentsjs polyfill if browser does not support native
        // Web Components
        (function () {
            'use strict';

            var onload = function () {
                // For native Imports, manually fire WebComponentsReady so user code
                // can use the same code path for native and polyfill'd imports.
                if (!window.HTMLImports) {
                    document.dispatchEvent(
                            new CustomEvent('WebComponentsReady', {bubbles: true})
                    );
                }
            };

            var webComponentsSupported = (
                    'registerElement' in document
                    && 'import' in document.createElement('link')
                    && 'content' in document.createElement('template')
            );

            if (!webComponentsSupported) {
                var script = document.createElement('script');
                script.async = true;
                script.src = 'bower_components/webcomponentsjs/webcomponents-lite.min.js';
                script.onload = onload;
                document.head.appendChild(script);
            } else {
                onload();
            }
        })();

        // Load pre-caching Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('service-worker.js');
            });
        }
    </script>

    {{--<link rel="import" href="elements/shared-styles.html">--}}
    <link rel="stylesheet" href="elements/shared_styles.css">
    @yield('element-import')
</head>
<body>
@yield('content')
</body>
</html>
