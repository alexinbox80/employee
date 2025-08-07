import eventEmitter from '../helpers/eventEmitter.js';

export default class ScheduleList {

    constructor() {
        this._scheduleList = [];
        this._eventEmitter = eventEmitter;
    }

    load(callback, scheduleClass){

        callback().then(data => {

            this._scheduleList = data.map(item => new scheduleClass(item));

            this._eventEmitter.emit('loaded');

        });

    }

    createScheduleList() {
        const lists = [];
        const cellGrids = document.querySelectorAll('.cell__event');

        cellGrids.forEach(cell => {
            if ('set' in cell.dataset) {
                const gridSet = cell.dataset.set;
                const gridSetArray = gridSet.split(';').slice(0, gridSet.length - 1);

                gridSetArray.forEach(ind => {
                    if(parseInt(ind)) {
                        lists.push({
                            employee_id: parseInt(cell.dataset.employee_id),
                            status_id: parseInt(ind),
                            date: cell.dataset.date,
                            isDelete: false
                        });
                    }
                });
            }
        });

        if (lists.length > 0) {
            this._scheduleList = lists;
            return true;
        } else
            return false;
    }

    add(schedule) {
        this._scheduleList.push(schedule);
    }

    remove(data) {
        this._scheduleList.forEach(schedule => {
            if (schedule.employee_id === data.employee_id && schedule.date === data.date)
                schedule.isDelete = true;
        });
    }

    get(data) {
        return this._scheduleList.find(schedule => schedule.date === data.date);
    }

    getAll() {
        return this._scheduleList;
    }

    getByEmployeeId(employeeId) {
        return this._scheduleList.find(schedule => schedule.employee_id === employeeId);
    }
}
