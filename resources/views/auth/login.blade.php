<x-guest-layout>
    <h2 class="text-center text-4xl font-bold text-white mb-8">
        Sign In
    </h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email / Username --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="sr-only" />
            <x-text-input id="email"
                class="block w-full rounded-full border-0 px-6 py-4 text-lg text-gray-700 shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="email"
                placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-base text-white" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" class="sr-only" />
            <x-text-input id="password"
                class="block w-full rounded-full border-0 px-6 py-4 text-lg text-gray-700 shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
                type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-base text-white" />
        </div>

        {{-- Remember --}}
        <div class="flex items-center justify-between text-base text-teal-50/90">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-white/40 bg-teal-400 text-teal-600 shadow-sm focus:ring-2 focus:ring-offset-0 focus:ring-white"
                    name="remember">
                <span class="ms-2">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        {{-- Login --}}
        <div class="pt-2">
            <button type="submit"
                class="w-full rounded-full bg-white py-4 text-xl font-bold text-teal-500 hover:bg-teal-50 focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                Login
            </button>
        </div>

        {{-- Sign Up --}}
        <p class="mt-6 text-center text-base text-teal-50/90">
            Don’t have an account?
            <a href="{{ route('register') }}" class="font-semibold text-white hover:underline">
                Sign Up
            </a>
        </p>
    </form>
</x-guest-layout>