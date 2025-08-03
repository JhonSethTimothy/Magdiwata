<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book a Room - Mt. Magdiwata Eco Farm and Resort</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@5.11.3/main.min.css' rel='stylesheet' />
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

                <form id="bookingForm" method="POST" action="{{ route('book.room') }}" class="space-y-6" enctype="multipart/form-data" onsubmit="return confirmBooking(event)">
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
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent"
                                placeholder="e.g. 09123456789">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-1">
                                    <label for="booking_date" class="block text-sm font-medium text-gray-700">Check-in Date *</label>
                                    <button type="button" onclick="openAvailabilityModal()" class="text-sm text-magdiwata-600 hover:text-magdiwata-800 font-medium">
                                        Check Availability
                                    </button>
                                </div>
                                <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" min="{{ date('Y-m-d') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-4">Select Your Room</h3>

                            <!-- Standard Rooms -->
                            @if(isset($availableRooms['standard']) && count($availableRooms['standard']) > 0)
                                <div class="mb-6">
                                    <h4 class="text-md font-medium text-gray-700 mb-3">Standard Rooms (₱500/night)</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach($availableRooms['standard'] as $room)
                                            <div class="border rounded-lg p-3 hover:border-magdiwata-500 transition-colors">
                                                <div class="flex items-center">
                                                    <input type="radio" id="room_{{ $room->id }}" name="room_id" value="{{ $room->id }}"
                                                           data-price="{{ $room->type === 'premium' ? 600 : 500 }}"
                                                           class="h-4 w-4 text-magdiwata-600 focus:ring-magdiwata-500 border-gray-300"
                                                           {{ old('room_id') == $room->id ? 'checked' : '' }}>
                                                    <label for="room_{{ $room->id }}" class="ml-2 block text-sm font-medium text-gray-700">
                                                        Room {{ $room->room_number }}
                                                    </label>
                                                </div>
                                                <div class="mt-1 text-sm text-gray-500">
                                                    Status: <span class="text-green-600 font-medium">Available</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Premium Rooms -->
                            @if(isset($availableRooms['premium']) && count($availableRooms['premium']) > 0)
                                <div class="mb-4">
                                    <h4 class="text-md font-medium text-gray-700 mb-3">Premium Rooms (₱600/night)</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
                                        @foreach($availableRooms['premium'] as $room)
                                            <div class="border rounded-lg p-3 hover:border-magdiwata-500 transition-colors">
                                                <div class="flex items-center">
                                                    <input type="radio" id="room_{{ $room->id }}" name="room_id" value="{{ $room->id }}"
                                                           data-price="{{ $room->type === 'premium' ? 600 : 500 }}"
                                                           class="h-4 w-4 text-magdiwata-600 focus:ring-magdiwata-500 border-gray-300"
                                                           {{ old('room_id') == $room->id ? 'checked' : '' }}>
                                                    <label for="room_{{ $room->id }}" class="ml-2 block text-sm font-medium text-gray-700">
                                                        Room {{ $room->room_number }} (Premium)
                                                    </label>
                                                </div>
                                                <div class="mt-1 text-sm text-gray-500">
                                                    Status: <span class="text-green-600 font-medium">Available</span>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

                            @endif



                            @error('room_id')

                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>

                            @enderror
                    </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="checkout_date" class="block text-sm font-medium text-gray-700 mb-2">Check-out Date</label>
                            <input type="date" id="checkout_date" name="checkout_date" value="{{ old('checkout_date') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent">
                            <p class="text-sm text-gray-500 mt-1">Optional - if not specified, check-out will be the next day</p>
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

                    <!-- Display selected room price -->
                    <div class="mt-4 text-right">
                        <p class="text-lg font-semibold text-magdiwata-900">
                            Room Price: ₱<span id="roomPrice">0</span>
                        </p>
                    </div>

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

                    <div class="mt-6 text-right">
                        <p class="text-lg font-semibold text-magdiwata-900">
                            Total Amount: ₱<span id="totalAmount">0</span>
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-6">
                        <a href="/" class="text-magdiwata-700 hover:text-magdiwata-900 font-medium transition-colors duration-300">
                            ← Back to Home
                        </a>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-magdiwata-700 hover:bg-magdiwata-800 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-300">
                                Confirm Booking
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Inclusions & Amenities Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-6">Inclusions & Amenities</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Room Inclusions -->
                        <div>
                            <h3 class="text-lg font-semibold text-magdiwata-800 mb-4">Room Inclusions</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Complimentary breakfast for 2 persons</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Free WiFi access</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Bottled water (2 per day)</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Toiletries and towels</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Resort Amenities -->
                        <div>
                            <h3 class="text-lg font-semibold text-magdiwata-800 mb-4">Resort Amenities</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Swimming pool access</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Restaurant and bar</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Free parking</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-magdiwata-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>24-hour front desk</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cancellation Policy Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-6">Cancellation Policy</h2>

                    <div class="bg-amber-50 border-l-4 border-amber-400 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-amber-800 mb-3">Important Booking Information</h3>
                        <ul class="space-y-3 text-amber-700">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-amber-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>Free cancellation up to 7 days before check-in</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-amber-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>50% refund for cancellations made 3-7 days before check-in</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-amber-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>No refund for cancellations made less than 48 hours before check-in</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-amber-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>No-shows will be charged the full amount of the reservation</span>
                            </li>
                        </ul>

                        <div class="mt-4 p-4 bg-white rounded-lg border border-amber-200">
                            <p class="text-sm text-amber-800">
                                For any cancellation or modification requests, please contact our reservations team at
                                <a href="mailto:reservations@magdiwataresort.com" class="text-magdiwata-600 hover:underline">reservations@magdiwataresort.com</a>
                                or call us at <a href="tel:+639123456789" class="text-magdiwata-600 hover:underline">+63 912 345 6789</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[10000] p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
            <div class="text-center">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Confirm Your Booking</h3>
                <p class="text-gray-600 mb-6">Please review your booking details before confirming:</p>

                <div class="text-left space-y-3 mb-6">
                    <p><strong>Name:</strong> <span id="confirmName"></span></p>
                    <p><strong>Phone:</strong> <span id="confirmPhone"></span></p>
                    <p><strong>Email:</strong> <span id="confirmEmail"></span></p>
                    <p><strong>Check-in Date:</strong> <span id="confirmCheckIn"></span></p>
                    <p><strong>Check-out Date:</strong> <span id="confirmCheckOut"></span></p>
                    <p><strong>Room Type:</strong> <span id="confirmRoomType"></span></p>
                    <p><strong>Guests:</strong> <span id="confirmGuests"></span></p>
                    <p><strong>Activity:</strong> <span id="confirmActivity"></span></p>
                    <p><strong>Receipt:</strong> <span id="confirmReceipt"></span></p>
                    <p class="text-lg font-semibold mt-4">Total Amount: ₱<span id="confirmTotal">0</span></p>
                </div>

                <div class="flex justify-center space-x-4">
                    <button type="button" onclick="closeConfirmation()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-300">
                        Cancel
                    </button>
                    <button type="button" onclick="submitBooking()" class="px-6 py-2 bg-magdiwata-700 text-white rounded-lg hover:bg-magdiwata-800 transition-colors duration-300">
                        Confirm Booking
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Availability Calendar Modal -->
    <div id="availabilityModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[9999] p-4 overflow-auto">
        <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Room Availability Calendar</h3>
                        <p class="text-sm text-gray-500 mt-1">Check available dates for your stay</p>
                    </div>
                    <button onclick="closeAvailabilityModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Calendar Legend -->
                <div class="flex flex-wrap gap-4 mb-4 text-sm">
                    <div class="flex items-center">
                        <span class="w-4 h-4 bg-emerald-100 border border-emerald-300 rounded-sm mr-2"></span>
                        <span>Available</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-4 h-4 bg-red-100 border border-red-300 rounded-sm mr-2"></span>
                        <span>Room Booked</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-4 h-4 bg-blue-100 border border-blue-300 rounded-sm mr-2"></span>
                        <span>Activity Booked</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-4 h-4 bg-gray-100 border border-gray-300 rounded-sm mr-2"></span>
                        <span>Not Available</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div id="availabilityCalendar"></div>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Click on a date to select it
                    </div>
                    <div>
                        <button onclick="closeAvailabilityModal()" class="px-4 py-2 bg-magdiwata-600 text-white rounded-md hover:bg-magdiwata-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-magdiwata-500">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
                        function updateCount(type, delta, min, max) {
                            try {
                                const input = document.getElementById(type);
                                const display = document.getElementById(type + '_display');
                                if (!input || !display) return;

                                let value = parseInt(input.value) + delta;
                                value = Math.max(min, Math.min(max, value));

                                input.value = value;
                                display.textContent = value;
                                updateTotalAmount();
                            } catch (error) {
                                console.error('Error in updateCount:', error);
                            }
                        }

                        function updateTotalAmount() {
                            // Get selected room radio button
                            const selectedRoomRadio = document.querySelector('input[name="room_id"]:checked');
                            let roomPrice = 0;
                            if (selectedRoomRadio) {
                                roomPrice = parseInt(selectedRoomRadio.getAttribute('data-price')) || 0;
                            }

                            // Get number of adults and children
                            const adults = parseInt(document.getElementById('adults').value) || 0;
                            const children = parseInt(document.getElementById('children').value) || 0;

                            // Calculate entrance fees (₱100 per adult, ₱50 per child)
                            const entranceFee = (adults * 100) + (children * 50);

                            // Calculate number of nights
                            let nights = 1; // Default to 1 night
                            const checkInDate = document.getElementById('booking_date').value;
                            const checkOutDate = document.getElementById('checkout_date').value;

                            if (checkInDate && checkOutDate) {
                                const start = new Date(checkInDate);
                                const end = new Date(checkOutDate);
                                // Calculate difference in days
                                const diffTime = Math.abs(end - start);
                                nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) || 1;
                            }

                            // Calculate total amount
                            const totalAmount = (roomPrice + entranceFee) * nights;

                            // Update display
                            document.getElementById('totalAmount').textContent = totalAmount.toLocaleString();
                            document.getElementById('roomPrice').textContent = roomPrice.toLocaleString();

                            return totalAmount;
                        }

                        // Initialize total amount on page load
                        document.addEventListener('DOMContentLoaded', function() {
                            // Add event listeners for form changes
                            const roomRadios = document.querySelectorAll('input[name="room_id"]');
                            roomRadios.forEach(radio => {
                                radio.addEventListener('change', updateTotalAmount);
                            });
                            document.getElementById('booking_date').addEventListener('change', updateTotalAmount);
                            document.getElementById('checkout_date').addEventListener('change', updateTotalAmount);
                            document.getElementById('adults').addEventListener('change', function() {
                                updateCount('adults', 0, 1, 20);
                            });
                            document.getElementById('children').addEventListener('change', function() {
                                updateCount('children', 0, 0, 20);
                            });

                            // Initial calculation
                            updateTotalAmount();
                        });
             // Initialize FullCalendar
        let calendar;

        // Global variables for availability data
        let roomAvailability = {};
        let activityAvailability = {};
        const TOTAL_ROOMS = 10; // Total number of rooms available
        const MAX_ACTIVITY_CAPACITY = 50; // Max capacity for activities

        function initCalendar() {
            const calendarEl = document.getElementById('availabilityCalendar');
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialDate: today,
                firstDay: 1, // Start week on Monday
                dayMaxEventRows: 3,
                height: 'auto',
                events: {
                    url: '/api/booked-dates',
                    method: 'GET',
                    success: function(events) {
                        // Process the events to track availability
                        processAvailability(events);
                    },
                    failure: function() {
                        alert('Error fetching booked dates. Please try again.');
                    }
                },
                eventDidMount: function(info) {
                    const type = info.event.extendedProps.type;
                    const isFullyBooked = info.event.extendedProps.isFullyBooked;

                    if (type === 'room') {
                        info.el.style.backgroundColor = isFullyBooked ? '#FEE2E2' : '#FEF3C7';
                        info.el.style.borderColor = isFullyBooked ? '#FCA5A5' : '#FCD34D';
                        info.el.style.color = isFullyBooked ? '#B91C1C' : '#92400E';
                        info.el.title = isFullyBooked ? 'Fully Booked' : 'Limited Availability';
                    } else {
                        info.el.style.backgroundColor = isFullyBooked ? '#E0E7FF' : '#DBEAFE';
                        info.el.style.borderColor = isFullyBooked ? '#A5B4FC' : '#93C5FD';
                        info.el.style.color = isFullyBooked ? '#4338CA' : '#1E40AF';
                        info.el.title = isFullyBooked ? 'Activity Fully Booked' : 'Activity Available';
                    }
                    info.el.style.borderWidth = '1px';
                    info.el.style.borderRadius = '0.25rem';
                    info.el.style.padding = '2px 4px';
                    info.el.style.fontSize = '0.75rem';
                    info.el.style.fontWeight = '500';
                },
                dateClick: function(info) {
                    const dateInput = document.getElementById('booking_date');
                    const selectedDate = info.date;
                    const dateStr = selectedDate.toISOString().split('T')[0];

                    // Check if date is available
                    if (selectedDate < today) {
                        alert('Cannot select a past date');
                        return;
                    }

                    // Check room availability
                    if (roomAvailability[dateStr] && roomAvailability[dateStr] >= TOTAL_ROOMS) {
                        alert('Sorry, all rooms are booked for this date. Please select another date.');
                        return;
                    }

                    dateInput.value = dateStr;
                    closeAvailabilityModal();
                },
                dayCellDidMount: function(info) {
                    const cellDate = info.date;
                    const dateStr = cellDate.toISOString().split('T')[0];
                    const dayEl = info.el;

                    // Reset styles
                    dayEl.style.cursor = 'default';
                    dayEl.style.position = 'relative';

                    // Style past dates
                    if (cellDate < today) {
                        dayEl.style.backgroundColor = '#F3F4F6';
                        dayEl.style.color = '#9CA3AF';
                        dayEl.title = 'Unavailable - Past date';
                        return;
                    }

                    // Check room availability
                    const roomsBooked = roomAvailability[dateStr] || 0;
                    const isRoomFullyBooked = roomsBooked >= TOTAL_ROOMS;

                    // Check activity availability
                    const activitiesBooked = activityAvailability[dateStr] || 0;
                    const isActivityFullyBooked = activitiesBooked >= MAX_ACTIVITY_CAPACITY;

                    // Determine status
                    if (isRoomFullyBooked && isActivityFullyBooked) {
                        // Fully booked for both
                        dayEl.style.backgroundColor = '#FEE2E2';
                        dayEl.style.border = '1px solid #FCA5A5';
                        dayEl.title = 'Fully Booked - No availability for rooms or activities';
                    } else if (isRoomFullyBooked) {
                        // Only rooms fully booked
                        dayEl.style.backgroundColor = '#FEF3C7';
                        dayEl.style.border = '1px solid #FCD34D';
                        dayEl.title = 'Rooms Fully Booked - Activities available';
                        dayEl.style.cursor = 'pointer';
                    } else if (isActivityFullyBooked) {
                        // Only activities fully booked
                        dayEl.style.backgroundColor = '#E0E7FF';
                        dayEl.style.border = '1px solid #A5B4FC';
                        dayEl.title = 'Activities Fully Booked - Rooms available';
                        dayEl.style.cursor = 'pointer';
                    } else {
                        // Available for booking
                        dayEl.style.backgroundColor = '#ECFDF5';
                        dayEl.style.border = '1px solid #A7F3D0';
                        dayEl.title = 'Available for booking';
                        dayEl.style.cursor = 'pointer';

                        // Add availability badge if there are some bookings
                        if (roomsBooked > 0 || activitiesBooked > 0) {
                            const badge = document.createElement('div');
                            badge.className = 'availability-badge';
                            badge.style.position = 'absolute';
                            badge.style.top = '2px';
                            badge.style.right = '2px';
                            badge.style.fontSize = '9px';
                            badge.style.padding = '1px 3px';
                            badge.style.borderRadius = '4px';
                            badge.style.background = 'rgba(0,0,0,0.7)';
                            badge.style.color = 'white';

                            let badgeText = '';
                            if (roomsBooked > 0) {
                                badgeText += `${TOTAL_ROOMS - roomsBooked} of ${TOTAL_ROOMS} rooms`;
                            }
                            if (activitiesBooked > 0) {
                                if (badgeText) badgeText += ' • ';
                                badgeText += `${MAX_ACTIVITY_CAPACITY - activitiesBooked} activity spots`;
                            }

                            badge.textContent = badgeText;
                            dayEl.appendChild(badge);
                        }
                    }

                    // Add hover effect for clickable dates
                    if (dayEl.style.cursor === 'pointer') {
                        dayEl.addEventListener('mouseenter', () => {
                            dayEl.style.filter = 'brightness(0.95)';
                        });
                        dayEl.addEventListener('mouseleave', () => {
                            dayEl.style.filter = 'none';
                        });
                    }
                }
            });

            calendar.render();

            // Style the today button
            const todayBtn = document.querySelector('.fc-today-button');
            if (todayBtn) {
                todayBtn.classList.add('bg-magdiwata-600', 'hover:bg-magdiwata-700', 'text-white', 'px-3', 'py-1', 'rounded', 'text-sm');
            }
        }

        // Process availability data from events
        function processAvailability(events) {
            // Reset availability trackers
            roomAvailability = {};
            activityAvailability = {};

            // Process each event to count bookings per date
            events.forEach(event => {
                const startDate = new Date(event.start);
                const endDate = event.end ? new Date(event.end) : new Date(startDate);

                // Handle single day events
                if (!event.end) {
                    const dateStr = startDate.toISOString().split('T')[0];
                    if (event.extendedProps.type === 'room') {
                        roomAvailability[dateStr] = (roomAvailability[dateStr] || 0) + 1;
                    } else {
                        activityAvailability[dateStr] = (activityAvailability[dateStr] || 0) + (event.extendedProps.participants || 1);
                    }
                    return;
                }

                // Handle multi-day events
                const currentDate = new Date(startDate);
                while (currentDate < endDate) {
                    const dateStr = currentDate.toISOString().split('T')[0];
                    if (event.extendedProps.type === 'room') {
                        roomAvailability[dateStr] = (roomAvailability[dateStr] || 0) + 1;
                    } else {
                        activityAvailability[dateStr] = (activityAvailability[dateStr] || 0) + (event.extendedProps.participants || 1);
                    }
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            });

            // Refresh the calendar to update the display
            if (calendar) {
                calendar.refetchEvents();
            }
        }

        // Modal functions
        function openAvailabilityModal() {
            document.getElementById('availabilityModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (!calendar) {
                initCalendar();
            } else {
                calendar.refetchEvents();
            }
        }

        function closeAvailabilityModal() {
            document.getElementById('availabilityModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('availabilityModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAvailabilityModal();
            }
        });

        // Initialize form functionality
        document.addEventListener('DOMContentLoaded', function() {
            updateTotalAmount();
        });

        function confirmBooking(event) {
            event.preventDefault();

            // Basic form validation
            const form = document.getElementById('bookingForm');
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (!isValid) {
                alert('Please fill in all required fields');
                return false;
            }

            // Get form values
            const roomTypeSelect = document.getElementById('room_type');
            const activitySelect = document.getElementById('activity');

            // Update confirmation modal with booking details
            document.getElementById('confirmName').textContent = document.getElementById('name').value;
            document.getElementById('confirmPhone').textContent = document.getElementById('phone').value || 'Not provided';
            document.getElementById('confirmEmail').textContent = document.getElementById('email').value;
            document.getElementById('confirmCheckIn').textContent = document.getElementById('booking_date').value || 'Not specified';
            document.getElementById('confirmCheckOut').textContent = document.getElementById('checkout_date').value || 'Next day';
            document.getElementById('confirmRoomType').textContent = roomTypeSelect.options[roomTypeSelect.selectedIndex].text || 'Not selected';
            document.getElementById('confirmGuests').textContent =
                `${document.getElementById('adults').value} Adult(s), ${document.getElementById('children').value} Child(ren)`;
            document.getElementById('confirmActivity').textContent =
                activitySelect.options[activitySelect.selectedIndex].text || 'No activity selected';

            const receiptFile = document.getElementById('receipt').files[0];
            document.getElementById('confirmReceipt').textContent = receiptFile ? receiptFile.name : 'No file selected';

            document.getElementById('confirmTotal').textContent = document.getElementById('totalAmount').textContent;

            // Show the confirmation modal
            document.getElementById('confirmationModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            return false;
        }

        function closeConfirmation() {
            document.getElementById('confirmationModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function submitBooking() {
            // Submit the form
            document.getElementById('bookingForm').submit();
        }

        // Close modal when clicking outside the modal content
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('confirmationModal');
            if (event.target === modal) {
                closeConfirmation();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeConfirmation();
            }
        });
        </script>

                    <script>
                        function confirmBooking(event) {
                            event.preventDefault();

                            // Get form values
                            const form = document.getElementById('bookingForm');
                            const roomTypeSelect = document.getElementById('room_type');

                            // Update confirmation modal with booking details
                            document.getElementById('confirmName').textContent = document.getElementById('name').value;
                            document.getElementById('confirmCheckIn').textContent = document.getElementById('booking_date').value || 'Not specified';
                            document.getElementById('confirmCheckOut').textContent = document.getElementById('checkout_date').value || 'Next day';
                            document.getElementById('confirmRoomType').textContent = roomTypeSelect.options[roomTypeSelect.selectedIndex].text || 'Not selected';
                            document.getElementById('confirmGuests').textContent =
                                `${document.getElementById('adults').value} Adult(s), ${document.getElementById('children').value} Child(ren)`;
                            document.getElementById('confirmTotal').textContent =
                                document.getElementById('totalAmount').textContent;

                            // Show the confirmation modal
                            document.getElementById('confirmationModal').classList.remove('hidden');
                            document.body.style.overflow = 'hidden';

                            return false;
                        }

                        function closeConfirmation() {
                            document.getElementById('confirmationModal').classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }

                        function submitBooking() {
                            // Submit the form
                            document.getElementById('bookingForm').submit();
                        }

                        // Close modal when clicking outside the modal content
                        document.getElementById('confirmationModal').addEventListener('click', function(e) {
                            if (e.target === this) {
                                closeConfirmation();
                            }
                        });
                    </script>
</body>
</html>
