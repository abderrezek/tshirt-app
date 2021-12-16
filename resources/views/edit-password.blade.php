<x-app-layout>
    <x-slot name="title">T-shirts - profil</x-slot>

    <h1 class="mt-5 mb-3 text-center">{{ Str::upper('Changer le mot de passe') }}</h1>

    @dump(request()->user())

</x-app-layout>