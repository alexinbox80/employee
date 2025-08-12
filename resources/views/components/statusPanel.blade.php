<div class="row">
    <div class="d-flex justify-content-between">
        <div class="col-md-9 px-0 d-flex">
            <div class="d-flex flex-column">
                <input class="my-1 mx-1 sp__input radioStatusPanel"
                       type="radio"
                       title="Удалить статус"
                       name="exampleRadios"
                       id="radio-0"
                       data-letter="Х"
                       data-color="#E3D2EA"
                       data-description="Удалить статус"
                       data-id="0"
                       value="Х">
                <label class="my-1 mx-1 sp__column" for="radio-0" title="Удалить статус">
                    <p class="table__grid-p" style="background-color: #E3D2EA">
                        Х
                    </p>
                </label>
            </div>
            @foreach($statuses as $key => $status)
                <div class="d-flex flex-column">
                    <input class="my-1 mx-1 sp__input radioStatusPanel"
                           type="radio"
                           name="exampleRadios"
                           title="{{ $status->description }}"
                           id="radio-{{ $status->letter }}"
                           data-letter="{{ $status->letter }}"
                           data-color="{{ $status->color }}"
                           data-description="{{ $status->description }}"
                           data-id="{{ $status->id }}"
                           value="{{ $status->letter }}" {{ $key === 4 ? 'checked' : '' }}>
                    <label class="my-1 mx-1 sp__column" for="radio-{{ $status->letter }}" title="{{ $status->description }}">
                        <p class="table__grid-p" style="background-color: {{ $status->color }}">
                            {{ $status->letter }}
                        </p>
                    </label>
                </div>
            @endforeach
        </div>
        <div class="button">
            <span id="clear__schedule-top" class="btn btn-outline-info me-2">Очистить</span>
            <span id="save__schedule-top" class="btn btn-outline-primary me-2">Сохранить</span>
        </div>
    </div>
</div>
