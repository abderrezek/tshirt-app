<div>
  <form wire:submit.prevent="submit" action="{{ route('login') }}" method="POST">
      {{-- email --}}
      <div class="form-floating mb-2">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" wire:model.defer="email">

        <label for="email">E-mail</label>

        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- password --}}
      <div class="form-floating mb-2">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" wire:model.defer="password">

        <label for="password">Mot de passe</label>

        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      @if ($isLogin)
        <a class="d-inline-block my-3 text-decoration-underline text-dark" href="{{ route('password.request') }}">
            Mot de passe oublié ?
        </a>
      @else
        <p style="cursor: pointer;" class="my-3 text-decoration-underline" wire:click="$emitUp('changeType', 'ForgotPasswordSection')">
            Mot de passe oublié ?
        </p>
      @endif
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="remember" name="remember" wire:model.defer="remember">
        <label class="form-check-label" for="remember">
          Remember me
        </label>
      </div>

      <div class="d-grid gap-2">
          <button type="submit" class="btn btn-warning text-white">Se connecter</button>
      </div>

      <p class="text-center">
        <a class="text-dark text-decoration-none fs-3" href="{{ route('socialite.redirect', ['provider' => 'google']) }}">
          <i class="fab fa-google-plus-square"></i>
        </a>
        <a class="text-dark text-decoration-none fs-3" href="{{ route('socialite.redirect', ['provider' => 'facebook']) }}">
          <i class="fab fa-facebook-square"></i>
        </a>
      </p>
  </form>
</div>
