@if (! empty($contact->days))
    <ul class="list-group list-group-flush mb-3">
        @foreach($contact->days as $day)
            @php($day = (object) $day)
            <li class="list-group-item{{ $day->number == $currentDay ? '' : " d-none d-md-block" }}">
                <span><b>{{ $day->name }}</b></span>
                @if($day->workTime)
                    <span>{{ $day->workTime }}</span>
                    @if ($day->dinerTime)
                        <span class="pl-2">
                                <i class="fas fa-utensils"></i>&nbsp;<small>{{ $day->dinerTime }}</small>
                            </span>
                    @else
                        <span class="pl-2">
                                <i class="fas fa-utensils"></i>&nbsp;<small>без обеда</small>
                            </span>
                    @endif
                @else
                    <span class="text-danger">выходной</span>
                @endif
            </li>
        @endforeach
    </ul>
@endif