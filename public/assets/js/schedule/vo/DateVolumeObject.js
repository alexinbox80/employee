export default class DateVolumeObject {
    constructor(day = 1, month = 1, year = 2025) {
        this._day = day;
        this._month = month;
        this._year = year;
    }

    get day() {
        const day = '' + this._day;
        if (day.length < 2)
            return '0' + day;

        return day;
    }

    get month() {
        const month = '' + this._month;
        if (month.length < 2)
            return '0' + month;

        return month;
    }

    get year() {
        return this._year;
    }

    get date() {
        return [this._year, this._month, this._day].join('-');
    }
}
