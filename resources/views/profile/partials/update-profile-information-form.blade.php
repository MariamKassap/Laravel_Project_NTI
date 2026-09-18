<section>
    <header>
        <h2 class="text-lg font-black text-black">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm font-bold text-slate-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- adding company name MARIAM-->
        @if(auth()->user()->isEmployer())
        <div>
            <x-input-label for="company" :value="__('Company Name')" />

            <x-text-input
                id="company"
                name="company"
                type="text"
                class="mt-1 block w-full"
                :value="old('company', $user->company)"
                autocomplete="organization" />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('company')" />
        </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 font-bold text-black">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm font-bold text-black hover:text-[#2563EB] rounded-md focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-bold text-sm text-emerald-600 bg-emerald-300 border border-black rounded-md px-2 py-1 inline-block shadow-[1px_1px_0px_0px_#000000]">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm font-bold text-emerald-700 bg-emerald-300 border border-black rounded-md px-2 py-1 shadow-[1px_1px_0px_0px_#000000]">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
