<x-app-layout>
    <x-slot name="title">T-shirts - Se connecter</x-slot>

    <div class="text-center">
        <h1 class="mt-5 mb-3 text-center">{{ Str::upper('se connecter') }}</h1>

        <p class="my-3 fs-5">
            Nouveau sur ce site ?
            <a class="text-warning" href="{{ route('register') }}">S'inscrire</a>
        </p>
    </div>

    <div class="w-50 mt-3 mb-5 mx-auto">
        @if (session('status'))
            <div class="alert alert-success my-2 alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <livewire:auths.login isLogin="{{ Route::is('login') }}" />
    </div>
</x-app-layout>