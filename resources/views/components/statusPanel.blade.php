<div class="col-md-12 px-0 d-flex justify-content-between">
    <div class="form-check me-2">
        <input class="radioStatusPanel form-check-input"
               type="radio"
               name="exampleRadios"
               id="radio-0"
               data-letter="Х"
               data-color="#E3D2EA"
               data-description="Удалить статус"
               data-id="0"
               value="Х">
        <label class="form-check-label" for="radio-0" title="Х">Удалить статус</label>
    </div>
    @foreach($statuses as $key => $status)
        <div class="form-check me-2">
            <input class="radioStatusPanel form-check-input"
                   type="radio"
                   name="exampleRadios"
                   id="radio-{{ $status->letter }}"
                   data-letter="{{ $status->letter }}"
                   data-color="{{ $status->color }}"
                   data-description="{{ $status->description }}"
                   data-id="{{ $status->id }}"
                   value="{{ $status->letter }}" {{ $key === 4 ? 'checked' : '' }}>
            <label class="form-check-label" for="radio-{{ $status->letter }}" title="{{ $status->letter }}">
                {{ $status->description }}
            </label>
        </div>
    @endforeach
</div>
