<div class="col-12 order-md-last mb-3">
    @include("contact-page::site.map")
</div>
<div class="col-12 order-md-first mb-3">
    <div class="accordion" id="accordionContacts">
        <div class="row">
            @foreach ($contacts as $contact)
                <div class="col-12 col-md-4">
                    <div class="contact-teaser contact-teaser_single">
                        <h4 class="contact-teaser__move-center move-center"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $contact->model->id }}"
                            aria-expanded="{{ $loop->first ? "true" : "false" }}"
                            aria-controls="collapseOne"
                            data-id="{{ $contact->model->id }}">
                            {{ $contact->model->title }}
                            @if ($contact->model->address)
                                <br>
                                <small class="text-muted">{{ $contact->model->address }}</small>
                            @endif
                        </h4>

                        <div id="collapse-{{ $contact->model->id }}" class="collapse{{ $loop->first ? " show" : "" }}" data-bs-parent="#accordionContacts">
                            @include("contact-page::site.days")

                            @if ($contact->model->description)
                                <div class="contact-teaser__description text-muted">
                                    {!! $contact->model->description !!}
                                </div>
                            @endif

                            @include("contact-page::site.contacts")
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>