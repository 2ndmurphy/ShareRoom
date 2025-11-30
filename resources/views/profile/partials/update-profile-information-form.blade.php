<section class="space-y-6">
    @php
        $currentUser = auth()->user();
    @endphp

    {{-- HEADER --}}
    <header class="flex items-start gap-3">
        <div class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-teal-50 text-teal-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3zm0 2c-2.21 0-4 1.343-4 3v1h8v-1c0-1.657-1.79-3-4-3z" />
            </svg>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>
    </header>

    {{-- FORM VERIFIKASI EMAIL (HIDDEN) --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- FORM UPDATE PROFILE --}}
    <form method="POST" action="{{ route('profile.update') }}" class="mt-4 space-y-6">
        @csrf
        @method('PATCH')

        {{-- NAME --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Name') }}
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $currentUser?->name) }}"
                required
                autofocus
                autocomplete="name"
                class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm
                       focus:border-teal-500 focus:ring-2 focus:ring-teal-500"
            >

            @foreach ($errors->get('name') as $message)
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @endforeach
        </div>

        {{-- EMAIL --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Email') }}
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $currentUser?->email) }}"
                required
                autocomplete="username"
                class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm
                       focus:border-teal-500 focus:ring-2 focus:ring-teal-500"
            >

            @foreach ($errors->get('email') as $message)
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @endforeach

            @if ($currentUser instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $currentUser->hasVerifiedEmail())
                <div class="mt-3 rounded-lg bg-amber-50 border border-amber-100 px-4 py-3 text-xs text-amber-800">
                    <p class="mb-2">
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button
                        form="send-verification"
                        type="submit"
                        class="inline-flex items-center text-xs font-semibold text-teal-700 hover:text-teal-800 underline-offset-2 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1 rounded"
                    >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-xs text-emerald-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- ACTIONS --}}
        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-full bg-teal-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1"
            >
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
