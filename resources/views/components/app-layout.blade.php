<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- styles -->
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    @stack('stylesheets')
  </head>
  <body x-data="cartItems">
    @include('layouts.navigation')

    {{-- email verify messages --}}
    @auth
      @if (! auth()->user()->hasVerifiedEmail())
        <div class="alert alert-warning m-0" role="alert">
          no verify email
          <a
            class="text-dark"
            href="{{ route('verification.send') }}"
            onclick="event.preventDefault(); this.nextElementSibling.submit();"
          >Resend E-mail</a>
          <form method="POST" action="{{ route('verification.send') }}">
            @csrf @method('POST')
          </form>
        </div>

        @if (session('status') == 'verification-link-sent')
          <div class="alert alert-success alert-dismissible m-0" role="alert">
            A new email verification link has been emailed to you!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      @endif
    @endauth

    <div class="container">
      {{ $slot }}
    </div>

    @guest
      <livewire:auths.auths />
    @endguest

    @livewire('cart', [
      'isPanier' => Route::is('site.panier'),
      'isClothe' => Route::is('site.clothe'),
    ])

    <!-- scripts -->
    @livewireScripts
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @stack('scripts')
  </body>
</html>