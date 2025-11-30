<section class="space-y-6">
    {{-- HEADER --}}
    <header>
        <h2 class="text-lg font-semibold text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    {{-- FORM --}}
    <form method="POST" action="{{ route('password.update') }}" class="mt-4 space-y-6">
        @csrf
        @method('PUT')

        {{-- CURRENT PASSWORD --}}
        <div>
            <label for="update_password_current_password"
                   class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Current Password') }}
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm
                       focus:border-teal-500 focus:ring-2 focus:ring-teal-500"
            >

            @foreach ($errors->updatePassword->get('current_password') as $message)
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @endforeach
        </div>

        {{-- NEW PASSWORD --}}
        <div>
            <label for="update_password_password"
                   class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('New Password') }}
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm
                       focus:border-teal-500 focus:ring-2 focus:ring-teal-500"
            >

            @foreach ($errors->updatePassword->get('password') as $message)
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @endforeach
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div>
            <label for="update_password_password_confirmation"
                   class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Confirm Password') }}
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm
                       focus:border-teal-500 focus:ring-2 focus:ring-teal-500"
            >

            @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @endforeach
        </div>

        {{-- ACTIONS --}}
        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-full bg-teal-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1"
            >
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
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
