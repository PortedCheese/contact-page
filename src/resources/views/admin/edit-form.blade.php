<form action="{{ route('admin.contact.update', ['contact' => $contact]) }}"
      method="post">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="title">
            Заголовок
        </label>
        <input type="text"
               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
               id="title"
               name="title"
               value="{{ old('title') ? old('title') : $contact->title }}"
               required
               placeholder="Заголовок">
        @if ($errors->has('ico'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label class=""
               for="title">
            Описание
        </label>
        <textarea name="description"
                  id="ckDescription"
                  cols="30"
                  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                  rows="5">{{ old('description') ? old('description') : $contact->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="weight">Приоритет</label>
        <input type="number"
               id="weight"
               name="weight"
               value="{{ old('weight') ? old('weight') : $contact->weight }}"
               required
               class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}">
        @if ($errors->has('weight'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('weight') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="ico">Ico</label>
        <input type="text"
               id="ico"
               name="ico"
               value="{{ old('ico') ? old('ico') : $contact->ico }}"
               required
               class="form-control{{ $errors->has('ico') ? ' is-invalid' : '' }}">
        @if ($errors->has('ico'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ico') }}</strong>
            </span>
        @endif
        <small class="form-text text-muted">
            <a href="https://tech.yandex.ru/maps/jsapi/doc/2.1/ref/reference/option.presetStorage-docpage/" target="_blank">Список возможных меток</a>
        </small>
    </div>

    <button type="submit"
            class="btn btn-success">
        Обновить
    </button>

    @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</form>