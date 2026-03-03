<nav x-data="{ open: false }" class="bg-[#3A7D44] shadow-md sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto" alt="Logo">
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-4 md:flex md:ml-10">
                    @php $userRoleId = Auth::user()->role_id; @endphp

                    {{-- 1. Dashboard (Semua role) --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- 2. Kelola User (Hanya Admin) --}}
                    @if ($userRoleId == 1)
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-200 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                    <div>Kelola User</div>
                                    <div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('users.index')">Daftar User</x-dropdown-link>
                                <x-dropdown-link :href="route('userlokasi.index')">User Lokasi</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif

                    {{-- 3. Sistem Deteksi (Admin, POPT) --}}
                    @if (in_array($userRoleId, [2]))
                        <x-nav-link :href="route('prediksi.form')" :active="request()->routeIs('prediksi.*')">
                            {{ __('Sistem Deteksi') }}
                        </x-nav-link>
                    @endif

                    {{-- 4. Laporan Peringatan Bahaya (Admin, Kepala LPHP) --}}
                    @if (in_array($userRoleId, [1, 2, 7]))
                         <x-nav-link :href="route('lpb.index')" :active="request()->routeIs('lpb.*')">
                            {{ __('Laporan Peringatan Bahaya') }}
                        </x-nav-link>
                    @endif
                    
                    {{-- 5. Dropdown Diagnosa & Rekomendasi --}}
                    @if (in_array($userRoleId, [1, 2, 3, 4, 5, 6, 7]))
                        <x-dropdown align="left" width="64">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-200 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                    <div>Diagnosa & Rekomendasi</div>
                                    <div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @if (in_array($userRoleId, [1, 2, 3, 4, 7]))
                                    <x-dropdown-link :href="route('permohonan.index')">Permohonan Diagnosa</x-dropdown-link>
                                @endif
                                @if (in_array($userRoleId, [1, 2, 3, 4, 5, 6, 7]))
                                    <x-dropdown-link :href="route('diagnosa.index')">Daftar Diagnosa</x-dropdown-link>
                                @endif
                                @if (in_array($userRoleId, [4]))
                                    <div class="border-t border-gray-200"></div>
                                    <div class="block px-4 py-2 text-xs text-gray-400">Data Master</div>
                                    <x-dropdown-link :href="route('jenis.index')">Jenis Tanaman</x-dropdown-link>
                                    <x-dropdown-link :href="route('varietas.index')">Varietas Tanaman</x-dropdown-link>
                                    <x-dropdown-link :href="route('metode.index')">Metode Diagnosa</x-dropdown-link>
                                    <x-dropdown-link :href="route('pengendalian.index')">Metode Pengendalian</x-dropdown-link>
                                @endif
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden md:flex items-center ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-200 focus:outline-none transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->nama }}</div>
                            <div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-white/20 focus:outline-none focus:bg-white/20 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @php $userRoleId = Auth::user()->role_id; @endphp

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if ($userRoleId == 1)
                <x-responsive-nav-link :href="route('users.index')">Kelola User</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('userlokasi.index')">User Lokasi</x-responsive-nav-link>
            @endif

            @if (in_array($userRoleId, [2]))
                <x-responsive-nav-link :href="route('prediksi.form')" :active="request()->routeIs('prediksi.*')">
                    {{ __('Sistem Deteksi') }}
                </x-responsive-nav-link>
            @endif

            @if (in_array($userRoleId, [1, 7]))
                <x-responsive-nav-link :href="route('lpb.index')" :active="request()->routeIs('lpb.*')">
                    {{ __('Laporan Peringatan Bahaya') }}
                </x-responsive-nav-link>
            @endif

            @if (in_array($userRoleId, [1, 2, 3, 4, 7]))
                <x-responsive-nav-link :href="route('permohonan.index')" :active="request()->routeIs('permohonan.*')">
                    {{ __('Permohonan Diagnosa') }}
                </x-responsive-nav-link>
            @endif

            @if (in_array($userRoleId, [1, 3, 4, 5, 6, 7]))
                <x-responsive-nav-link :href="route('diagnosa.index')" :active="request()->routeIs('diagnosa.*')">
                    {{ __('Daftar Diagnosa') }}
                </x-responsive-nav-link>
            @endif

            @if (in_array($userRoleId, [4]))
                <div class="pt-2 pb-1 border-t border-green-700">
                    <div class="px-4 text-xs text-gray-400">Data Master</div>
                    <x-responsive-nav-link :href="route('jenis.index')">Jenis Tanaman</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('varietas.index')">Varietas Tanaman</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('metode.index')">Metode Diagnosa</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('pengendalian.index')">Metode Pengendalian</x-responsive-nav-link>
                </div>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-green-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->nama }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
