<div>
  @if ($status !== 'passwords.reset' && $status !== '')
    <div class="alert alert-danger mt-2 alert-dismissible" role="alert">
      {{ __($status) }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <form wire:submit.prevent="submit">
    <input type="hidden" name="token" value="{{ $token }}">

    {{-- email --}}
    <div class="form-floating mb-2">
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" wire:model.defer="email" value="{{ $email }}">

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

    {{-- password confirmation --}}
    <div class="form-floating mb-4">
      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" wire:model.defer="password_confirmation">

      <label for="password_confirmation">Mot de passe confirmation</label>

      @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

      <div class="d-grid gap-2">
          <button class="btn btn-warning text-white">Réinitialiser le mot de passe</button>
      </div>
  </form>
</div>
