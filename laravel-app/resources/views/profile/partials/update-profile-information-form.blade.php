<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- PERBAIKAN 1: Menambahkan enctype untuk upload file --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nama" :value="__('Name')" />
            <x-text-input id="nama" name="name" type="text" readonly class="mt-1 block w-full bg-gray-100 cursor-not-allowed" :value="old('nama', $user->nama)" required autofocus autocomplete="nama" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input id="role" type="text" readonly class="mt-1 block w-full bg-gray-100 cursor-not-allowed" :value="$user->role?->nama_role ?? '-'" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- PERBAIKAN 2: Menambahkan bagian upload tanda tangan dan stempel --}}
        <div class="pt-6 border-t border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Tanda Tangan & Stempel Digital</h2>
            <p class="mt-1 text-sm text-gray-600">Upload gambar PNG transparan untuk hasil terbaik.</p>

            <!-- Upload Tanda Tangan -->
            <div class="mt-4">
                <label for="tanda_tangan" class="block font-medium text-sm text-gray-700">Upload Tanda Tangan</label>
                <input id="tanda_tangan" name="tanda_tangan" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-gray-50 hover:file:bg-gray-100"/>
                @if (Auth::user()->tanda_tangan)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Tanda Tangan Saat Ini:</p>
                        <img src="{{ asset('storage/' . Auth::user()->tanda_tangan) }}" alt="Tanda Tangan" class="h-20 mt-1 border p-1 rounded-md">
                    </div>
                @endif
            </div>

            <!-- Upload Stempel -->
            <div class="mt-4">
                <label for="stempel" class="block font-medium text-sm text-gray-700">Upload Stempel</label>
                <input id="stempel" name="stempel" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-gray-50 hover:file:bg-gray-100"/>
                @if (Auth::user()->stempel)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Stempel Saat Ini:</p>
                        <img src="{{ asset('storage/' . Auth::user()->stempel) }}" alt="Stempel" class="h-20 mt-1 border p-1 rounded-md">
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
