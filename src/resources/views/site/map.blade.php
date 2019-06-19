@push('js-lib')
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ $apiKey }}&lang=ru_RU"
            type="text/javascript">
    </script>
@endpush

@php
    $coverSize = !empty($size) ? $size : 400;
    $mapZoom = !empty($zoom) ? $zoom : env("CONTACT_PAGE_ZOOM_MAP", 14);
    $icoPreset = !empty($preset) ? $preset : "noIco";
@endphp

<contact-map :enter-point-coordinates="{{ json_encode($mapCenter) }}"
             :map-size="{{ $coverSize }}"
             :map-zoom="{{ $mapZoom }}"
             ico-preset="{{ $icoPreset }}"
             :points-info="{{ json_encode($coordinates) }}">
</contact-map>