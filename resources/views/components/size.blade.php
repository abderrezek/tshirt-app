@props(['sizes'])

@php
    array_shift($sizes);
    $SIZES_DEFAULT = ['xs', 's', 'm', 'l', 'xl', 'xxl'];
@endphp
<select class="form-select" aria-label="Taille Select">
    {{-- <option selected>Open this select menu</option> --}}
    @foreach ($sizes as $key => $size)
        @if ($size)
            <option value="{{ $SIZES_DEFAULT[$key] }}">{{ $SIZES_DEFAULT[$key] }}</option>
        @endif
    @endforeach
</select>