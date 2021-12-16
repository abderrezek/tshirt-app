<div
  x-data="{
    success: @entangle('success'),
    open: @entangle('open')
  }"
  {{-- @keydown.escape="alert('Submitted!')" --}}
>
    <form wire:submit.prevent="submit">
        <div class="form-floating mb-2">
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" wire:model.defer="name">
          <label for="name">Prénom</label>
          @error('name')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating mb-2">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" wire:model.defer="email">
          <label for="email">E-mail</label>
          @error('email')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" wire:model.defer="phone">
          <label for="phone">Téléphone</label>
          @error('phone')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating mb-2">
          <textarea class="form-control @error('message') is-invalid @enderror" style="height: 130px" name="message" wire:model.defer="message" id="message"></textarea>
          <label for="message">Rédigez votre message ici...</label>
          @error('message')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex align-items-center">
            <template x-if="success">
              <span class="text-success" @click.away="success=false">Merci pour votre envoi !</span>
            </template>
            <button type="submit" class="btn btn-warning ms-auto">
              <div wire:loading>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Chargement...
              </div>
              <div wire:loading.remove>Envoyer</div>
            </button>
        </div>
    </form>

    <template x-if="open">
      <x-modal title="hey">
        <button class="btn btn-primary" @click="$wire.checked()">Not rebort</button>
      </x-modal>
    </template>
</div>
