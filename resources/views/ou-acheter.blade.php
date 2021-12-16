<x-app-layout>
    <x-slot name="title">T-shirts - ou acheter</x-slot>

    <h1 class="my-5 text-center">{{ Str::upper('ou acheter') }}</h1>

    <x-maps-leaflet
        style="height: 500px;"
        :zoomLevel="16"
        :centerPoint="['lat' => 36.18503, 'long' => 1.53299]"
        :markers="[['lat' => 36.18503, 'long' => 1.53299]]"
    ></x-maps-leaflet>

</x-app-layout>