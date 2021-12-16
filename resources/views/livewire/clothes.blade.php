<div>
    {{-- @dump(session()->get('items'), session()->get('count'), session()->get('countTotal')) --}}
    <div class="d-flex justify-content-end align-items-center mt-3">
        <label for="filter">Filter</label>
        <select id="filter" class="form-select form-select-sm ms-2 w-25" wire:model.defer="filter" wire:change="filter">
          <option value="créé">Créé</option>
          <option value="prix">Prix</option>
          <option value="nom">Nom</option>
          <option value="nombre_acheter">Nombre acheter</option>
        </select>
    </div>
    <div class="row mb-3 mt-2" x-data="clothe">
        @foreach ($clothes as $clothe)
            @php
                // $existImage = count($clothe->images) > 0;
                $existImage = $clothe->images_count > 0;
                if ($existImage) {
                    $img = $clothe->images->first()->image;
                    $img_blur = $clothe->images->first()->image_blur;
                }

                // get item in cart
                $item = $cart->where('id', $clothe->id);
                $itemCount = $item->count();
                $qty = $itemCount ? $item->first()->qty : 0;
            @endphp
            {{-- Card --}}
            <div class="col-3">
                <div class="card my-3" @mouseleave="hideApercuRapide">
                    <div class="position-relative" @mouseover="showApercuRapide({{ $clothe->id }})">
                        {{-- Image --}}
                        <a href="{{ route('site.clothe', ['slug' => $clothe->slug]) }}">
                            @if ($existImage)
                            <img src="{{ $img_blur }}" data-src="{{ $img }}" height="300" class="card-img-top" alt="...">
                            @else
                            <img src="/storage/clothes/default.png" height="300" class="card-img-top" alt="default image">
                            @endif
                        </a>

                        {{-- Apercu rapide --}}
                        <template x-if="isShowApercuRapide({{ $clothe->id }})">
                            <span
                                class="position-absolute bottom-0 start-0 end-0 py-2 px-3 text-center bg-white opacity-50"
                                style="cursor: pointer;"
                                @click="openModal({{ $clothe->id }})"
                            >Aperçu Rapide</span>
                        </template>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        {{-- Name --}}
                        <h5 class="card-title">{{ $clothe->name }}</h5>

                        {{-- Price --}}
                        <div class="card-text d-flex justify-content-between align-items-center">
                            <span @if($clothe->is_sale) class="text-decoration-line-through" @endif>
                                {{ $clothe->price . ' DZD' }}
                            </span>
                            @if ($clothe->is_sale)
                            <span>{{ $clothe->sale . ' DZD' }}</span>
                            @endif
                        </div>

                        {{-- Add to cart --}}
                        <div class="d-grid gap-2 mt-2">
                            {{-- Before Add to cart --}}
                            @if (!$itemCount)
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    wire:click="addToCart({{ $clothe->id }})"
                                >Ajouter au panier</button>
                            @endif

                            {{-- After Add to cart --}}
                            @if ($itemCount)
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-primary" wire:click="minus({{ $clothe->id }})">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input type="text" class="form-control" value="{{ $qty }}">

                                    <button type="button" class="btn btn-primary" wire:click="plus({{ $clothe->id }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal --}}
            <template x-if="isOpenModal({{ $clothe->id }})">
                <x-modal>
                    <div class="row mt-2 mb-5">
                        <div class="col">
                            @if ($existImage)
                            <img src="{{ $img_blur }}" data-src="{{ $img }}" height="300" class="card-img-top" alt="...">
                            @else
                            <img src="/storage/clothes/default.png" height="300" class="card-img-top" alt="default image">
                            @endif
                        </div>

                        <div class="col">
                            <h4 class="">{{ $clothe->name }}</h4>

                            <div class="card-text">
                                <span @if($clothe->is_sale) class="text-decoration-line-through" @endif>
                                    {{ $clothe->price . ' DZD' }}
                                </span>
                                @if ($clothe->is_sale)
                                <span class="ms-3">{{ $clothe->sale . ' DZD' }}</span>
                                @endif
                            </div>

                            <div class="my-3">
                                <p class="mb-2">Tailler</p>
                                <x-size :sizes="$clothe->size" />
                            </div>

                            <div class="my-3">
                                <p class="mb-2">Couleur</p>
                                <ul class="list-unstyled">
                                    @foreach ($clothe->colors as $color)
                                        <li
                                            class="d-inline-block border border-1 rounded-circle me-2"
                                            style="width: 20px; height: 20px; background-color: {{ $color }};"
                                        ></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="my-3">
                                <p class="mb-2">Quantité</p>

                                <div class="d-flex justify-content-start align-items-center">
                                    <button type="button" class="btn btn-primary" wire:click="minus({{ $clothe->id }})">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input type="text" class="form-control w-25" value="{{ $qty }}">

                                    <button type="button" class="btn btn-primary" wire:click="plus({{ $clothe->id }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            @if (!$itemCount)
                                <div class="d-grid gap-2 my-3">
                                    <button
                                        type="button"
                                        class="btn btn-warning text-white"
                                        wire:click="addToCart({{ $clothe->id }})"
                                    >Ajouter au panier</button>
                                </div>
                            @endif

                            <a class="text-dark" href="{{ route('site.clothe', ['slug' => $clothe->slug]) }}">
                                Voir plus de détails
                            </a>
                        </div>
                    </div>
                </x-modal>
            </template>
        @endforeach
    </div>

    @if ($items <= $count_clothes)
        <a class="d-block text-center text-decoration-none fw-bold text-dark mb-4" style="cursor: pointer" wire:click="load">
            - Charger Plus -
        </a>
    @endif

    <x-loading />
</div>
