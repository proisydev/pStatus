@extends('layouts.app')

@section('title', 'All monitors')

@section('content')
    <!-- System Status - Centered and Professional -->
    <div class="mb-10 text-center">
        <div
            class="inline-block bg-gray-900 px-6 py-4 rounded-lg border shadow-sm border-violet-600 transition-all duration-300 hover:shadow-[0_0_15px_rgba(124,58,237,0.15)]">
            @if (isset($health['data']) && count($health['data']) > 0)
                <div class="flex items-center justify-center gap-3">
                    <div class="h-3 w-3 rounded-full bg-violet-500 animate-pulse"></div>
                    <h1 class="text-2xl font-semibold">{{ $health['data']['status'] }}</h1>
                </div>
                <p class="text-gray-400 text-sm mt-2">Last updated
                    {{ \Carbon\Carbon::createFromTimestamp($health['data']['timestamp'] / 1000)->locale('en')->diffForHumans() }}
                </p>
            @else
                <p>Aucune idée...</p>
            @endif
        </div>
    </div>

    <!-- Services -->
    <div class="mb-12">
        <h2 class="text-xl font-semibold mb-4">Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @if (isset($monitors['data']['monitors']) && count($monitors['data']['monitors']) > 0)
                @foreach ($monitors['data']['monitors'] as $monitor)
                    <a href="monitor-details.html" class="group">
                        <div
                            class="bg-gray-900 rounded-lg p-5 border border-gray-800 hover:border-violet-600 transition-all duration-300 hover:shadow-[0_0_15px_rgba(124,58,237,0.15)] h-full flex flex-col">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span class="text-xs text-gray-500 uppercase tracking-wider">AAAA</span>
                                    <h3 class="font-medium text-lg group-hover:text-violet-400 transition-colors">
                                        {{ $monitor['friendly_name'] }}</h3>
                                </div>
                                <div class="flex items-center">
                                    <div class="h-2.5 w-2.5 rounded-full bg-violet-500 mr-1.5"></div>
                                    <span class="text-xs text-violet-300">{{ $monitor['status'] }}</span>
                                </div>
                            </div>
                            <div class="mt-auto pt-4 border-t border-gray-800">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-400">99.98% uptime</span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-gray-600 group-hover:text-violet-400 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p>Aucun moniteur trouvé.</p>
            @endif
        </div>
    </div>
@endsection
