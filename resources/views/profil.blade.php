<x-app-layout>
    <x-slot name="title">T-shirts - profil</x-slot>

    <h1 class="mt-5 mb-3 text-center">{{ Str::upper('votre profil') }}</h1>

    {{-- tabs --}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        {{-- info personnel --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="infoPers-tab" data-bs-toggle="tab" data-bs-target="#infoPers" type="button" role="tab" aria-controls="infoPers" aria-selected="true">Information Personnelle</button>
        </li>

        {{-- Addresse --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">Adresse de livraison</button>
        </li>
    </ul>
    {{-- content tabs --}}
    <div class="tab-content" id="myTabContent">
        {{-- info personnel --}}
        <div class="tab-pane fade show" id="infoPers" role="tabpanel" aria-labelledby="infoPers-tab">
            <livewire:info-personnelle />
        </div>

        {{-- Addresse --}}
        <div class="tab-pane fade show active" id="address" role="tabpanel" aria-labelledby="address-tab">
            <livewire:info-address />
        </div>
    </div>

</x-app-layout>