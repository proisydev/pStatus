@extends('layouts.app')

@section('title', $monitor['name'] . ' — Monitor Details')
@section('description', 'Detailed status and performance insights for ' . $monitor['name'] . ' on ' . config('app.name')
    . '. Stay informed with real-time updates and uptime statistics.')

@section('content')
    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6 mb-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div class="flex items-center">
                <div class="h-10 w-10 rounded-lg bg-violet-600/20 flex items-center justify-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">{{ $monitor['name'] }}</h1>
                    <p class="text-gray-400">{{ $monitor['type'] }} — {{ $monitor['checkInterval'] }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @php
                    $statusClass = $monitor['statusClass'];
                    switch ($statusClass) {
                        case 'success':
                            $statusClass = 'bg-violet-500 text-violet-500';
                            $statusText = 'Operational';
                            break;
                        case 'degraded':
                            $statusClass = 'bg-yellow-500 text-yellow-500';
                            $statusText = 'Degraded';
                            break;
                        case 'error':
                            $statusClass = 'bg-red-500 text-red-500';
                            $statusText = 'Outage';
                            break;
                        default:
                            $statusClass = 'bg-gray-500 text-gray-500';
                            $statusText = 'Unknown';
                            break;
                    }
                @endphp
                <div class="h-3 w-3 rounded-full {{ explode(' ', $statusClass)[0] }}"></div>
                <span class="font-medium {{ explode(' ', $statusClass)[1] }}">
                    {{ $statusText }}
                </span>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-800/50 rounded-lg px-4 py-3">
                <p class="text-xs text-gray-400 mb-1">Uptime (30 days)</p>
                <p class="font-medium text-lg">{{ number_format($monitor['30dRatio']['ratio'], 2) }}%</p>
            </div>
            <div class="bg-gray-800/50 rounded-lg px-4 py-3">
                <Up class="text-xs text-gray-400 mb-1">Up</Up>
                <p class="font-medium text-lg">{{ $stats['counts']['up'] }} times</p>
            </div>
            <div class="bg-gray-800/50 rounded-lg px-4 py-3">
                <p class="text-xs text-gray-400 mb-1">Down</p>
                <p class="font-medium text-lg">{{ $stats['counts']['down'] }} times</p>
            </div>
            <div class="bg-gray-800/50 rounded-lg px-4 py-3">
                <p class="text-xs text-gray-400 mb-1">Count result</p>
                <p class="font-medium text-lg">{{ $stats['count_result'] }}</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <div class="lg:col-span-2">
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6 h-full flex flex-col">
                <div class="flex flex-col mb-6">
                    <div class="flex items-baseline mb-1">
                        <h2 class="text-xl font-semibold">Uptime</h2>
                        <span class="text-gray-400 ml-2">Last 30 days</span>
                    </div>
                    <p class="text-2xl font-bold text-violet-400">99.98%</p>
                </div>
                <div class="w-full mb-4">
                    <div class="grid grid-cols-30 gap-0 w-full">
                        @foreach (array_slice($days, -30) as $index => $day)
                            @php
                                $ratio = $dailyRatios[$index]['ratio'];
                                $color =
                                    $ratio > 75
                                        ? 'bg-violet-500'
                                        : ($ratio > 0 && $ratio <= 50
                                            ? 'bg-red-500'
                                            : ($ratio > 50 && $ratio <= 75
                                                ? 'bg-yellow-500'
                                                : 'bg-gray-600'));
                                $status =
                                    $ratio > 75
                                        ? 'Operational'
                                        : ($ratio > 0 && $ratio <= 50
                                            ? 'Outage'
                                            : ($ratio > 50 && $ratio <= 75
                                                ? 'Degraded'
                                                : 'Historical'));
                            @endphp
                            <div class="h-8 {{ $color }} rounded-sm"
                                title="{{ $day }}: {{ $ratio }}% {{ $status }}"></div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mb-4">
                    <span>{{ \Carbon\Carbon::parse($days[0])->format('d M') }}</span>
                    <span>{{ \Carbon\Carbon::parse($days[29])->format('d M') }}</span>
                </div>
                <div class="flex space-x-6 mt-auto">
                    <div class="flex items-center">
                        <div class="h-3 w-3 bg-violet-500 rounded-sm mr-2"></div>
                        <span class="text-xs text-gray-400">Operational</span>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 bg-yellow-500 rounded-sm mr-2"></div>
                        <span class="text-xs text-gray-400">Degraded</span>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 bg-red-500 rounded-sm mr-2"></div>
                        <span class="text-xs text-gray-400">Outage</span>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 bg-gray-600 rounded-sm mr-2"></div>
                        <span class="text-xs text-gray-400">Historical</span>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6 h-full flex flex-col">
                <h2 class="text-lg font-semibold mb-4">All Ratios</h2>
                <div class="space-y-4 flex-grow">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-400">Today</span>
                            <span class="text-sm font-medium">{{ number_format($monitor['1dRatio']['ratio'], 2) }}%</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2">
                            <div class="bg-violet-500 h-2 rounded-full"
                                style="width: {{ number_format($monitor['1dRatio']['ratio'], 2) }}%%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-400">7 days</span>
                            <span class="text-sm font-medium">{{ number_format($monitor['7dRatio']['ratio'], 2) }}%</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2">
                            <div class="bg-violet-500 h-2 rounded-full"
                                style="width: {{ number_format($monitor['7dRatio']['ratio'], 2) }}%%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-400">30 days</span>
                            <span class="text-sm font-medium">{{ number_format($monitor['30dRatio']['ratio'], 2) }}%</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2">
                            <div class="bg-violet-500 h-2 rounded-full"
                                style="width: {{ number_format($monitor['30dRatio']['ratio'], 2) }}%%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-400">90 days</span>
                            <span class="text-sm font-medium">{{ number_format($monitor['90dRatio']['ratio'], 2) }}%</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2">
                            <div class="bg-violet-500 h-2 rounded-full"
                                style="width: {{ number_format($monitor['90dRatio']['ratio'], 2) }}%%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        @php
            $responseValues = array_column($responseTimes, 'value');
            $average = number_format(array_sum($responseValues) / count($responseValues), 2);
            $minimum = min($responseValues);
            $maximum = max($responseValues);
            sort($responseValues);
            $percentile90Index = (int) ceil(0.9 * count($responseValues)) - 1;
            $percentile90 = $responseValues[$percentile90Index];
        @endphp
        <div class="lg:col-span-2">
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6 h-full flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Response Time (Last 24 Hours)</h2>
                    <div class="flex items-center space-x-4">
                        <div>
                            <span class="text-xs text-gray-400">Min:</span>
                            <span
                                class="text-sm font-medium ml-1">{{ min(array_column($responseTimes, 'value')) }}ms</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">Avg:</span>
                            <span
                                class="text-sm font-medium ml-1">{{ number_format(array_sum(array_column($responseTimes, 'value')) / count($responseTimes), 2) }}ms</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">Max:</span>
                            <span
                                class="text-sm font-medium ml-1">{{ max(array_column($responseTimes, 'value')) }}ms</span>
                        </div>
                    </div>
                </div>

                <div class="h-48 relative flex-grow">
                    <svg class="w-full h-full" viewBox="0 0 24 100" preserveAspectRatio="none">
                        <line x1="0" y1="0" x2="24" y2="0" stroke="#374151"
                            stroke-width="0.5" />
                        <line x1="0" y1="25" x2="24" y2="25" stroke="#374151"
                            stroke-width="0.5" />
                        <line x1="0" y1="50" x2="24" y2="50" stroke="#374151"
                            stroke-width="0.5" />
                        <line x1="0" y1="75" x2="24" y2="75" stroke="#374151"
                            stroke-width="0.5" />
                        <line x1="0" y1="100" x2="24" y2="100" stroke="#374151"
                            stroke-width="0.5" />
                        @php
                            $points = [];
                            $maxValue = max(array_column($responseTimes, 'value'));
                            foreach ($responseTimes as $index => $response) {
                                $x = ($index / (count($responseTimes) - 1)) * 24;
                                $y = 100 - ($response['value'] / $maxValue) * 100;
                                $points[] = "{$x},{$y}";
                            }
                        @endphp
                        <path d="M{{ implode(' ', $points) }}" fill="none" stroke="#8b5cf6" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M{{ implode(' ', $points) }} V100 H0 Z" fill="url(#gradient)" opacity="0.2" />
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#8b5cf6" stop-opacity="1" />
                                <stop offset="100%" stop-color="#8b5cf6" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        @foreach ($responseTimes as $index => $response)
                            @if ($index % (int) ceil(count($responseTimes) / 5) === 0)
                                <span>{{ \Carbon\Carbon::parse($response['datetime'])->format('h A') }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6 h-full flex flex-col">
                <h2 class="text-lg font-semibold mb-4">Response Time Stats</h2>
                <div class="space-y-3 flex-grow">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-400">Average</span>
                        <span class="font-medium">{{ $average }}ms</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-400">Minimum</span>
                        <span class="font-medium">{{ $minimum }}ms</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-400">Maximum</span>
                        <span class="font-medium">{{ $maximum }}ms</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-400">90th Percentile</span>
                        <span class="font-medium">{{ $percentile90 }}ms</span>
                    </div>
                </div>
                <div class="mt-auto pt-4 border-t border-gray-800">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-400">Last Check</span>
                        <span class="font-medium">{{ $responseTimes[count($responseTimes) - 1]['datetime'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
        <h2 class="text-lg font-semibold mb-4">Logs</h2>
        <div class="space-y-6">
            @foreach ($logs as $log)
                @php
                    $logClass =
                        $log['class'] === 'success'
                            ? 'border-green-500 bg-green-900/30 text-green-300'
                            : ($log['class'] === 'danger'
                                ? 'border-red-500 bg-red-900/30 text-red-300'
                                : 'border-yellow-500 bg-yellow-900/30 text-yellow-300');
                @endphp
                <div class="border-l-2 {{ explode(' ', $logClass)[0] }} pl-4">
                    <div class="flex items-center mb-2">
                        <h3 class="font-medium">{{ $log['label'] }}</h3>
                        <span
                            class="ml-3 px-2 py-1 {{ explode(' ', $logClass)[1] }} {{ explode(' ', $logClass)[2] }} text-xs rounded-full">
                            {{ $log['class'] === 'success' ? 'Resolved' : 'Issue' }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-400 mb-3">{{ $log['date'] }} ({{ $log['duration'] }})</p>

                    <div class="space-y-3 text-sm">
                        <div class="flex">
                            <span class="text-gray-500 w-20 flex-shrink-0">Code:</span>
                            <p>{{ $log['reason']['code'] }}</p>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-20 flex-shrink-0">Short:</span>
                            <p>{{ $log['reason']['detail']['short'] }}</p>
                        </div>
                        @if (isset($log['reason']['detail']['full']))
                            <div class="flex">
                                <span class="text-gray-500 w-20 flex-shrink-0">Details:</span>
                                <p>{{ $log['reason']['detail']['full'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
