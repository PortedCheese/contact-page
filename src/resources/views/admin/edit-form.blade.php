<form action="{{ route('admin.contact.update', ['contact' => $contact]) }}"
      method="post">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="title">Заголовок <span class="text-danger">*</span></label>
        <input type="text"
               id="title"
               name="title"
               required
               value="{{ old("title", $contact->title) }}"
               class="form-control @error("title") is-invalid @enderror">
        @error("title")
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="address">Адрес</label>
        <input type="text"
               id="address"
               name="address"
               value="{{ old("address", $contact->address) }}"
               class="form-control @error("address") is-invalid @enderror">
        @error("address")
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label class=""
               for="ckDescription">
            Описание
        </label>
        <textarea name="description"
                  id="ckDescription"
                  cols="30"
                  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} tiny"
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
        @can("delete", \App\Contact::class)
            <button type="button" class="btn btn-danger" data-confirm="{{ "delete-contact-form-{$contact->id}" }}">
                Удалить
            </button>
        @endcan
    </div>

    @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</form>

@can("delete", \App\Contact::class)
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
@endcan