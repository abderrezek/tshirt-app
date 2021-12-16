<div x-show="isAuth()" x-cloak>
    <x-modal>
        {{-- Login Se<ction --}}
        @if ($type === 'LoginSection')
            <h1 class="fw-bold my-3 text-center">Se connecter</h1>

            <p class="my-3 fs-5 text-center">
                Nouveau sur ce site ?
                <span style="cursor: pointer;" class="text-warning" wire:click="changeType('RegisterSection')">S'inscrire</span>
            </p>

            <div class="w-50 mt-3 mb-5 mx-auto">
                <livewire:auths.login isLogin="{{ Route::is('login') }}" />
            </div>
        @endif

        {{-- Register Section --}}
        @if ($type === 'RegisterSection')
            <h1 class="fw-bold my-3 text-center">S'inscrire</h1>

            <p class="my-3 fs-5 text-center">
                Déjà membre ?
                <span style="cursor: pointer;" class="text-warning" wire:click="changeType('LoginSection')">Se connecter</span>
            </p>

            <div class="w-50 mt-3 mb-5 mx-auto">
                <livewire:auths.register isRegister="{{ Route::is('register') }}" />
            </div>
        @endif

        {{-- Forgot password Section --}}
        @if ($type === 'ForgotPasswordSection')
            <h1 class="fw-bold my-3 text-center">Créer le mot de passe</h1>

            <p class="my-3 fs-5 text-center">
                Veuillez saisir votre adresse e-mail
            </p>

            <div class="w-50 mt-3 mb-5 mx-auto">
                <livewire:auths.forgot-password isForgotPassword="{{ Route::is('password.request') }}" />
            </div>
        @endif
    </x-modal>
</div>
