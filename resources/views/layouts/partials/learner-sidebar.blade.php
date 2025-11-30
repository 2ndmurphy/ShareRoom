<aside class="hidden md:flex md:flex-col w-64 bg-white border-r border-gray-200 text-gray-800
               fixed inset-y-0 left-0 z-40">

    {{-- Logo + Title --}}
    <div class="px-6 py-5 flex items-center gap-3">
        <img src="{{ asset('images/icons/shareroom-icon.webp') }}" alt="shareroom-icon" class="w-12 h-12 object-contain">
        <div>
            <p class="text-l font-semibold text-teal-500">ShareRoom</p>
            <p class="text-xl font-semibold leading-tight">Learner Area</p>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="mt-8 flex-1 space-y-1">
        {{-- Dashboard --}}
        @auth
        <a href="{{ route('learner.dashboard.index') }}"
           class="group flex items-center gap-3 px-6 py-3 text-sm font-medium
                  {{ request()->routeIs('mentor.dashboard.index') 
                        ? 'text-teal-600' 
                        : 'text-gray-500 hover:text-gray-900' }}">
            <div class="h-11 w-11 flex items-center justify-center rounded-2xl
                        {{ request()->routeIs('mentor.dashboard.index') 
                            ? 'bg-teal-50 text-teal-600' 
                            : 'bg-gray-50 group-hover:bg-gray-100 text-gray-500 group-hover:text-gray-900' }}">
                {{-- icon home --}}
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M3 11.25L12 4l9 7.25M5.25 10.5V20h4.5v-4.5h4.5V20h4.5v-9.5" />
                </svg>
            </div>
            <span>Dashboard</span>
        </a>
        @endauth

        {{-- Profil Mentor --}}
        @auth
        <a href="{{ route('explore.index', auth()->user()) }}"
           class="group flex items-center gap-3 px-6 py-3 text-sm font-medium
                  {{ request()->routeIs('mentor.profile.edit') 
                        ? 'text-teal-600' 
                        : 'text-gray-500 hover:text-gray-900' }}">
            <div class="h-11 w-11 flex items-center justify-center rounded-2xl
                        {{ request()->routeIs('mentor.profile.edit') 
                            ? 'bg-teal-50 text-teal-600' 
                            : 'bg-gray-50 group-hover:bg-gray-100 text-gray-500 group-hover:text-gray-900' }}">
                {{-- icon user --}}
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4.75 20a7.25 7.25 0 0114.5 0" />
                </svg>
            </div>
            <span>Explore</span>
        </a>
        @endauth

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-6 px-6">
            @csrf
            <button type="submit"
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="w-full group flex items-center gap-3 text-sm font-medium text-gray-500 hover:text-red-600">
                <div class="h-11 w-11 flex items-center justify-center rounded-2xl bg-gray-50 group-hover:bg-red-50 group-hover:text-red-600 text-gray-500">
                    {{-- icon logout --}}
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M15.75 8.25L19.5 12m0 0l-3.75 3.75M19.5 12h-9M10.5 5.25H7.875A2.625 2.625 0 005.25 7.875v8.25A2.625 2.625 0 007.875 18.75H10.5" />
                    </svg>
                </div>
                <span>Log out</span>
            </button>
        </form>
    </nav>
</aside>
