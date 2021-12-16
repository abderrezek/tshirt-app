<div>
  @if ($status !== '')
    <div class="alert alert-{{ $class }} mt-2 alert-dismissible" role="alert">
      {{ __($status) }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <form wire:submit.prevent="submit">
      {{-- email --}}
      <div class="form-floating mb-2">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" wire:model.defer="email">

        <label for="email">E-mail</label>

        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <p class="d-flex justify-content-between align-items-center mt-2 mb-3">
        @if ($isForgotPassword)
          <a href="{{ route('login') }}" class="text-dark text-decoration-underline">Se connecter</a>

          <a href="{{ route('register') }}" class="text-dark text-decoration-underline">S'inscrire</a>
        @else
          <span style="cursor: pointer;" class="text-dark text-decoration-underline" wire:click="$emitUp('changeType', 'LoginSection')">
            Se connecter
          </span>

          <span style="cursor: pointer;" class="text-dark text-decoration-underline" wire:click="$emitUp('changeType', 'RegisterSection')">
            S'inscrire
          </span>
        @endif
      </p>

      <div class="d-grid gap-2">
          <button type="submit" class="btn btn-warning text-white" wire:loading.attr="disabled">
            <span class="spinner-border spinner-border-sm" wire:loading role="status" aria-hidden="true"></span>
            Créer le mot de passe
          </button>
      </div>
  </form>
</div>