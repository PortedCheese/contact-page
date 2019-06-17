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
    </div>

    <div class="form-group">
        <label class="sr-only"
               for="title">
            Описание
        </label>
        <textarea name="description"
                  id="ckDescription"
                  cols="30"
                  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                  rows="5">{{ old('description') ? old('description') : $contact->description }}</textarea>
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