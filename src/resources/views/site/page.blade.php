@extends('layouts.boot')

@section('page-title', "Контакты - ")

@section('header-title', "Контакты")

@section('content')
    <div class="col-12 mb-3">
        @include("contact-page::site.map")
    </div>
    <div class="col-12">
        <div class="card-columns">
            @foreach ($contacts as $contact)
                    <div class="card card-base border-info">
                        <div class="card-header">
                            <h4 class="move-center"
                                style="cursor: pointer"
                                data-id="{{ $contact->model->id }}">
                                <u>{{ $contact->model->title }}</u>
                            </h4>
                            <p>{!! $contact->model->description !!}</p>
                        </div>
                        <div class="card-body">
                            @include("contact-page::site.contacts")
                        </div>
                        @include("contact-page::site.days")
                    </div>

            @endforeach
        </div>
    </div>
@endsection
