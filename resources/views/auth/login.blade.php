<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div x-data="{ show: false }" class="relative mt-1">
                <input
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    :type="show ? 'text' : 'password'"
                    class="block w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-black shadow-[2px_2px_0px_0px_#000000] placeholder:text-gray-500 focus:ring-0 focus:outline-none focus:border-black pr-12">

                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 z-10 flex items-center px-3 text-black hover:text-[#2563EB] transition-colors">
                    <i x-show="!show" class="fa-solid fa-eye"></i>
                    <i x-show="show" class="fa-solid fa-eye-slash"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-2 border-black text-[#2563EB] shadow-[1px_1px_0px_0px_#000000] focus:ring-0 focus:border-black" name="remember">
                <span class="ms-2 text-sm font-bold text-black">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm font-bold text-black hover:text-[#2563EB] rounded-md focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
