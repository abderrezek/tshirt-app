<x-app-layout>
    <x-slot name="title">T-shirts - Checkout</x-slot>

    <livewire:checkout />

    @push('scripts')
        <script type="text/javascript" src="{{ asset('js/sweetalert.js') }}" defer></script>
    @endpush
</x-app-layout>