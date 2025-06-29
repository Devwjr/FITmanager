<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/20 border-white text-white placeholder-white focus:border-white focus:ring-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Digite seu e-mail"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-white" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full bg-white/20 border-white text-white placeholder-white focus:border-white focus:ring-white" type="password" name="password" required autocomplete="current-password" placeholder="Digite sua senha"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-white" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-white text-vermelho bg-white/20 focus:ring-white" name="remember">
                <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-white hover:text-gray-300" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-white text-vermelho hover:bg-gray-200">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
