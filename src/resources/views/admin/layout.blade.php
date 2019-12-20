@extends('admin.layout')

@push('js-lib')
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ $apiKey }}&lang=ru_RU"
            type="text/javascript">
    </script>
@endpush

@section('admin')
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.contact.store') }}" method="post" class="form-inline">
                    @csrf
                    <label class="sr-only mb-2"
                           for="title">
                        Заголовок
                    </label>
                    <input type="text"
                           class="form-control mb-2 mr-sm-2{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           id="title"
                           name="title"
                           required
                           placeholder="Заголовок">

                    <button type="submit"
                            class="btn btn-success mb-2">
                        Добавить
                    </button>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mb-2">
        <div class="card">
            <div class="card-body">
                <universal-priority :url="'{{ route("admin.vue.priority", ['table' => "contacts", "field" => "weight"]) }}'"
                                    :elements="{{ json_encode($contacts) }}">
                </universal-priority>
                <div class="list-group">
                    {{--
                    @foreach ($contacts as $item)
                        <a class="list-group-item list-group-item-action{{ !empty($contact) && $contact->id == $item->id ? ' active' : '' }}"
                           href="{{ route('admin.contact.show', ['contact' => $item]) }}">
                            {{ $item->limit_title }}
                        </a>
                    @endforeach
                    --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 mb-2">
        @yield('contact')
    </div>
@endsection
