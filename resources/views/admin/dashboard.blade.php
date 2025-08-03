<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Mt. Magdiwata Eco Farm and Resort</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'nunito': ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        'magdiwata': {
                            50: '#f7f6f3',
                            100: '#e8e4d8',
                            200: '#d1c7b1',
                            300: '#b4a585',
                            400: '#c4a67b',
                            500: '#a08c6a',
                            600: '#8b7a5a',
                            700: '#52301e',
                            800: '#3d2416',
                            900: '#25471c',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-nunito antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="/" class="block">
                        <img src="/images/logo.png.png" alt="Mt. Magdiwata Eco Farm and Resort" class="h-12 w-auto">
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-magdiwata-700 font-medium">Welcome, {{ auth()->user()->name }}</span>
                    <a href="/" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Home</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-magdiwata-900">Admin Dashboard</h1>
                <p class="text-gray-600 mt-2">Manage bookings and monitor resort activities</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-magdiwata-100">
                            <svg class="w-6 h-6 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                            <p class="text-2xl font-semibold text-magdiwata-900">{{ $totalBookings }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Room Bookings</p>
                            <p class="text-2xl font-semibold text-blue-600">{{ $roomBookings }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Activity Bookings</p>
                            <p class="text-2xl font-semibold text-green-600">{{ $activityBookings }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter and Sort Form -->
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-lg font-semibold text-magdiwata-900">All Bookings</h2>
                <form method="GET" class="flex flex-wrap gap-2 items-end">
                    <div>
                        <label for="type" class="block text-xs font-medium text-gray-600">Type</label>
                        <select name="type" id="type" class="border-gray-300 rounded-md text-sm">
                            <option value="">All</option>
                            <option value="room" @if(request('type')=='room') selected @endif>Room</option>
                            <option value="activity" @if(request('type')=='activity') selected @endif>Activity</option>
                        </select>
                    </div>
                    <div>
                        <label for="date_from" class="block text-xs font-medium text-gray-600">From</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <label for="date_to" class="block text-xs font-medium text-gray-600">To</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="border-gray-300 rounded-md text-sm">
                    </div>
                    <button type="submit" class="bg-magdiwata-900 hover:bg-magdiwata-800 text-white px-3 py-2 rounded-md text-xs font-semibold">Filter</button>
                    @if(request()->hasAny(['type','date_from','date_to']))
                        <a href="{{ route('admin.dashboard') }}" class="text-xs text-magdiwata-700 underline ml-2">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Recent Bookings Table -->
            <div class="bg-white rounded-lg shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'name','direction'=>$sort=='name'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Guest Name
                                        @if($sort=='name')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'email','direction'=>$sort=='email'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Email
                                        @if($sort=='email')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'type','direction'=>$sort=='type'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Type
                                        @if($sort=='type')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'selection','direction'=>$sort=='selection'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Selection
                                        @if($sort=='selection')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'booking_date','direction'=>$sort=='booking_date'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Booking Date
                                        @if($sort=='booking_date')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Adults</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Children</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Notes</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bookings as $i => $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($bookings->currentPage()-1)*$bookings->perPage() + $i + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $booking->type === 'room' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($booking->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->selection }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->booking_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->adults }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->children }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                        @if($booking->notes)
                                            <div class="truncate" title="{{ $booking->notes }}">
                                                {{ Str::limit($booking->notes, 50) }}
                                            </div>
                                        @else
                                            <span class="text-gray-400">No notes</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        No bookings found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4">{{ $bookings->links() }}</div>
            </div>
        </div>
    </div>
</body>
</html>
