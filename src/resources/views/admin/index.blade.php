@extends('contact-page::admin.layout')

@section('page-title', 'Контакты - ')
@section('header-title', 'Контакты')

@section('contact')
    @role('admin')
    <div class="col-12">
        <form action="{{ route('admin.contact.save-settings') }}"
              method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="path">Путь</label>
                <input type="text"
                       id="path"
                       name="path"
                       value="{{ old('path') ? old('path') : $config->path }}"
                       required
                       class="form-control{{ $errors->has('path') ? ' is-invalid' : '' }}">
                @if ($errors->has('path'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('path') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="yandexApi">Ключ для карты</label>
                <input type="text"
                       id="yandexApi"
                       name="yandexApi"
                       value="{{ old('yandexApi') ? old('yandexApi') : $config->yandexApi }}"
                       required
                       class="form-control{{ $errors->has('yandexApi') ? ' is-invalid' : '' }}">
                @if ($errors->has('yandexApi'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('yandexApi') }}</strong>
                    </span>
                @endif
            </div>

            <label>Тема</label>
            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       value=""
                       @if (empty($config->customTheme))
                       checked
                       @endif
                       id="check-default"
                       name="theme">
                <label class="form-check-label" for="check-default">
                    default
                </label>
            </div>
            @foreach($themes as $key => $theme)
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           @if (old('theme') == $theme)
                           checked
                           @elseif ($config->customTheme == $theme)
                           checked
                           @endif
                           value="{{ $theme }}"
                           id="check-{{ $key }}"
                           name="theme">
                    <label class="form-check-label" for="check-{{ $key }}">
                        {{ $key }}
                    </label>
                </div>
            @endforeach

            <div class="form-check">
                <input type="checkbox"
                       @if($config->useOwnAdminRoutes)
                       checked
                       @endif
                       class="form-check-input"
                       value=""
                       name="own-admin"
                       id="own-admin">
                <label for="own-admin">
                    Собственные адреса для админки
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox"
                       @if($config->useOwnSiteRoutes)
                       checked
                       @endif
                       class="form-check-input"
                       value=""
                       name="own-site"
                       id="own-site">
                <label for="own-site">
                    Собвственные адреса для сайта
                </label>
            </div>

            <div class="btn-group mt-2"
                 role="group">
                <button type="submit" class="btn btn-success">
                    Обновить
                </button>
            </div>
        </form>
    </div>
    @endrole
@endsection
