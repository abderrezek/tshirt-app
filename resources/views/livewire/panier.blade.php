<div class="my-5" x-data="panier">
    @if ($errEmpty)
        <div class="alert alert-danger">
            Quelque chose ne va pas!
        </div>
    @endif

    {{-- if panier empty --}}
    @if ($isEmpty)
        <div class="text-center">
            <h3 class="my-5">Le panier est vide</h3>

            <a href="{{ route('site.boutique') }}" class="btn btn-warning text-white">
                <i class="fas fa-arrow-left"></i>
                Revenir en arrière et choisir T-shirts
            </a>
        </div>
    @else {{-- if not empty --}}
        <div class="row">
            {{-- Mon panier --}}
            <div class="col-8">
                <h4 class="">Mon panier</h4>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="input-group w-50">
                      <span class="input-group-text" id="basic-addon1">
                          <i class="fas fa-search"></i>
                      </span>
                      <input type="text" class="form-control form-control-sm" placeholder="Rechercher ici..." aria-label="Rechercher ici..." aria-describedby="basic-addon1" wire:model="search">
                    </div>

                    <button type="button" class="btn btn-danger btn-sm" wire:click="removeAll">
                        <i class="far fa-trash-alt"></i>
                        Supprimer tous
                    </button>
                </div>

                <hr class="my-2">

                @foreach ($cart as $item)
                    <div class="my-4 d-flex justify-content-center">
                        <a href="{{ route('site.clothe', ['slug' => 'qsd']) }}">
                            <img src="#" alt="img">
                        </a>

                        <div class="ps-3 flex-grow-1 d-flex flex-column">
                            <p>{{ $item->name }}</p>

                            <span>{{ $item->price . ' DZD' }}</span>
                            <span>Couleur: Gris</span>
                        </div>

                        <div class="d-flex justify-content-center align-items-start">
                            <button type="button" class="btn btn-primary btn-sm" wire:click="plus({{ $item->id }})">
                                <i class="fas fa-plus"></i>
                            </button>

                            <input type="text" class="form-control form-control-sm w-25" value="{{ $item->qty }}">

                            <button type="button" class="btn btn-primary btn-sm" wire:click="minus({{ $item->id }})">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                        <p class="me-3"></p>

                        <button class="btn btn-danger btn-sm" wire:click="remove({{ $item->id }})">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                    <hr class="my-2">
                @endforeach
            </div>

            {{-- Résumé de la commande --}}
            <div class="col-4">
                <h4 class="">Résumé de la commande</h4>

                <hr class="my-2">

                <hr class="my-2">

                <p class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold fs-5">Le Total</span>
                    <span class="ms-auto fw-bold fs-5">{{ $total . ' DZD' }}</span>
                </p>

                @if($isDiscounted)
                    <p class="d-flex justify-content-between align-items-center">
                        <span class="fs-6">Code</span>
                        <span class="ms-auto fs-6">{{ $code }}</span>
                    </p>
                    <p class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-6">Réduction Total</span>
                        <span class="ms-auto fw-bold fs-6">{{ $discountPrix . ' DZD' }}</span>
                    </p>
                @endif

                <div class="d-grid gap-2">
                    <button class="btn btn-warning text-white" wire:click="submit()">
                        <i class="fas fa-lock"></i>
                        Paiement
                    </button>
                </div>
            </div>
        </div>

        {{-- code promo --}}
        <div class="my-3">
            <span class="text-warning" @click="toggleCode" style="cursor: pointer;">
                Saisissez un code promo
            </span>
            <div x-cloak x-show="code">
                <div class="d-flex justify-content-start align-items-center mt-2">
                    <input type="text" class="form-control w-25" wire:model.defer="code" placeholder="Saisissez un code promo">
                    <button type="button" class="btn btn-outline-warning" wire:click="applyCode">
                        <div wire:loading wire:target="applyCode">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Chargement...
                        </div>
                        <div wire:loading.remove>Appliquer</div>
                    </button>
                </div>
                @if ($codeEmpty)
                    <p class="text-danger">{{ $msgCodeEmpty }}</p>
                @elseif($codeIncorrect)
                    <p class="text-danger">{{ $msgCodeIncorrect }}</p>
                @endif
            </div>
        </div>

        {{-- Address --}}
        <div class="my-3">
            <span class="text-warning" @click="toggleAddress" style="cursor: pointer;">
                Voulez-vous livrer ?
            </span>
            <div x-cloak x-show="address">
                <input type="text" class="form-control w-25" wire:model.defer="address" placeholder="Adresse ici">
            </div>
        </div>

        {{-- Ajouter une remarque --}}
        <div class="my-3">
            <span class="text-warning" @click="toggleRemarque" style="cursor: pointer;">
                Ajouter une remarque
            </span>
            <div x-cloak x-show="remarque">
                <textarea rows="4" class="form-control w-25 mt-2" placeholder="Des instructions ? Des demandes spéciales ? Ajoutez-les ici." wire:model.defer="remarque"></textarea>
            </div>
        </div>

        <x-loading />
    @endif
</div>