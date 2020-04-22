<div class="col-12 col-md-8 col-lg-9 order-md-last mb-3">
    @include("contact-page::site.map")
</div>
<div class="col-12 col-md-4 col-lg-3 order-md-first mb-3">
    @foreach ($contacts as $contact)
        <div class="contact-teaser contact-teaser_single">
            <h4 class="contact-teaser__move-center move-center"
                data-id="{{ $contact->model->id }}">
                {{ $contact->model->title }}
                @if ($contact->model->address)
                    <br>
                    <small class="text-muted">{{ $contact->model->address }}</small>
                @endif
            </h4>

            @include("contact-page::site.days")

            @if ($contact->model->description)
                <div class="contact-teaser__description text-muted">
                    {!! $contact->model->description !!}
                </div>
            @endif

            @include("contact-page::site.contacts")
        </div>
    @endforeach
</div>