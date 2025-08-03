    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book an Activity - Mt. Magdiwata Eco Farm and Resort</title>
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
                    <a href="/" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Home</a>
                    <a href="{{ route('book') }}" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Book Both</a>
                    <a href="{{ route('faq') }}" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">FAQ</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Booking Form -->
    <div class="min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-magdiwata-900 mb-2">Book Your Adventure</h1>
                    <p class="text-gray-600">Choose your exciting activity at Mt. Magdiwata Eco Farm and Resort</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('book.activity') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                            <p class="text-sm text-gray-500 mt-1">Entrance fee: Child is ₱50, Adult is ₱100</p>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-2">Activity Date *</label>
                            <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="activity" class="block text-sm font-medium text-gray-700 mb-2">Activity *</label>
                            <select id="activity" name="activity" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                                <option value="">Select an activity</option>
                                @foreach($activities as $key => $activity)
                                    <option value="{{ $key }}" {{ old('activity') == $key ? 'selected' : '' }}>
                                        {{ $activity }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Adults *</label>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="updateCount('adults', -1, 1, 20)" class="bg-magdiwata-900 text-white w-8 h-8 rounded-full flex items-center justify-center">-</button>
                                <span id="adults_display">{{ old('adults', 1) }}</span>
                                <button type="button" onclick="updateCount('adults', 1, 1, 20)" class="bg-magdiwata-900 text-white w-8 h-8 rounded-full flex items-center justify-center">+</button>
                            </div>
                            <input type="hidden" id="adults" name="adults" value="{{ old('adults', 1) }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Children</label>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="updateCount('children', -1, 0, 20)" class="bg-magdiwata-900 text-white w-8 h-8 rounded-full flex items-center justify-center">-</button>
                                <span id="children_display">{{ old('children', 0) }}</span>
                                <button type="button" onclick="updateCount('children', 1, 0, 20)" class="bg-magdiwata-900 text-white w-8 h-8 rounded-full flex items-center justify-center">+</button>
                            </div>
                            <input type="hidden" id="children" name="children" value="{{ old('children', 0) }}">
                        </div>
                    </div>
                    <script>
                        function updateCount(type, delta, min, max) {
                            var input = document.getElementById(type);
                            var display = document.getElementById(type + '_display');
                            var value = parseInt(input.value) + delta;
                            if (value < min) value = min;
                            if (value > max) value = max;
                            input.value = value;
                            display.textContent = value;
                            updateTotalAmount();
                        }

                        function updateTotalAmount() {
                            var adults = parseInt(document.getElementById('adults').value) || 0;
                            var children = parseInt(document.getElementById('children').value) || 0;
                            var total = adults * 100 + children * 50;
                            document.getElementById('totalAmount').textContent = total;
                        }

                        // Initialize total amount on page load
                        document.addEventListener('DOMContentLoaded', function() {
                            updateTotalAmount();
                        });
                    </script>

                    <div class="mt-6 p-4 bg-magdiwata-100 rounded-lg text-magdiwata-900 font-semibold text-lg">
                        Total Amount: ₱<span id="totalAmount">100</span>
                    </div>

                    <div class="flex items-center justify-between pt-6">
                        <a href="/" class="text-magdiwata-700 hover:text-magdiwata-900 font-medium transition-colors duration-300">
                            ← Back to Home
                        </a>
                        <button type="submit" class="bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                            Submit Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
