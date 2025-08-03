<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You - Mt. Magdiwata Eco Farm and Resort</title>
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
    <style>
        @media print {
            nav, .no-print, .print-hide { display: none !important; }
            .print-receipt { display: block !important; }
            body { background: #fff !important; }
        }
        .print-receipt { display: none; }
    </style>
</head>
<body class="font-nunito antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="/" class="block">
                        <img src="/images/logo.png.png" alt="Mt. Magdiwata Eco Farm and Resort" class="h-12 w-auto">
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Home</a>
                    <a href="{{ route('book') }}" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Book Now</a>
                    <a href="{{ route('faq') }}" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">FAQ</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Thank You Content -->
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-2xl shadow-lg p-12">
                @if(session('success'))
                    <div class="mb-8">
                        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-magdiwata-900 mb-4">Thank You!</h1>
                        <p class="text-xl text-gray-600 mb-6">{{ session('success') }}</p>
                    </div>
                @else
                    <div class="mb-8">
                        <div class="w-24 h-24 bg-magdiwata-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-magdiwata-900 mb-4">Thank You!</h1>
                        <p class="text-xl text-gray-600 mb-6">Your booking has been submitted successfully!</p>
                    </div>
                @endif

                <!-- Receipt Section (printable) -->
                <div class="print-receipt bg-white rounded-lg shadow p-8 text-left mx-auto max-w-lg mt-8">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-4">Booking Receipt</h2>
                    <p class="mb-2"><span class="font-semibold">Name:</span> {{ old('name') ?? 'Your Name' }}</p>
                    <p class="mb-2"><span class="font-semibold">Email:</span> {{ old('email') ?? 'Your Email' }}</p>
                    <p class="mb-2"><span class="font-semibold">Adults:</span> {{ session('adults', old('adults', 1)) }}</p>
                    <p class="mb-2"><span class="font-semibold">Children:</span> {{ session('children', old('children', 0)) }}</p>
                    <p class="mb-2"><span class="font-semibold">Room Type:</span> {{ old('room_type') ? $rooms[old('room_type')] ?? old('room_type') : 'N/A' }}</p>
                    <p class="mb-2"><span class="font-semibold">Check-in Date:</span> {{ old('room_date') ?? 'N/A' }}</p>
                    <p class="mb-2"><span class="font-semibold">Check-out Date:</span> {{ old('room_checkout') ?? 'N/A' }}</p>
                    <p class="mb-2"><span class="font-semibold">Activity:</span> {{ old('activity') ? $activities[old('activity')] ?? old('activity') : 'N/A' }}</p>
                    <p class="mb-2"><span class="font-semibold">Activity Date:</span> {{ old('activity_date') ?? 'N/A' }}</p>
                    <p class="mb-2"><span class="font-semibold">Special Requests:</span> {{ old('notes') ?? 'None' }}</p>
                    <p class="mb-2"><span class="font-semibold">Total Amount:</span> ₱{{ $total_amount ?? 0 }}</p>
                    <p class="mt-6 text-xs text-gray-400">Please keep this receipt for your records.</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8 no-print">
                    <a href="/" class="bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                        Return to Home
                    </a>
                    <a href="{{ route('book') }}" class="bg-white border-2 border-magdiwata-900 text-magdiwata-900 hover:bg-magdiwata-900 hover:text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                        Book Again
                    </a>
                    <!-- Only one Print Receipt button (PDF) should remain -->
                    <a href="{{ route('receipt.pdf') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300 print-hide" target="_blank">
                        Print Receipt
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
