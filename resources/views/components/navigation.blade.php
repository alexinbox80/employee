<div class="row">
    <div class="d-flex">
        <div class="col-md-5 mb-3 px-4">
            <label for="month" class="form-label">Месяц:</label>
            <select id="month" class="form-select form-select-sm mb-3" aria-label="">
                @foreach(getMonthsArray() as $key => $month)
                    <option {{ ($key + 1 == ltrim($currentMonth, '0')) ? 'selected' : ''  }} value="{{ $key + 1 }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5 mb-3 px-4">
            <label for="year" class="form-label">Год:</label>
            <select id="year" class="form-select form-select-sm mb-3" aria-label="">
                @for($year = 2006; $year <= $currentYear; $year++)
                    <option {{ ($year == $currentYear) ? 'selected' : ''  }} value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
