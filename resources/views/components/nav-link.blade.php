@props(['href'])

@php
  if (isset($href) && Route::is($href)) {
    $classes = 'nav-link active';
  } else {
    $classes = 'nav-link';
  }
@endphp

<li class="nav-item" {{ $attributes }}>
  <a class="{{ $classes }} position-relative" aria-current="page" @if (isset($href)) href="{{ route($href) }}" @endif>
    {{ $slot }}
  </a>
</li>