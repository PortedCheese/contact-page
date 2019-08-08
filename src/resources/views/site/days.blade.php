@if (! empty($contact->days))
    <ul class="list-group list-group-flush mt-3">
        @foreach($contact->days as $day)
            @php($day = (object) $day)
            <li class="list-group-item{{ $day->number == $currentDay - 1 ? '' : " d-none d-md-block" }}" style="background: none">
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