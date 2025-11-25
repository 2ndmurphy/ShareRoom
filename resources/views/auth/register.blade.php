<x-guest-layout>
    <h2 class="text-center text-4xl font-bold text-white mb-8">
        Sign Up
    </h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" class="sr-only" />
            <x-text-input
                id="name"
                class="block w-full rounded-full border-0 px-6 py-4 text-lg text-gray-700 shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                placeholder="Name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-white text-base" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="sr-only" />
            <x-text-input
                id="email"
                class="block w-full rounded-full border-0 px-6 py-4 text-lg text-gray-700 shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="email"
                placeholder="Email"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-white text-base" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" class="sr-only" />
            <x-text-input
                id="password"
                class="block w-full rounded-full border-0 px-6 py-4 text-lg text-gray-700 shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-white text-base" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="sr-only" />
            <x-text-input
                id="password_confirmation"
                class="block w-full rounded-full border-0 px-6 py-4 text-lg text-gray-700 shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirm Password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-white text-base" />
        </div>

        {{-- Button --}}
        <div class="pt-2">
            <button
                type="submit"
                class="w-full rounded-full bg-white py-4 text-xl font-bold text-teal-500 hover:bg-teal-50 focus:ring-2 focus:ring-teal-500 focus:outline-none transition">
                Sign Up
            </button>
        </div>

        {{-- Already registered --}}
        <p class="mt-6 text-center text-base text-teal-50/90">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-white hover:underline">
                Sign In
            </a>
        </p>
    </form>
</x-guest-layout>
