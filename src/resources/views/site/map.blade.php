@push('js-lib')
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ $apiKey }}&lang=ru_RU"
            type="text/javascript">
    </script>
@endpush

<contact-map :enter-point-coordinates="{{ json_encode($mapCenter) }}"
             :points-info="{{ json_encode($coordinates) }}">
</contact-map>