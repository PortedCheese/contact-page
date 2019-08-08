@if (! empty($contact->days))
    <div class="card-footer">
        <ul class="list-unstyled">
            @foreach($contact->days as $day)
                @php($day = (object) $day)
                <li class="{{ $day->number == $currentDay - 1 ? '' : " d-none d-md-block" }}">
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
    </div>
@endif