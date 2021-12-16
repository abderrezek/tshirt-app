<x-app-layout>
    <x-slot name="title">T-shirts - profil</x-slot>

    <div class="card mt-5 mx-auto w-50">
        <div class="d-flex justify-content-end my-2 me-3">
            <a class="text-decoration-none text-dark fw-bold" href="{{ route('site.boutique') }}">Sauter</a>
        </div>

        <div class="card-body">
            <livewire:info-phone-address />
        </div>
    </div>
</x-app-layout>