<div x-show="isCart()" x-cloak>
    <x-modal title="Panier">
        {{-- @if ($errEmpty)
            <div class="alert alert-danger" role="alert">
                Le panier est vide
            </div>
        @endif --}}
        <livewire:cart-items-modal :isPanier="$isPanier" :isClothe="$isClothe" />
    </x-modal>
</div>
