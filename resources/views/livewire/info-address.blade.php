<form wire:submit.prevent="submit">
    {{-- wilaya --}}
    <div class="my-2">
        <label for="wilaya">Wilaya</label>
        <select id="wilaya" class="form-select @error('wilaya') is-invalid @enderror" wire:model.defer="wilaya" wire:change="change" aria-label="Default select example">
          <option selected value="">Sélectionner un wilaya</option>
          @foreach ($wilayas as $w)
              <option value="{{ $loop->index + 1 }}">{{ $w }}</option>
          @endforeach
        </select>
        @error('wilaya')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- commune --}}
    <div class="my-2">
        <label for="commune">Commune</label>
        <select id="commune" class="form-select @error('commune') is-invalid @enderror" wire:model.defer="commune" aria-label="Default select example" @if ($communes === []) disabled @endif>
          <option selected value="">Sélectionner un commune</option>
          @foreach ($communes as $c)
              <option value="{{ $c }}">{{ $c }}</option>
          @endforeach
        </select>
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

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>