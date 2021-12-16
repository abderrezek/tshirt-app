<div>
    @if (!$cart->count())
        <h5 class="my-5 text-center">
            Le panier est vide
        </h5>
    @else
        {{-- items --}}
        @foreach ($cart as $item)
            <div class="my-2 d-flex justify-content-between align-items-center bg-light px-2">
                <img src="#" alt="{{ $item->name }}">

                <div class="flex-grow-1 d-flex flex-column ps-3">
                    <p class="m-0 mb-2">{{ $item->name }}</p>
                    <p class="m-0">{{ $item->price . ' DZD' }}</p>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <button type="button" class="btn btn-primary btn-sm" wire:click="plus({{ $item->id }})">
                        <i class="fas fa-plus"></i>
                    </button>

                    <input type="text" class="form-control form-control-sm" value="{{ $item->qty }}">

                    <button type="button" class="btn btn-primary btn-sm" wire:click="minus({{ $item->id }})">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <button type="button" class="ms-2 btn btn-danger btn-sm" wire:click="remove({{ $item->id }})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        @endforeach

        {{-- Count total --}}
        <p class="fs-4 text m-0 mb-1">Sous-total</p>
        <p class="fs-4 text m-0 mb-3">{{ $total . ' DZD' }}</p>

        {{-- button panier --}}
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ route('site.panier') }}" class="btn btn-warning text-white flex-grow-1" type="button">
                Voir panier
            </a>
            <button class="btn btn-danger text-white ms-2" type="button" wire:click="removeAll()">
                <i class="far fa-trash-alt"></i>
            </button>
        </div>


    @endif
</div>
