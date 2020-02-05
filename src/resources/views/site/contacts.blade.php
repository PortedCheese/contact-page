@if ($contact->phones)
    <ul class="list-unstyled">
        @foreach ($contact->phones as $phone)
            <li>
                @isset ($phone['comment'])
                    <small class="text-muted">{{ $phone['comment'] }}</small>
                    <br>
                @endisset
                <a href="tel:{{ $phone['value'] }}" class="contact-teaser__link">{{ $phone['value'] }}</a>
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->emails)
    <ul class="list-unstyled">
        @foreach ($contact->emails as $email)
            <li>
                @isset ($email['comment'])
                    <small class="text-muted">{{ $email['comment'] }}</small>
                    <br>
                @endisset
                <a href="mailto:{{ $email['value'] }}" class="contact-teaser__link">{{ $email['value'] }}</a>
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->webs)
    <ul class="list-unstyled">
        @foreach ($contact->webs as $item)
            <li>
                @isset ($item['comment'])
                    <small class="text-muted">{{ $item['comment'] }}</small>
                    <br>
                @endisset
                <a href="{{ $item['value'] }}" target="_blank" class="contact-teaser__link">{{ $item['humanValue'] }}</a>
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->socials)
    <ul class="list-inline">
        @foreach($contact->socials as $link)
            <li class="list-inline-item text-center">
                <a href="{{ $link['value'] }}"
                   target="_blank"
                   title="{{ $link['comment'] }}">
                    <i class="{{ $link['ico'] }} fa-2x"></i>
                </a>
            </li>
        @endforeach
    </ul>
@endif