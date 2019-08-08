@extends('layouts.boot')

@section('page-title', "Контакты - ")

@section('header-title', "Контакты")

@section('content')
    <div class="col-12 mb-3">
        @include("contact-page::site.map")
    </div>
    @foreach ($contacts as $contact)
        <div class="col-sm-12 col-md-6 col-lg-4 mb-3 text-center">
            <h4 class="move-center"
                style="cursor: pointer"
                data-id="{{ $contact->model->id }}">
                <u>{{ $contact->model->title }}</u>
            </h4>
            <p>{!! $contact->model->description !!}</p>
            @include("contact-page::site.contacts")
            @include("contact-page::site.days")
        </div>
    @endforeach
@endsection
