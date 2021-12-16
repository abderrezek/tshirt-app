<x-app-layout>
    <x-slot name="title">T-shirts - Article</x-slot>

    {{-- @dd($prevSlug, $nextSlug) --}}
    <div class="d-flex justify-content-between align-items-center my-5">
        <p>
            <a class="text-dark text-decoration-none fw-bold" href="{{ route('site.boutique') }}">Accueil</a>
            /
            {{ $clothe->name }}
        </p>

        <p>
            <a href="{{ $prevSlug ? route('site.clothe', ['slug' => $prevSlug->slug]) : '#' }}"
                class="@if ($prevSlug) link-dark @else link-secondary @endif text-decoration-none fw-bold">
                <i class="fas fa-chevron-left"></i>
                Précédent
            </a>
            <span class="d-inline-block border-start border-dark border-3" style="width: 1px;"></span>
            <a href="{{ $nextSlug ? route('site.clothe', ['slug' => $nextSlug->slug]) : '#' }}"
                class="@if ($nextSlug) link-dark @else link-secondary @endif text-decoration-none fw-bold">
                Suivant
                <i class="fas fa-chevron-right"></i>
            </a>
        </p>
    </div>

    <div class="row mt-2 mb-5">
        <div class="col">
            @if (count($clothe->images) > 0)
                <img src="{{ $clothe->images->first()->image_blur }}" data-src="{{ $clothe->images->first()->image }}" height="300" class="card-img-top" alt="...">
            @else
                <img src="/storage/clothes/default.png" height="300" class="card-img-top" alt="default image">
            @endif
        </div>

        <div class="col">
            <h4 class="mb-4 fs-3">{{ $clothe->name }}</h4>

            <div class="card-text">
                <span class="@if($clothe->is_sale) text-decoration-line-through @endif fs-4">
                    {{ $clothe->price . ' DZD' }}
                </span>
                @if ($clothe->is_sale)
                    <span class="ms-3 fs-4">{{ $clothe->sale . ' DZD' }}</span>
                @endif
            </div>

            {{-- @dump($clothe->size) --}}
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

            <livewire:clothe :numero="$clothe->id" />

            <div class="accordion accordion-flush" id="acc">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="desc">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#descDetail" aria-expanded="false" aria-controls="descDetail">
                            DÉTAILS DE L'ARTICLE
                        </button>
                    </h2>
                    <div id="descDetail" class="accordion-collapse collapse" aria-labelledby="desc">
                        <div class="accordion-body">
                            {{ $clothe->description ?? 'n\'existe pas descriptif' }}
                        </div>
                    </div>
                </div>

                {{-- politique --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="politique">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#politiqueDetail" aria-expanded="false" aria-controls="politiqueDetail">
                            POLITIQUE D'ÉCHANGE ET DE REMBOURSEMENT
                        </button>
                    </h2>
                    <div id="politiqueDetail" class="accordion-collapse collapse" aria-labelledby="politique">
                        <div class="accordion-body">
                            Politique d'échange et de remboursement. Informez vos visiteurs des conditions d'échange et de remboursement des articles qu'ils achètent sur votre site. Énoncez clairement vos conditions afin d'établir une relation de confiance avec vos clients et leur permettre ainsi d'acheter sur votre site en toute sécurité.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>