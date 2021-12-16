<div>
    <form wire:submit.prevent="submit">

      {{-- phone --}}
      <div class="form-floating mb-2">
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" wire:model.defer="phone">

        <label for="phone">Télephone</label>

        @error('phone')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

        {{-- wilaya --}}
        <div class="form-floating my-2">
            <select id="wilaya" class="form-select @error('wilaya') is-invalid @enderror" wire:model.defer="wilaya" wire:change="change" aria-label="Default select example">
              <option selected value="">Sélectionner un wilaya</option>
              @foreach ($wilayas as $w)
                  <option value="{{ $loop->index + 1 }}">{{ $w }}</option>
              @endforeach
            </select>

            <label for="wilaya">Wilaya</label>

            @error('wilaya')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- commune --}}
        <div class="form-floating my-2">
            <select id="commune" class="form-select @error('commune') is-invalid @enderror" wire:model.defer="commune" aria-label="Default select example" @if ($communes === []) disabled @endif>
              <option selected value="">Sélectionner un commune</option>
              @foreach ($communes as $c)
                  <option value="{{ $c }}">{{ $c }}</option>
              @endforeach
            </select>

            <label for="commune">Commune</label>

            @error('commune')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Adresse --}}
        <div class="form-floating mb-2">
            <textarea class="form-control @error('address') is-invalid @enderror" style="height: 80px" name="address" wire:model.defer="address" id="address"></textarea>
            <label for="address">Adresse</label>
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
                Enregistrer
            </button>
        </div>
    </form>
</div>
