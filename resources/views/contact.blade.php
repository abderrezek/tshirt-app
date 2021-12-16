<x-app-layout>
    <x-slot name="title">T-shirts - contact</x-slot>

    <h1 class="mt-5 mb-3 text-center">{{ Str::upper('contact') }}</h1>

    <div class="row">
        {{-- Left --}}
        <div class="col-3">
            <p class="m-0 mb-3">Si vous ne trouvez pas votre bonheur ou aimeriez travailler avec nous sur un design personnalisé, contactez-nous !</p>

            <ul class="list-unstyled">
                <li class="d-inline-block">
                    <a href="#" class="text-dark fs-2">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li class="d-inline-block">
                    <a href="#" class="text-dark fs-2">
                        <i class="fab fa-twitter-square"></i>
                    </a>
                </li>
                <li class="d-inline-block">
                    <a href="#" class="text-dark fs-2">
                        <i class="fab fa-instagram-square"></i>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Center --}}
        <div class="col-6">
            <livewire:contact-form />
        </div>

        {{-- Right --}}
        <div class="col-3">
            <div class="mb-3">
                <p class="m-0 fs-2">{{ Str::upper('ADRESSE') }}</p>
                <span>15 rue du château 75001 Paris, France</span>
            </div>

            <div class="mb-3">
                <p class="m-0 fs-2">{{ Str::upper('TÉL') }}</p>
                <span>01 23 45 67 89</span>
            </div>

            <div class="mb-3">
                <p class="m-0 fs-2">{{ Str::upper('E-MAIL') }}</p>
                <a href="mailto:info@monsite.fr" class="text-body text-decoration-none">info@monsite.fr</a>
            </div>
        </div>
    </div>
</x-app-layout>