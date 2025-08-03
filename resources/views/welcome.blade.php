    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mt. Magdiwata Eco Farm and Resort - Reconnect. Explore. Discover.</title>
    <meta name="description" content="Experience the beauty of Mt. Magdiwata Eco Farm and Resort in Surigao del Sur. Discover adventure, wildlife, and natural wonders.">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Nunito', sans-serif;
        }
        .hero-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/qcover.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Ripple effect styles */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(37, 71, 28, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Active state styles */
        .nav-link.active {
            background-color: #e8e4d8;
            color: #25471c;
            font-weight: 600;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#hero" class="block">
                        <img src="/images/logo.png.png" alt="Mt. Magdiwata Eco Farm and Resort" class="h-16 w-auto">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#hero" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="hero">Home</a>
                    <a href="#experiences" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="experiences">Experiences</a>
                    <a href="#about" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="about">About</a>
                    <a href="#rooms" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="rooms">Rooms</a>
                    <a href="#activities" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="activities">Activities</a>
                    <a href="#wildlife" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="wildlife">Wildlife</a>
                    <a href="#gallery" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="gallery">Gallery</a>
                    <a href="#location" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="location">Location</a>
                    <a href="{{ route('faq') }}" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 transform hover:scale-105 active:scale-95">FAQ</a>

                    <!-- Authentication Buttons -->
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="bg-magdiwata-700 hover:bg-magdiwata-800 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">Admin Dashboard</a>
                                @endif
                                <a href="{{ url('/dashboard') }}" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-magdiwata-700 hover:text-magdiwata-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                        Logout
                                    </button>
                                </form>
                            @endauth
                        </div>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-forest-700 hover:text-forest-900" id="mobile-menu-button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="#hero" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="hero">Home</a>
                    <a href="#experiences" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="experiences">Experiences</a>
                    <a href="#about" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="about">About</a>
                    <a href="#rooms" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="rooms">Rooms</a>
                    <a href="#activities" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="activities">Activities</a>
                    <a href="#wildlife" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="wildlife">Wildlife</a>
                    <a href="#gallery" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="gallery">Gallery</a>
                    <a href="#location" class="nav-link text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95" data-section="location">Location</a>
                    <a href="{{ route('faq') }}" class="text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium transition-all duration-300 transform hover:scale-105 active:scale-95">FAQ</a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-magdiwata-700 hover:text-magdiwata-900 block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="text-magdiwata-700 hover:text-magdiwata-900 block w-full text-left px-3 py-2 rounded-md text-base font-medium">
                                    Logout
                                </button>
                            </form>
                        @else
                            {{-- Register removed --}}
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero-bg min-h-screen flex items-center justify-center relative" style="background-image: url('/images/bcover.png');">
        <div class="text-center text-white px-4" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 drop-shadow-2xl">
                Mt. Magdiwata Eco Farm and Resort
            </h1>
            <p class="text-xl md:text-2xl mb-8 drop-shadow-lg text-white">
                Reconnect. Explore. Discover.
            </p>
            <div class="space-x-4">
                <a href="{{ route('book') }}" class="inline-block bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-4 px-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Book Now
                </a>
                <a href="#about" class="inline-block bg-transparent border-2 border-white text-white font-semibold py-4 px-8 rounded-2xl hover:bg-white hover:text-magdiwata-900 transition-all duration-300">
                    Learn More
                </a>
            </div>
        </div>
    </section>
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Experiences Section -->
    <section id="experiences" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Top Experiences</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Discover the unique attractions that make Mt. Magdiwata a must-visit destination</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Camp Ambiance -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 rounded-t-2xl flex items-center justify-center overflow-hidden">
                        <img src="/images/camp-ambiance.png" alt="Camp Ambiance" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-magdiwata-900 mb-3">Camp Ambiance</h3>
                        <p class="text-gray-600">Immerse yourself in the peaceful mountain atmosphere with our perfectly curated camping experience under the stars.</p>
                    </div>
                </div>

                <!-- Natural Infinity Pool -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 rounded-t-2xl flex items-center justify-center overflow-hidden">
                        <img src="/images/natural-forest-pool.jpg" alt="Natural Forest Pool" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-magdiwata-900 mb-3">Natural Forest Pool</h3>
                        <p class="text-gray-600">Swim in our natural forest pool that seamlessly blends with the mountain landscape, offering a unique swimming experience.</p>
                    </div>
                </div>

                <!-- Nightlife: Bonfire -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 rounded-t-2xl flex items-center justify-center overflow-hidden">
                        <img src="/images/bonfires.png" alt="Nightlife: Bonfire" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-magdiwata-900 mb-3">Nightlife: Bonfire</h3>
                        <p class="text-gray-600">Gather around our cozy bonfire for an unforgettable evening of stories, music, and stargazing in the crisp mountain air.</p>
                    </div>
                </div>

                <!-- Native Kubo Huts -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="400">
                    <div class="h-48 rounded-t-2xl flex items-center justify-center overflow-hidden">

                             <img src="/images/native-kubo.jpg" alt="Native Kubo" class="w-full h-full object-cover">
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-magdiwata-900 mb-3">Native Kubo Huts</h3>
                        <p class="text-gray-600">Stay in traditional Filipino kubos built with native materials, offering authentic cultural accommodation experiences.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative rounded-2xl overflow-hidden shadow-xl" data-aos="fade-right">
                    <img src="/images/magdiwata-about.jpg" alt="Mt. Magdiwata Eco Farm and Resort" class="w-full h-auto rounded-2xl transform hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent rounded-2xl"></div>
                    <div class="absolute bottom-0 left-0 p-8 text-white">
                        <h3 class="text-2xl font-bold mb-2">Experience Nature's Beauty</h3>
                        <p class="text-gray-200">Discover the magic of Mt. Magdiwata</p>
                    </div>
                </div>
                <div data-aos="fade-left">
                    <h2 class="text-4xl font-bold text-magdiwata-900 mb-6">About Mt. Magdiwata Eco Farm and Resort</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Nestled in the heart of Surigao del Sur, Mt. Magdiwata Eco Farm and Resort is a lush, biodiverse eco-sanctuary that offers visitors a unique opportunity to reconnect with nature while experiencing authentic Filipino hospitality.
                    </p>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Our mountain retreat spans across pristine landscapes, featuring diverse ecosystems, native wildlife, and sustainable farming practices. From the majestic Philippine Eagle soaring overhead to the gentle Mindanao Bleeding Heart Dove, our sanctuary is a haven for both adventure seekers and nature enthusiasts.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Whether you're seeking thrilling outdoor activities, peaceful nature walks, or simply want to immerse yourself in the beauty of the Philippine mountains, Mt. Magdiwata offers an unforgettable experience that celebrates the harmony between adventure and conservation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Our Accommodations</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Choose from a variety of rooms that blend comfort with nature.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Room Card 1: Native Kubo Hut (Standard) -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <img src="/images/native-kubo.jpg" alt="Native Kubo Hut (Standard)" class="w-full h-48 object-cover rounded-t-2xl">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-magdiwata-900">Native Kubo Hut (Standard)</h3>
                            <span class="text-lg font-semibold text-magdiwata-700">₱500</span>
                        </div>
                        <p class="text-gray-600 mb-4">Experience authentic Filipino living in our traditional Kubo huts, made with native materials. Perfect for budget-conscious travelers.</p>
                        <a href="{{ route('book') }}" class="font-semibold text-magdiwata-700 hover:text-magdiwata-900 inline-flex items-center">Book Now
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Room Card 2: Native Kubo Hut (Premium) -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <img src="/images/native-kubo-premium.jpg" alt="Native Kubo Hut (Premium)" class="w-full h-48 object-cover rounded-t-2xl">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-magdiwata-900">Native Kubo Hut (Premium)</h3>
                            <span class="text-lg font-semibold text-magdiwata-700">₱600</span>
                        </div>
                        <p class="text-gray-600 mb-4">Upgrade to our premium Kubo huts featuring enhanced amenities and more space while maintaining the authentic Filipino charm.</p>
                        <a href="{{ route('book') }}" class="font-semibold text-magdiwata-700 hover:text-magdiwata-900 inline-flex items-center">Book Now
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities Section -->
    <section id="activities" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Choose Your Adventure</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">From adrenaline-pumping activities to peaceful nature experiences, find your perfect adventure</p>
            </div>

            <div class="max-w-2xl mx-auto">
                <!-- Organic Farm Tours -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-64 bg-gradient-to-br from-amber-500 to-amber-700 rounded-t-2xl flex items-center justify-center">
                        <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold text-magdiwata-900 mb-4">Organic Farm Tours</h3>
                    <p class="text-gray-600 mb-6 text-lg">Immerse yourself in sustainable agriculture with our guided farm tours. Learn about organic farming practices, interact with farm animals, and taste fresh, seasonal produce straight from our mountain gardens.</p>
                    <a href="{{ route('book') }}" class="inline-block bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300 text-lg">Book Your Adventure</a>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Food & Drinks Section -->
    <section id="food" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Food & Drinks</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Savor authentic Filipino flavors with our delicious meals and refreshing drinks</p>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <!-- Food Image -->
                    <div class="relative rounded-2xl overflow-hidden shadow-xl h-96 lg:h-full" data-aos="fade-right">
                        <img src="/images/silog.jpg" alt="Delicious Filipino Cuisine" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 text-white">
                            <h3 class="text-2xl font-bold mb-2">Taste of the Philippines</h3>
                            <p class="text-gray-200">Authentic local flavors made with fresh ingredients</p>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden h-full" data-aos="fade-left">
                        <div class="p-8">
                        <h3 class="text-2xl font-bold text-magdiwata-900 mb-6 text-center">Our Menu</h3>

                        <div class="mb-8">
                            <h4 class="text-xl font-semibold text-magdiwata-800 mb-4 border-b pb-2">Silog Meals <span class="text-lg font-normal">(Served with garlic rice and egg)</span></h4>
                            <ul class="space-y-3">
                                <li class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-800">Tapsilog</span>
                                    <span class="font-semibold text-magdiwata-700">₱120</span>
                                </li>
                                <li class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-800">Cornsilog</span>
                                    <span class="font-semibold text-magdiwata-700">₱120</span>
                                </li>
                                <li class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-800">Hotsilog</span>
                                    <span class="font-semibold text-magdiwata-700">₱120</span>
                                </li>
                                <li class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-800">Tocilog (Chicken)</span>
                                    <span class="font-semibold text-magdiwata-700">₱120</span>
                                </li>
                                <li class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-800">Tocilog (Pork)</span>
                                    <span class="font-semibold text-magdiwata-700">₱120</span>
                                </li>
                                <li class="flex justify-between items-center py-2">
                                    <span class="text-gray-800">Sisiglog</span>
                                    <span class="font-semibold text-magdiwata-700">₱120</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="text-xl font-semibold text-magdiwata-800 mb-4 border-b pb-2">Drinks</h4>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-800">Calamansi Juice (Pitcher)</span>
                                <span class="font-semibold text-magdiwata-700">₱40</span>
                            </div>
                        </div>

                        <div class="mt-8 text-center">
                            <p class="text-gray-600 mb-4">All meals are freshly prepared upon order</p>
                            <a href="{{ route('book') }}" class="inline-block bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">Book Your Stay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wildlife Section -->
    <section id="wildlife" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Native Wildlife</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Discover the incredible biodiversity of Mt. Magdiwata and learn about our conservation efforts</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Philippine Eagle -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300" data-aos="fade-right">
                    <div class="h-64 bg-gradient-to-br from-amber-400 to-amber-600 rounded-t-2xl flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"></path>
                        </svg>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-forest-800 mb-4">Philippine Eagle</h3>
                        <p class="text-gray-600 mb-4">The majestic Philippine Eagle, one of the world's largest and most powerful eagles, can be spotted soaring above our mountain peaks. This critically endangered species is a symbol of our commitment to wildlife conservation.</p>
                        <div class="bg-amber-50 p-4 rounded-lg">
                            <p class="text-sm text-amber-800"><strong>Conservation Status:</strong> Critically Endangered</p>
                            <p class="text-sm text-amber-800"><strong>Habitat:</strong> Primary and secondary forests</p>
                        </div>
                    </div>
                </div>

                <!-- Mindanao Bleeding Heart Dove -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300" data-aos="fade-left">
                    <div class="h-64 bg-gradient-to-br from-pink-400 to-pink-600 rounded-t-2xl flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-forest-800 mb-4">Mindanao Bleeding Heart Dove</h3>
                        <p class="text-gray-600 mb-4">This beautiful endemic dove, named for its distinctive red breast patch, is a rare sight in the wild. Our protected habitats provide a safe haven for these gentle birds to thrive in their natural environment.</p>
                        <div class="bg-pink-50 p-4 rounded-lg">
                            <p class="text-sm text-pink-800"><strong>Conservation Status:</strong> Near Threatened</p>
                            <p class="text-sm text-pink-800"><strong>Habitat:</strong> Lowland and montane forests</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
        </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Photo Gallery</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Explore the stunning beauty of Mt. Magdiwata through our curated collection of photographs</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Gallery Placeholder Cards -->
                <div class="bg-gradient-to-br from-magdiwata-400 to-magdiwata-600 rounded-2xl h-64 flex items-center justify-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-lg font-semibold">Mountain Views</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-magdiwata-500 to-magdiwata-700 rounded-2xl h-64 flex items-center justify-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-lg font-semibold">Adventure Activities</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-magdiwata-600 to-magdiwata-800 rounded-2xl h-64 flex items-center justify-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <p class="text-lg font-semibold">Accommodations</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-magdiwata-300 to-magdiwata-500 rounded-2xl h-64 flex items-center justify-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-lg font-semibold">Organic Farm</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-magdiwata-400 to-magdiwata-600 rounded-2xl h-64 flex items-center justify-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"></path>
                        </svg>
                        <p class="text-lg font-semibold">Wildlife</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-magdiwata-500 to-magdiwata-700 rounded-2xl h-64 flex items-center justify-center shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-lg font-semibold">Events</p>
                    </div>
                </div>
            </div>
        </div>
        </section>

    <!-- Location Section -->
    <section id="location" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Location & Directions</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Find your way to our eco-sanctuary in the heart of Surigao del Sur</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="bg-gradient-to-br from-magdiwata-400 to-magdiwata-700 rounded-2xl h-96 flex items-center justify-center shadow-md">
                        <div class="text-center text-white">
                            <svg class="w-24 h-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-xl font-semibold">Interactive Map</p>
                            <p class="text-sm opacity-90">Coming Soon</p>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left">
                    <div class="space-y-6">
                        <div class="bg-white rounded-2xl p-6 shadow-md">
                            <h3 class="text-2xl font-bold text-magdiwata-900 mb-4">Address</h3>
                            <p class="text-gray-600 text-lg">Mt. Magdiwata, San Francisco, Agusan del Sur, Philippines</p>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-md">
                            <h3 class="text-2xl font-bold text-magdiwata-900 mb-4">Getting There</h3>
                            <div class="space-y-3 text-gray-600">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-6 h-6 text-magdiwata-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <div>
                                        <p class="font-semibold">By Air</p>
                                        <p>Fly to Butuan Airport, then take a 2-hour drive to our location</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <svg class="w-6 h-6 text-magdiwata-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                    <div>
                                        <p class="font-semibold">By Land</p>
                                        <p>Take a bus from major cities to San Francisco, then arrange for pickup</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <svg class="w-6 h-6 text-magdiwata-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
                                    </svg>
                <div>
                                        <p class="font-semibold">Private Vehicle</p>
                                        <p>Drive to San Francisco and follow signs to Mt. Magdiwata</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-md">
                            <h3 class="text-2xl font-bold text-magdiwata-900 mb-4">Contact for Directions</h3>
                            <p class="text-gray-600 mb-3">Need help finding us? Contact our team for detailed directions and pickup arrangements.</p>
                            <a href="tel:+639123456789" class="inline-block bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300">
                                Call for Directions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ratings & Reviews Section -->
    <section id="reviews" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-magdiwata-900 mb-4">Guest Reviews</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">See what our guests are saying about their experience</p>

                <!-- Overall Rating -->
                <div class="mt-8 flex items-center justify-center space-x-2">
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-2xl font-bold text-gray-800">4.8</span>
                    <span class="text-gray-500">(128 reviews)</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-magdiwata-100 flex items-center justify-center text-magdiwata-700 font-bold text-xl">JD</div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Juan D.</h4>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"The Native Kubo Huts were amazing! Perfect blend of comfort and nature. The bonfire at night was the highlight of our stay."</p>
                    <p class="text-sm text-gray-500 mt-3">Stayed in Native Kubo Hut • July 2024</p>
                </div>

                <!-- Review 2 -->
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-magdiwata-100 flex items-center justify-center text-magdiwata-700 font-bold text-xl">MS</div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Maria S.</h4>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"The food was absolutely delicious! We tried all the silog meals and each one was better than the last. The calamansi juice was so refreshing!"</p>
                    <p class="text-sm text-gray-500 mt-3">Visited for Day Tour • June 2024</p>
                </div>

                <!-- Review 3 -->
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-magdiwata-100 flex items-center justify-center text-magdiwata-700 font-bold text-xl">CR</div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">Carlos R.</h4>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 4; $i++)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"The camp ambiance was perfect for our family getaway. The kids loved the natural pool and we enjoyed the peaceful surroundings. Will definitely be back!"</p>
                    <p class="text-sm text-gray-500 mt-3">Family Staycation • May 2024</p>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-magdiwata-700 bg-magdiwata-100 hover:bg-magdiwata-200 transition-colors duration-300">
                    Leave a Review
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-magdiwata-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">Mt. Magdiwata Eco Farm and Resort</h3>
                    <p class="text-gray-300 mb-4">Experience the beauty of nature in its purest form. Reconnect with the environment and discover adventure in the heart of Surigao del Sur.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#hero" class="text-gray-300 hover:text-white transition-colors duration-300">Home</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-white transition-colors duration-300">About</a></li>
                        <li><a href="#experiences" class="text-gray-300 hover:text-white transition-colors duration-300">Experiences</a></li>
                        <li><a href="#activities" class="text-gray-300 hover:text-white transition-colors duration-300">Activities</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Services</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Accommodation</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Adventure Tours</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Farm Tours</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Events</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-300">Surigao del Sur</li>
                        <li class="text-gray-300">Philippines</li>
                        <li><a href="tel:+639123456789" class="text-gray-300 hover:text-white transition-colors duration-300">+63 912 345 6789</a></li>
                        <li><a href="mailto:info@magdiwata.com" class="text-gray-300 hover:text-white transition-colors duration-300">info@magdiwata.com</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-magdiwata-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">&copy; 2025 Mt. Magdiwata Eco Farm and Resort. All rights reserved.</p>
            </div>
    </div>
    </footer>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Navigation click effects and active state management
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section[id]');

            // Add click effect to navigation links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add click animation
                    this.style.transform = 'scale(0.95)';
                    this.style.backgroundColor = '#e8e4d8';

                    // Reset after animation
                    setTimeout(() => {
                        this.style.transform = '';
                        this.style.backgroundColor = '';
                    }, 150);

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                });

                // Add ripple effect on click
                link.addEventListener('mousedown', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Update active navigation link based on scroll position
            function updateActiveNavLink() {
                const scrollPosition = window.scrollY + 100;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const sectionId = section.getAttribute('id');

                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                                                // Remove active class from all links
                        navLinks.forEach(link => {
                            link.classList.remove('text-magdiwata-900', 'bg-magdiwata-100');
                            link.classList.add('text-magdiwata-700');
                        });

                        // Add active class to current section link
                        const activeLink = document.querySelector(`[data-section="${sectionId}"]`);
                        if (activeLink) {
                            activeLink.classList.remove('text-magdiwata-700');
                            activeLink.classList.add('text-magdiwata-900', 'bg-magdiwata-100');
                        }
                    }
                });
            }

            // Listen for scroll events
            window.addEventListener('scroll', updateActiveNavLink);

            // Initial call to set active state
            updateActiveNavLink();
        });
    </script>
</body>
</html>
