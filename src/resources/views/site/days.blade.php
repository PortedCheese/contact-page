@if (count($contact->daysGrouped))
    <ul class="list-unstyled">
        @if (count($contact->daysGrouped) == 1)
            <li class="contact-teaser__day">
                <small class="contact-teaser__time">{{ $contact->daysGrouped[0]["time"] }}</small>
            </li>
            <li class="contact-teaser__day">
                <small class="contact-teaser__time">Без выходных</small>
            </li>
        @else
            @foreach ($contact->daysGrouped as $day)
                <li class="contact-teaser__day">
                    @if ($day["start"] != $day["end"])
                        <small class="contact-teaser__days">{{ $day["start"] }} - {{ $day["end"] }}:</small>
                    @else
                        <small class="contact-teaser__days">{{ $day["start"] }}:</small>
                    @endif
                    <small class="contact-teaser__time">{{ $day["time"] ? $day["time"] : "Выходной" }}</small>
                </li>
            @endforeach
        @endif
    </ul>
@endif