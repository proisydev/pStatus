<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>@yield('title', 'Undefined') — {{ config('app.name') }}</title>
    <meta name="title" content="@yield('title', 'Undefined') — {{ config('app.name') }}" />
    <meta property="og:title" content="@yield('title', 'Undefined') — {{ config('app.name') }}" />
    <meta property="twitter:title" content="@yield('title', 'Undefined') — {{ config('app.name') }}" />
    <meta name="description" content="@yield('description', 'Description undefined')">
    <meta property="og:description" content="@yield('description', 'Description undefined')" />
    <meta property="twitter:description" content="@yield('description', 'Description undefined')" />

    <meta property="twitter:url" content="{{ config('app.url') . parse_url(url()->current(), PHP_URL_PATH) }}" />
    <meta property="og:url" content="{{ config('app.url') . parse_url(url()->current(), PHP_URL_PATH) }}" />
    <link rel="canonical" href="{{ config('app.url') . parse_url(url()->current(), PHP_URL_PATH) }}">
    <meta property="og:type" content="website" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="og:image"
        content="https://proisy.dev/api/image-open-graph?title=@yield('title', 'Undefined')&page={{ config('app.url') . parse_url(url()->current(), PHP_URL_PATH) }}" />
    <meta property="twitter:image"
        content="https://proisy.dev/api/image-open-graph?title=@yield('title', 'Undefined')&page={{ config('app.url') . parse_url(url()->current(), PHP_URL_PATH) }}" />


    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="pStatus" />
    <link rel="manifest" href="/favicon/site.webmanifest" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">
    <header class="border-b border-gray-800">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <a href="{{ config('app.url') }}/status" rel="noopener"
                        title="{{ config('app.name') }} Status Page" class="flex items-center space-x-2">
                        <img src="{{ asset('icon.png') }}" alt="{{ config('app.name') }} Logo"
                            class="h-8 w-8 rounded-full" draggable="false" />
                        <span class="text-xl font-bold">{{ config('app.name') }}</span>
                    </a>
                </div>
                <nav>
                    <ul class="flex space-x-6">
                        <li>
                            <a href="{{ config('app.url') }}/status"
                                class="{{ request()->is('status') ? 'text-violet-400 hover:text-violet-300' : 'text-gray-400 hover:text-gray-300' }}"
                                title="Status" rel="noopener">Status</a>
                        </li>
                        <li>
                            <span
                                class="{{ request()->is('monitor/*') ? 'text-violet-400 hover:text-violet-300' : 'text-gray-400 hover:text-gray-300' }}">
                                Monitor
                            </span>
                        </li>
                        <!--<li>
                            <a href="{{ config('app.url') }}/incidents"
                               class="{{ request()->is('incidents') ? 'text-violet-400 hover:text-violet-300' : 'text-gray-400 hover:text-gray-300' }}"
                               title="Incidents" rel="noopener">Incidents</a>
                        </li>-->
                        <li>
                            <a href="https://docs.{{ parse_url(config('app.url'), PHP_URL_HOST) }}"
                                class="text-gray-400 hover:text-gray-300" title="{{ config('app.name') }}'s API"
                                target="_blank" rel="noopener">API</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center space-x-2">
                        <div class=" flex items-center justify-center">
                            <img src="{{ asset('icon.png') }}" alt="{{ config('app.name') }} Logo"
                                class="h-6 w-6 rounded-full" draggable="false" />
                        </div>
                        <span class="font-bold">{{ config('app.name') }}</span>
                    </div>
                </div>
                <div class="flex space-x-6 text-sm text-gray-400">
                    <a href="https://proisy.dev/contact" rel="noopener" target="_blank"
                        class="hover:text-gray-300">Contact</a>
                </div>
                <div class="mt-4 md:mt-0 text-sm text-gray-500">
                    2025 &copy; <a href="https://proisy.dev/?ref={{ parse_url(config('app.url'), PHP_URL_HOST) }}"
                        target="_blank" rel="noopener">Christopher
                        Proisy</a> — All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
