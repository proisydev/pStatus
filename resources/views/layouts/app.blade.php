<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Undefined') — {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Status page for all your services')">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">
    <header class="border-b border-gray-800">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="h-8 w-8 rounded-full bg-violet-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold">{{ config('app.name') }}</span>
                </div>
                <nav>
                    <ul class="flex space-x-6">
                        <li><a href="{{ config('app.url') }}/status" class="text-violet-400 hover:text-violet-300"
                                title="Status" rel="noopener">Status</a></li>
                        <!--<li><a href="{{ config('app.url') }}/incidents" class="text-gray-400 hover:text-gray-300"
                                title="Incidents " rel="noopener">Incidents</a>
                        </li>-->
                        <li><a href="https://docs.{{ parse_url(config('app.url'), PHP_URL_HOST) }}" rel="noopener"
                                title="{{ config('app.name') }}'s API" target="_blank"
                                class="text-gray-400 hover:text-gray-300">API</a></li>
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
                        <div class="h-6 w-6 rounded-full bg-violet-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
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
