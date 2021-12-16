<span>
  @if ($cart_counter !== 0)
    <span wire:loading.remove class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      {{ $cart_counter }}
    </span>
    <span wire:loading class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      <span class="visually-hidden">Loading...</span>
    </span>
  @endif
</span>