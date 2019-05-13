@if ($contact->phones)
    <ul class="list-unstyled">
        @foreach ($contact->phones as $phone)
            <li>
                <i class="fas fa-phone"></i>&nbsp;<a href="tel:{{ $phone['value'] }}" class="badge badge-light">{{ $phone['value'] }}</a>
                @isset ($phone['comment'])
                    <small class="text-secondary">{{ $phone['comment'] }}</small>
                @endisset
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->emails)
    <ul class="list-unstyled">
        @foreach ($contact->emails as $email)
            <li>
                <i class="far fa-envelope"></i>&nbsp;<a href="mailto:{{ $email['value'] }}" class="badge badge-light">{{ $email['value'] }}</a>
                @isset ($email['comment'])
                    <small class="text-secondary">{{ $email['comment'] }}</small>
                @endisset
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->webs)
    <ul class="list-unstyled">
        @foreach ($contact->webs as $web)
            <li>
                <i class="fas fa-globe-asia"></i>&nbsp;<a href="{{ $web['value'] }}" target="_blank" class="badge badge-light">{{ $web['humanValue'] }}</a>
                @isset ($web['comment'])
                    <small class="text-secondary">{{ $web['comment'] }}</small>
                @endisset
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->socials)
    <div class="row">
        @foreach($contact->socials as $link)
            <div class="col text-center">
                <a href="{{ $link['value'] }}"
                   target="_blank"
                   title="{{ $link['comment'] }}">
                    <i class="{{ $link['ico'] }} fa-2x"></i>
                </a>
            </div>
        @endforeach
    </div>
@endif