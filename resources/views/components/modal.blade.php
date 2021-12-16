@props(['title' => ''])

<div
    {{-- x-show="open" --}}
    @click="open=false"
    {{-- @click.away="open=false" --}}
    class="position-fixed top-0 start-0 w-100 min-vh-100 d-flex justify-content-center align-items-center"
    style="z-index: 1000;"
>

    <div class="position-absolute top-0 start-0 w-100 min-vh-100 bg-dark opacity-50"></div>

    <div @click.stop class="d-flex flex-column bg-white w-75 h-75 rounded shadow-lg" style="z-index: 1001;">
        {{-- title --}}
        <div
            class="py-2 px-3 border-bottom d-flex justify-content-between @if($title === '') flex-row-reverse @endif align-items-center"
        >
            @if ($title !== '')
                <h3>{{ $title }}</h3>
            @endif
            <span class="fs-2" style="cursor: pointer">
                <i @click="open=false" class="fas fa-times"></i>
            </span>
        </div>

        {{-- Content --}}
        <div class="py-2 px-3">
            {{ $slot }}
        </div>
    </div>

</div>