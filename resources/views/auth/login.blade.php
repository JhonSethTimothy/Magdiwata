<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-magdiwata-900">Admin Login</h1>
        <p class="text-gray-500">Welcome back! Please sign in to continue.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-magdiwata-700">Email Address</label>
            <input id="email" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 space-y-2">
            <label for="password" class="block text-sm font-medium text-magdiwata-700">Password</label>
            <input id="password" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-magdiwata-500 focus:border-transparent"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-magdiwata-600 shadow-sm focus:ring-magdiwata-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-magdiwata-700 hover:text-magdiwata-900" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-magdiwata-900 hover:bg-magdiwata-800 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                Sign In
            </button>
        </div>
    </form>
</x-guest-layout>
