<div class="col-12 mb-3">
    @include("contact-page::site.map")
</div>

@foreach ($contacts as $contact)
    <div class="col-12 col-md-6 col-lg-3 mb-3">
        <div class="contact-teaser">
            <h4 class="contact-teaser__move-center move-center"
                data-id="{{ $contact->model->id }}">
                {{ $contact->model->title }}
            </h4>

            @include("contact-page::site.days")

            @if ($contact->model->description)
                <div class="contact-teaser__description text-muted">
                    {!! $contact->model->description !!}
                </div>
            @endif

            @include("contact-page::site.contacts")
        </div>
    </div>
@endforeach