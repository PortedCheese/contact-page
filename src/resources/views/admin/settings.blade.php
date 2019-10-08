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

<div class="form-group">
    <label for="data-latitude">latitude</label>
    <input type="text"
           id="data-latitude"
           name="data-latitude"
           value="{{ old("data-latitude", $config->data["latitude"]) }}"
           class="form-control @error("data-latitude") is-invalid @enderror">
    @error("data-latitude")
        <div class="invalid-feedback" role="alert">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="data-longitude">longitude</label>
    <input type="text"
           id="data-longitude"
           name="data-longitude"
           value="{{ old("data-longitude", $config->data["longitude"]) }}"
           class="form-control @error("data-longitude") is-invalid @enderror">
    @error("data-longitude")
        <div class="invalid-feedback" role="alert">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="data-zoom">Zoom</label>
    <input type="text"
           id="data-zoom"
           name="data-zoom"
           value="{{ old("data-zoom", $config->data["zoom"]) }}"
           class="form-control @error("data-zoom") is-invalid @enderror">
    @error("data-zoom")
        <div class="invalid-feedback" role="alert">
            {{ $message }}
        </div>
    @enderror
</div>

