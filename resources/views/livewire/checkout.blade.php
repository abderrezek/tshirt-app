<div class="mt-5">

    <div class="row">
        <div class="col-md-8">
            @foreach ($cart as $ele)
                <div class="d-flex justify-content-center" style="background-color: #f4f4f4">
                    <img src="#" alt="img">

                    <div class="ps-3 flex-grow-1 d-flex flex-column">
                        <p>{{ $ele->name }}</p>

                        <span>{{ ($ele->price * $ele->qty) . ' DZD' }}</span>
                        <span>Couleur: Gris</span>
                    </div>

                    <div class="border border-primary rounded text-center" style="width: 50px; height: 25px">
                        <span class="fw-bold">{{ $ele->qty }}</span>
                    </div>
                </div>
                @if (!$loop->last)
                    <hr class="my-2">
                @endif
            @endforeach
        </div>

        <div class="col-md-4">
            <div>
                <p class="d-flex justify-content-between align-items-center m-0">
                    <span>Total</span>
                    <span>{{ $priceTotal . ' DZD' }}</span>
                </p>

                @if (!is_null($promo))
                    <p class="d-flex justify-content-between align-items-center m-1">
                        <span>Coupon</span>
                        <span>{{ $promo['code'][0] }}</span>
                    </p>
                    <p class="d-flex justify-content-between align-items-center m-1">
                        <span>Récompense</span>
                        <span>{{ $promo['reward'][0] . '%'}}</span>
                    </p>
                    <p class="d-flex justify-content-between align-items-center m-1">
                        <span>Remise</span>
                        <span>{{ $promo['discount'][0] . ' DZD' }}</span>
                    </p>
                    <p class="d-flex justify-content-between align-items-center m-1">
                        <span>Total après</span>
                        <span>{{ $promo['total'][0] . ' DZD' }}</span>
                    </p>
                @endif

                <div class="d-grid gap-2 mt-2">
                    <button class="btn btn-info text-white" wire:click="payant">
                        Payant
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if (!is_null($address))
        <p class="my-3">
            livre in: {{ $address }}
        </p>
    @endif

    @if (!is_null($remarque))
        <p class="my-3">
            remarque: {{ $remarque }}
        </p>
    @endif

</div>
