@extends('contact-page::admin.layout')

@section('page-title', 'Просмотр - ')
@section('header-title', "{$contact->title}")

@section('contact')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include("contact-page::admin.edit-form")
            </div>
        </div>
    </div>
    <div class="col-12 mt-2 mb-2">
        <contact-create save-coord-url="{{ route('admin.vue.contact.set-coord', ['contact' => $contact->id]) }}"
                        :enter-point-coord="{{ json_encode([$contact->longitude, $contact->latitude]) }}"
                        save-days-url="{{ route('admin.vue.contact.set-days', ['contact' => $contact->id]) }}"
                        :work-times="{{ json_encode($contact->work_times) }}"
                        save-links-url="{{ route('admin.vue.contact.set-links', ['contact' => $contact->id]) }}"
                        ico-preset="{{ $contact->ico }}"
                        :links-data="{{ json_encode($contact->links_data) }}">
        </contact-create>
    </div>
@endsection
