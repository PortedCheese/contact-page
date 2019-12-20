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

    <div class="btn-group"
         role="group">
        <button type="submit" class="btn btn-success">Обновить</button>
        <button type="button" class="btn btn-danger" data-confirm="{{ "delete-contact-form-{$contact->id}" }}">
            Удалить
        </button>
    </div>

    @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</form>
<confirm-form :id="'{{ "delete-contact-form-{$contact->id}" }}'">
    <template>
        <form action="{{ route('admin.contact.destroy', ['contact' => $contact]) }}"
              id="delete-contact-form-{{ $contact->id }}"
              class="btn-group"
              method="post">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
        </form>
    </template>
</confirm-form>