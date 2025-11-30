<section
    x-data="{ open: @js($errors->userDeletion->isNotEmpty()) }"
    class="space-y-6"
>
    {{-- HEADER --}}
    <header class="flex items-start gap-4">
        <div
            class="mt-1 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-50 text-rose-500 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a1.75 1.75 0 001.51 2.62h17.34A1.75 1.75 0 0022.18 18L13.71 3.86a1.75 1.75 0 00-3.42 0z" />
            </svg>
        </div>

        <div class="flex-1">
            <div class="inline-flex items-center gap-2 rounded-full border border-rose-100 bg-rose-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-rose-600">
                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                {{ __('Danger Zone') }}
            </div>

            <h2 class="mt-3 text-lg font-semibold text-gray-900">
                {{ __('Delete Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Make sure you have downloaded any information you want to keep.') }}
            </p>

            <div class="mt-4 rounded-xl border border-rose-100 bg-rose-50/70 px-4 py-3 text-xs text-rose-700">
                <ul class="list-disc list-inside space-y-1">
                    <li>{{ __('You will lose access to all rooms, materials, and saved data.') }}</li>
                    <li>{{ __('This action cannot be undone and cannot be recovered later.') }}</li>
                </ul>
            </div>
        </div>
    </header>

    {{-- TRIGGER BUTTON --}}
    <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-gray-100">
        <p class="text-xs text-gray-500">
            {{ __('If you are absolutely sure, click the button below to start the deletion process.') }}
        </p>

        <button
            type="button"
            @click="open = true"
            class="inline-flex items-center gap-2 rounded-full bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-1"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862A2 2 0 016.867 19L6 7m5-3h2a1 1 0 011 1v1H10V5a1 1 0 011-1z" />
            </svg>
            <span>{{ __('Delete Account') }}</span>
        </button>
    </div>

    {{-- MODAL --}}
    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center"
        aria-modal="true"
        role="dialog"
    >
        {{-- BACKDROP --}}
        <div class="fixed inset-0 bg-black/40" @click="open = false"></div>

        {{-- CARD --}}
        <div class="relative z-10 w-full max-w-lg rounded-3xl bg-white p-6 md:p-7 shadow-xl border border-gray-200">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="flex items-start gap-3">
                    <div class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-rose-50 text-rose-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a1.75 1.75 0 001.51 2.62h17.34A1.75 1.75 0 0022.18 18L13.71 3.86a1.75 1.75 0 00-3.42 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('This action will permanently delete your account and all related data. Please confirm using your current password.') }}
                        </p>
                    </div>
                </div>

                {{-- PASSWORD --}}
                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('Password') }}
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full max-w-sm rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 text-sm"
                        placeholder="{{ __('Enter your password') }}"
                        autocomplete="current-password"
                    >

                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ACTIONS --}}
                <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <button
                        type="button"
                        @click="open = false"
                        class="inline-flex items-center justify-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-full bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-1"
                    >
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
    