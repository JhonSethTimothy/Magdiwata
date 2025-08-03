<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book a Room - Mt. Magdiwata Eco Farm and Resort</title>
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
                    <h1 class="text-3xl font-bold text-magdiwata-900 mb-2">Book Your Room</h1>
                    <p class="text-gray-600">Choose your perfect accommodation at Mt. Magdiwata Eco Farm and Resort</p>
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

                <form method="POST" action="{{ route('book.room') }}" class="space-y-6" enctype="multipart/form-data">
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

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent"
                                placeholder="+63 912 345 6789">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-2">Check-in Date *</label>
                            <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="room_type" class="block text-sm font-medium text-gray-700 mb-2">Room Type *</label>
                            <select id="room_type" name="room_type" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                                <option value="">Select a room type</option>
                                @foreach($rooms as $key => $room)
                                <option value="{{ $key }}" {{ old('room_type') == $key ? 'selected' : '' }}>
                                    {{ $room }} - ₱
                                    @php
                                        $roomPrices = [
                                            'kubo-hut' => 500,
                                            'kubo-hut-premium' => 600
                                        ];
                                    @endphp
                                    {{ $roomPrices[$key] ?? 'N/A' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="checkout_date" class="block text-sm font-medium text-gray-700 mb-2">Check-out Date</label>
                            <input type="date" id="checkout_date" name="checkout_date" value="{{ old('checkout_date') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                            <p class="text-sm text-gray-500 mt-1">Optional - if not specified, check-out will be the next day</p>
                        </div>
                        <div>
                            <label for="activity" class="block text-sm font-medium text-gray-700 mb-2">Add Activity (Optional)</label>
                            <select id="activity" name="activity" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                                <option value="">No Activity</option>
                                <option value="zipline" {{ old('activity') == 'zipline' ? 'selected' : '' }}>Zipline - ₱500</option>
                                <option value="hiking" {{ old('activity') == 'hiking' ? 'selected' : '' }}>Hiking - ₱300</option>
                                <option value="swimming" {{ old('activity') == 'swimming' ? 'selected' : '' }}>Swimming - ₱200</option>
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

                    <!-- Price breakdown -->
                    <div class="mt-6 space-y-2 bg-gray-50 p-4 rounded-lg">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Room Price:</span>
                            <span class="font-medium">₱<span id="roomPrice">0</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Activity Fee:</span>
                            <span class="font-medium">₱<span id="activityPrice">0</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Entrance Fee:</span>
                            <span class="font-medium" id="entranceFee">₱0</span>
                        </div>
                        <div class="border-t border-gray-200 my-2"></div>
                        <div class="flex justify-between text-lg font-bold text-magdiwata-900">
                            <span>Total Amount:</span>
                            <span>₱<span id="totalAmount">0</span></span>
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
                            var roomType = document.getElementById('room_type').value;
                            var activity = document.getElementById('activity').value;
                            
                            // Room prices
                            var roomPrices = {
                                'kubo-hut': 1500,
                                'cottage': 2500,
                                'cabin': 3500,
                                'suite': 5000
                            };
                            
                            // Activity prices
                            var activityPrices = {
                                'zipline': 500,
                                'hiking': 300,
                                'swimming': 200,
                                '': 0
                            };
                            
                            var roomPrice = roomPrices[roomType] || 0;
                            var activityPrice = activityPrices[activity] || 0;
                            var entranceFee = adults * 100 + children * 50;
                            var total = roomPrice + entranceFee + activityPrice;
                            
                            document.getElementById('totalAmount').textContent = total.toLocaleString();
                            document.getElementById('roomPrice').textContent = roomPrice.toLocaleString();
                            
                            // Update activity price display if an activity is selected
                            var activityDisplay = document.getElementById('activityPrice');
                            if (activityDisplay) {
                                activityDisplay.textContent = activityPrice > 0 ? activityPrice.toLocaleString() : '0';
                            }
                        }

                        // Initialize total amount on page load
                        document.addEventListener('DOMContentLoaded', function() {
                            updateTotalAmount();
                        });

                        // Update total amount when room type changes

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                        <textarea id="notes" name="notes" rows="4" placeholder="Any special requests or additional information..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Payment Information -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-magdiwata-900 mb-4">Payment Information</h3>
                        
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('images/gcash-logo.png') }}" alt="GCash" class="h-8 w-auto">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Please pay the total amount to our GCash account:
                                        <br><strong>0912 345 6789 - Mt. Magdiwata Eco Farm and Resort</strong>
                                        <br>Then upload your payment receipt below.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="receipt" class="block text-sm font-medium text-gray-700 mb-2">Upload GCash Receipt *</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="receipt" class="relative cursor-pointer bg-white rounded-md font-medium text-magdiwata-600 hover:text-magdiwata-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-magdiwata-500">
                                            <span>Upload a file</span>
                                            <input id="receipt" name="receipt" type="file" class="sr-only" accept="image/*,.pdf" required>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, PDF up to 5MB
                                    </p>
                                </div>
                            </div>
                            @error('receipt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Total Amount -->
                    <div class="mt-8">
                        <div class="text-right mb-4">
                            <p class="text-lg font-semibold text-magdiwata-900">
                                Total Amount: ₱<span id="totalAmount">0</span>
                            </p>
                        </div>
    
    <button 
        type="submit" 
        class="w-full relative overflow-hidden bg-gradient-to-r from-magdiwata-700 via-magdiwata-800 to-magdiwata-900 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl hover:shadow-magdiwata-500/20 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-magdiwata-500 focus:ring-offset-2"
        onclick="this.querySelector('span').classList.add('opacity-0'); this.querySelector('.loader').classList.remove('hidden');"
    >
        <span class="inline-flex items-center justify-center transition-opacity duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            Confirm Booking
        </span>
        <div class="loader absolute inset-0 flex items-center justify-center hidden">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Processing...</span>
        </div>
    </button>
    <p class="mt-2 text-center text-sm text-gray-500">Secure booking with our privacy policy</p>
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
