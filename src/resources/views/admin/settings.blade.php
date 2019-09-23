<div class="form-group">
    <label for="path">Путь</label>
    <input type="text"
           id="path"
           name="data-path"
           value="{{ old("path", $config->data["path"]) }}"
           class="form-control @error("data-path") is-invalid @enderror">
    @error("data-path")
        <div class="invalid-feedback" role="alert">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="yandexApi">Yandex API</label>
    <input type="text"
           id="yandexApi"
           name="data-yandexApi"
           value="{{ old("yandexApi", $config->data["yandexApi"]) }}"
           class="form-control @error("data-yandexApi") is-invalid @enderror">
    @error("data-yandexApi")
        <div class="invalid-feedback" role="alert">
            {{ $message }}
        </div>
    @enderror
</div>

