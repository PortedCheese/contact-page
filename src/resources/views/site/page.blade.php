@extends('layouts.boot')

@section('page-title', "Контакты - ")

@section('header-title', "Контакты")

@push('js-lib')
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ $apiKey }}&lang=ru_RU"
            type="text/javascript">
    </script>
@endpush

@section('content')
    <div class="col-12">
        <contact-map :enter-point-coordinates="{{ json_encode($mapCenter) }}"
                     :points-info="{{ json_encode($coordinates) }}">
        </contact-map>
    </div>
    @foreach ($contacts as $contact)
        <div class="col-sm-12 col-md-6 col-lg-4 mb-3 text-center">
            <h4 class="move-center"
                style="cursor: pointer"
                data-id="{{ $contact->model->id }}">
                <u>{{ $contact->model->title }}</u>
            </h4>
            <p>{{ $contact->model->description }}</p>
            @include("contact-page::site.days")
            @include("contact-page::site.contacts")
        </div>
    @endforeach
@endsection
