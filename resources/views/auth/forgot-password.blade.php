<x-app-layout>
    <x-slot name="title">T-shirts - Se connecter</x-slot>

    <div class="text-center">
        <h1 class="mt-5 mb-3 text-center">{{ Str::upper('Créer le mot de passe') }}</h1>

        <p class="my-3 fs-5">
            Veuillez saisir votre adresse e-mail
        </p>
    </div>

    <div class="w-50 mt-3 mb-5 mx-auto">
        <livewire:auths.forgot-password isForgotPassword="{{ Route::is('password.request') }}" />
    </div>
</x-app-layout>