<div>
    <div class="my-3">
        <p class="mb-2">Quantité</p>

        <div class="d-flex justify-content-start align-items-center">
            @if ($itemCount)
                <button type="button" class="btn btn-primary" wire:click="minus({{ $numero }})">
                    <i class="fas fa-minus"></i>
                </button>
            @endif

            <input type="text" class="form-control w-25" value="{{ $qty }}">

            @if ($itemCount)
                <button type="button" class="btn btn-primary" wire:click="plus({{ $numero }})">
                    <i class="fas fa-plus"></i>
                </button>
            @endif
        </div>
    </div>

    @if (!$itemCount)
        <div class="d-grid gap-2 my-3">
            <button
                type="button"
                class="btn btn-warning text-white"
                wire:click="add({{ $numero }})"
            >Ajouter au panier</button>
        </div>
    @endif

    <x-loading />
</div>
