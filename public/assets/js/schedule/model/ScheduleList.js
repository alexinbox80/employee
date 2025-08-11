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

    async createScheduleListApi() {
        await dataHandler
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
                this._scheduleList = arr;
            });

         return !!this._scheduleList.length;
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
        this._scheduleList
            .filter(schedule => schedule.isActive === true)
            .forEach(schedule => schedule.isActive = false);
    }

    getAll() {
        return this._scheduleList;
    }

    getByEmployeeId(employeeId) {
        return this._scheduleList.find(schedule => schedule.employeeId === employeeId);
    }
}
