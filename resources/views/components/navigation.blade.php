<div class="row">
    <form method="get" action="{{ route('page.get.index') }}">
{{--        @csrf--}}
        <div class="d-flex">
            <div class="col-md-5 mb-3 px-4">
                <label for="month" class="form-label">Месяц:</label>
                <select id="month" class="form-select form-select-sm mb-3" aria-label="" name="month">
                    @foreach(getMonthsArray() as $key => $month)
                        <option {{ ($key + 1 == ltrim($currentMonth, '0')) ? 'selected' : ''  }} value="{{ $key + 1 }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 mb-3 px-4">
                <label for="year" class="form-label">Год:</label>
                <select id="year" class="form-select form-select-sm mb-3" aria-label="" name="year">
                    @for($year = 2006; $year <= $currentYear; $year++)
                        <option {{ ($year == $currentYear) ? 'selected' : ''  }} value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="col mb-3 mt-md-4 px-4">
                <button class="btn btn-success" type="submit">Получить</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 px-4 text-center">
                <a class="btn btn-outline-dark" href="{{ generateURLDecrement(url('/'), $currentMonth, $currentYear) }}">Предыдущий месяц</a>
            </div>
            <div class="col-md-6 mb-3 px-4 text-center">
                <a class="btn btn-outline-dark" href="{{ generateURLIncrement(url('/'), $currentMonth, $currentYear) }}">Следующий месяц</a>
            </div>
        </div>
    </form>
</div>
