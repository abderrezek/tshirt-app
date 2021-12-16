<div class="my-4">
    @if ($status !== '')
      <div class="alert alert-{{ $class }} alert-dismissible" role="alert">
        {{ __($status) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    {{-- @dump($user) --}}
    <form wire:submit.prevent="submit">
      {{-- name --}}
      <div class="form-floating mb-2">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" wire:model.defer="name">

        <label for="name">Nom</label>

        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- email --}}
      <div class="form-floating mb-2">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" wire:model.defer="email">

        <label for="email">E-mail</label>

        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- phone --}}
      <div class="form-floating mb-2">
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" wire:model.defer="phone">

        <label for="phone">Télephone</label>

        @error('phone')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- current password --}}
      <div class="form-floating mb-2">
        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" wire:model.defer="current_password">

        <label for="current_password">Mot de passe actuel</label>

        @error('current_password')
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

      <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
