<div class="col-md-6 px-0 d-flex justify-content-between">
    @foreach($statuses as $key => $status)
        <div class="form-check me-2">
            <input class="radioStatusPanel form-check-input"
                   type="radio"
                   name="exampleRadios"
                   id="radio-{{$status->letter}}"
                   data-color="{{ $status->color }}"
                   data-description="{{ $status->description }}"
                   data-id="{{$status->id}}" value="{{ $status->letter }}" {{ $key === 4 ? 'checked' : '' }}>
            <label class="form-check-label" for="radio-{{$status->letter}}" title="{{ $status->letter }}">
                {{ $status->description }}
            </label>
        </div>
    @endforeach
</div>
