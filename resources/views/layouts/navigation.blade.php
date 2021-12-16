<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">

    <a class="navbar-brand d-block d-lg-none" href="{{ route('site.boutique') }}">
      {{ config('app.name') }}
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <x-nav-link href="site.boutique">{{ Str::upper('Boutique') }}</x-nav-link>

        <x-nav-link href="site.a-propos">{{ Str::upper('Â propos') }}</x-nav-link>

        <x-nav-link href="site.ou-acheter">{{ Str::upper('Ou acheter') }}</x-nav-link>

        <x-nav-link href="site.faq">{{ Str::upper('Faq') }}</x-nav-link>

        <x-nav-link href="site.contact">{{ Str::upper('Contact') }}</x-nav-link>
      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth
          @if (auth()->user()->isAdmin())
            <x-nav-link href="admin.index">Administrateur</x-nav-link>
          @endif

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ route('site.profil') }}">Profil</a></li>
              <li>
                <a
                  class="dropdown-item"
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault(); this.nextElementSibling.submit();"
                >Se déconnecter</a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf @method('POST')
                </form>
              </li>
            </ul>
          </li>
        @else
          <x-nav-link style="cursor: pointer;" x-data="{}" @click="toggleAuth()">
            <i class="fas fa-user"></i> Connexion
          </x-nav-link>
        @endauth

        <x-nav-link
          style="cursor: pointer;"
          x-data="{}" @click="toggleCart()"
        >
          <i class="fas fa-shopping-cart"></i>
          <livewire:cart-counter />
        </x-nav-link>
      </ul>
    </div>

  </div>
</nav>