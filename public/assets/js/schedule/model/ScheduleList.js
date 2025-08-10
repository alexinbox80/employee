import eventEmitter from '../helpers/eventEmitter.js';
import makeIndex from '../utils/makeIndex.js';
import dataHandler from '../helpers/dataHandler.js'
import Schedule from './Schedule.js';

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
                            cellId: makeIndex(cell.dataset.employee_id, cell.dataset.date),
                            employeeId: parseInt(cell.dataset.employee_id),
                            statusId: parseInt(ind),
                            date: cell.dataset.date,
                            isDelete: false,
                            isActive: false,
                        });
                    }
                });
            }
        });

        if (lists.length > 0) {
            console.log(lists);
            this._scheduleList = lists;
            return true;
        } else
            return false;
    }

    createScheduleListApi() {
        dataHandler
            .getSchedules(error => { console.log(error)})
            .then(result => {
                const arr = [];
                result.data.forEach(schedule => {
                    const scheduleCell = new Schedule({
                        cellId: makeIndex(schedule.employeeId, schedule.date),
                        employeeId: schedule.employeeId,
                        statusId: schedule.statusId,
                        date: schedule.date,
                        isActive: false,
                        isDelete: false,
                    });
                    arr.push(scheduleCell.get);
                })
                return arr;
            })
            .then(data => {
                let ans = [];
                data.forEach(item => {
                    ans.push(new Schedule(item).get);
                });
                // console.log(ans);
                this._scheduleList = ans;
                console.log(this._scheduleList);
            });

        return true;
    }

    add(schedule) {
        this._scheduleList.push(schedule);
    }

    addIfNotExist(schedule, cellId) {
        const scheduleList = this._scheduleList.filter(item => item.cellId === cellId);
        const hasItem = scheduleList.some(item => item.statusId === schedule.statusId);

        if (!hasItem) {
            this._scheduleList.push(schedule);
            return true;
        }
        return false;
    }

    scheduleIsExist(cellId) {
        return this._scheduleList.some(item => item.cellId === cellId);
    }

    remove(data) {
        this._scheduleList.forEach(schedule => {
            if (schedule.employeeId === data.employeeId && schedule.date === data.date) {
                schedule.isDelete = true;
                schedule.isActive = true;
            }
        });
    }

    removeLast(cell) {
        const scheduleCell = document.getElementById(cell.id);

        if (scheduleCell.lastChild) {
            scheduleCell.removeChild(scheduleCell.lastChild);
            this._scheduleList.pop();
        }
    }

    get(data) {
        return this._scheduleList.find(schedule => schedule.date === data.date);
    }

    getActive() {
        return this._scheduleList.filter(schedule => schedule.isActive === true);
    }

    clearActive() {
        return this._scheduleList.filter(schedule => schedule.isActive !== true);
    }

    getAll() {
        return this._scheduleList;
    }

    getByEmployeeId(employeeId) {
        return this._scheduleList.find(schedule => schedule.employeeId === employeeId);
    }
}
