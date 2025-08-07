export default class TableView {
    constructor(scheduleList) {
        this._scheduleList = scheduleList;

        this._render();
    }

    _render() {
        this._scheduleList.forEach((schedule) => {
            const date = new Date(schedule.date); // August 8, 2025 (a Friday)
            const dayOfWeek = date.getDay();
            const index = parseInt(schedule.employee_id) * 100 + dayOfWeek;
            console.log(index);
            const cell = document.querySelectorAll(`#cell-${ index }`);
        });
    }
}
