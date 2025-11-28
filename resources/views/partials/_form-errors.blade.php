@if ($errors->any())
    <div class="mb-6 p-4 rounded-2xl border border-rose-200 bg-rose-50">
        <div class="flex items-start">
            
            {{-- ICON --}}
            <div class="flex-shrink-0">
                <div class="h-9 w-9 flex items-center justify-center rounded-full bg-rose-100 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v3m0 4h.01m-6.938 0h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4a2 2 0 00-3.464 0L3.34 13c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            {{-- TEXT --}}
            <div class="ml-4">
                <h3 class="text-sm font-semibold text-rose-700">
                    Ada beberapa kesalahan, silakan cek kembali:
                </h3>

                <ul class="mt-2 space-y-1 text-sm text-rose-600">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-start gap-2">
                            <span class="text-rose-500">•</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endif
