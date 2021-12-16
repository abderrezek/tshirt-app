<x-app-layout>
    <x-slot name="title">T-shirts - S'inscrire'</x-slot>

    <div class="text-center">
        <h1 class="mt-5 mb-3 text-center">{{ Str::upper('se connecter') }}</h1>

        <p class="my-3 fs-5">
            Déjà membre ?
            <a class="text-warning" href="{{ route('login') }}">Se connecter</a>
        </p>
    </div>

    <div class="w-50 mt-3 mb-5 mx-auto">
        <livewire:auths.register isRegister="{{ Route::is('register') }}" />
    </div>
</x-app-layout>