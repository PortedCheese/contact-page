<form action="{{ route('admin.contact.update', ['contact' => $contact]) }}"
      method="post"
      class="form-inline">
    @csrf
    @method('put')

    <label class="sr-only mb-2"
           for="title">
        Заголовок
    </label>
    <input type="text"
           class="form-control mb-2 mr-sm-2{{ $errors->has('title') ? ' is-invalid' : '' }}"
           id="title"
           name="title"
           value="{{ old('title') ? old('title') : $contact->title }}"
           required
           placeholder="Заголовок">

    <label class="sr-only mb-2"
           for="title">
        Описание
    </label>
    <input type="text"
           class="form-control mb-2 mr-sm-2{{ $errors->has('description') ? ' is-invalid' : '' }}"
           id="description"
           name="description"
           value="{{ old('description') ? old('description') : $contact->description }}"
           placeholder="Описание">

    <button type="submit"
            class="btn btn-success mb-2">
        Обновить
    </button>

    @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</form>