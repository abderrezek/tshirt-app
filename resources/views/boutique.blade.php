<x-app-layout>
    <x-slot name="title">T-shirts - boutique</x-slot>

    <div class="text-white bg-secondary d-flex justify-content-center align-items-center" style="height: 300px;">
        <h1>{{ Str::upper('T-marché') }}</h1>
    </div>

    <livewire:clothes />
</x-app-layout>