<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAQ - Mt. Magdiwata Eco Farm and Resort</title>
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
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Home</a>
                    <a href="{{ route('book') }}" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Book Now</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- FAQ Content -->
    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-magdiwata-900 mb-4">Frequently Asked Questions</h1>
                <p class="text-xl text-gray-600">Find answers to common questions about Mt. Magdiwata Eco Farm and Resort</p>
            </div>

            <!-- FAQ Categories -->
            <div class="space-y-8">
                <!-- Booking & Reservations -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Booking & Reservations
                    </h2>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">How do I book a room or activity?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                You can book directly through our website using the "Book Room" or "Book Activity" buttons. No registration is required - simply fill out the booking form with your details and preferred dates.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Do I need to create an account to book?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                No, you don't need to create an account to make a booking. Our system allows guest bookings for your convenience. However, creating an account allows you to manage your bookings and receive updates.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">What is your cancellation policy?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Cancellations made 48 hours before your scheduled arrival or activity date are fully refundable. Late cancellations may incur a 50% charge. Please contact us directly for any cancellation requests.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">How far in advance should I book?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We recommend booking at least 1-2 weeks in advance, especially during peak seasons (December to May). For weekends and holidays, booking 2-3 weeks ahead is advisable.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Accommodation -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        Accommodation
                    </h2>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">What types of accommodation do you offer?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We offer four types of accommodation: Native Kubo Huts (traditional Filipino huts), Mountain Cottages, Forest Cabins, and Premium Suites. Each option provides a unique experience with different amenities and comfort levels.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Are the accommodations air-conditioned?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Our Premium Suites and Mountain Cottages are air-conditioned. The Native Kubo Huts and Forest Cabins are designed for natural ventilation, taking advantage of the cool mountain breeze. All accommodations have comfortable bedding and essential amenities.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Do you provide linens and towels?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Yes, all accommodations come with fresh linens, towels, and basic toiletries. We maintain high cleanliness standards and provide daily housekeeping services.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Is there a maximum occupancy per room?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Room capacities vary: Kubo Huts (2-3 persons), Mountain Cottages (2-4 persons), Forest Cabins (2-4 persons), and Premium Suites (2-6 persons). Please specify your group size when booking.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Activities & Experiences -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Activities & Experiences
                    </h2>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">What activities are available?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We offer Paintball Battles, Rappelling, Guided Hikes, and Organic Farm Tours. Each activity is designed to provide both adventure and educational experiences about our natural environment.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Are activities suitable for children?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Most activities are family-friendly. Guided Hikes and Farm Tours are suitable for all ages. Paintball has age restrictions (12+ years), and Rappelling requires parental consent for minors. We also offer special children's programs.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Do you provide equipment for activities?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Yes, we provide all necessary safety equipment and gear for each activity. This includes helmets, harnesses, paintball equipment, and hiking gear. Our staff ensures all equipment is properly fitted and maintained.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">What should I bring for activities?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Comfortable clothing, closed-toe shoes, sunscreen, and water are recommended. For specific activities, we'll provide detailed requirements when you book. We also have a small shop with essential items.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Location & Transportation -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Location & Transportation
                    </h2>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Where is Mt. Magdiwata located?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Mt. Magdiwata Eco Farm and Resort is located in Surigao del Sur, Philippines. We're situated in the mountains, offering stunning views and a peaceful natural environment away from the city.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">How do I get to the resort?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We're accessible by road from major cities in Mindanao. You can reach us by private vehicle, public transportation, or we can arrange pickup services from designated meeting points. Detailed directions are provided upon booking confirmation.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Is parking available?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Yes, we provide free parking for guests. Our parking area is secure and can accommodate cars, motorcycles, and small buses. We also have covered parking spaces available.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Do you offer transportation services?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We can arrange transportation services from nearby cities and airports for an additional fee. Please contact us at least 24 hours in advance to arrange pickup services.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- General Information -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        General Information
                    </h2>

                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">What are your operating hours?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We're open daily from 6:00 AM to 10:00 PM. Check-in time is 2:00 PM, and check-out time is 11:00 AM. Activities are scheduled throughout the day, with specific times provided upon booking.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Do you have WiFi and mobile signal?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We provide WiFi in common areas and Premium Suites. Mobile signal varies by carrier but is generally available. We encourage guests to disconnect and enjoy the natural surroundings.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">What dining options are available?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We have a restaurant serving local and international cuisine, with ingredients sourced from our organic farm. We also offer picnic baskets for outdoor dining and can accommodate special dietary requirements with advance notice.
                            </p>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">Is the resort pet-friendly?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We welcome well-behaved pets in designated areas. Please inform us in advance if you're bringing a pet, and ensure they're kept on a leash in public areas. Additional cleaning fees may apply.
                            </p>
                        </div>

                        <div class="pb-6">
                            <h3 class="text-lg font-semibold text-magdiwata-900 mb-3">What should I do if I have more questions?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                If you have additional questions not covered here, please contact us directly. You can reach our customer service team through our website contact form, by phone, or by email. We're happy to help!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="mt-12 text-center">
                <div class="bg-magdiwata-50 rounded-2xl p-8">
                    <h2 class="text-2xl font-bold text-magdiwata-900 mb-4">Still Have Questions?</h2>
                    <p class="text-gray-600 mb-6">Can't find what you're looking for? Contact our friendly team for assistance.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/" class="bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                            Return to Home
                        </a>
                        <a href="{{ route('book') }}" class="bg-white border-2 border-magdiwata-900 text-magdiwata-900 hover:bg-magdiwata-900 hover:text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
