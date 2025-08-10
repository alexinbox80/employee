import paragraph from './Paragraph.js';
import statusView from './StatusView.js';
import makeIndex from '../utils/makeIndex.js';
import ScheduleList from '../model/ScheduleList.js';
import dataHandler from '../helpers/dataHandler.js'
import Schedule from '../model/Schedule.js';

export default class TableView extends ScheduleList {
    constructor(scheduleListModel, radioButtonModel) {
        super();
        this._scheduleListModel = scheduleListModel;
        this._radioButtonModel = radioButtonModel;
        this._init();
        //this._render();
        this._getData();
    }

    load() {
        return super.load(dataHandler.getSchedules.bind(dataHandler), Schedule);
    }

    _getData() {
        dataHandler.getSchedules(error => { console.log(error)}).then(result => {
            const arr = [];
            result.data.forEach(schedule => {
                arr.push({
                    cellId: makeIndex(schedule.employeeId, schedule.date),
                    employeeId: schedule.employeeId,
                    statusId: schedule.statusId,
                    date: schedule.date,
                    isActive: false,
                    isDelete: false,
                });
            })

            this._render2(arr);
            return result;
        });
    }

    _init() {
        const tableCells = document.querySelectorAll('#onduty__create .cell__event');
        tableCells.forEach(cell => {
            cell.addEventListener('click', this._clickListener.bind(this, cell));
            cell.addEventListener('dblclick',  this._doubleClickListener.bind(this, cell));
        });
    }

    // _render() {
    //     const scheduleList = this._scheduleListModel.getAll();
    //     scheduleList.forEach((schedule) => {
    //         const index = makeIndex(schedule.employeeId, schedule.date);
    //         const cell = document.querySelectorAll(`#cell-${ index }`);
    //
    //         cell.forEach((item) => {
    //             const button = this._radioButtonModel.getAll();
    //             paragraph.createParagraph(item, button[schedule.statusId]);
    //         })
    //     });
    // }

    _render2(scheduleList) {
        scheduleList.forEach((schedule) => {
            const index = makeIndex(schedule.employeeId, schedule.date);
            const cell = document.querySelectorAll(`#cell-${ index }`);

            cell.forEach((item) => {
                const button = this._radioButtonModel.getAll();
                paragraph.createParagraph(item, button[schedule.statusId]);
            })
        });
    }

    _doubleClickListener(cell) {
        this._scheduleListModel.removeLast(cell);
    }

    _clickListener(cell) {
        const activeButton = this._radioButtonModel.getActive();

        //.slice(0, gridSet.length - 1);
        //console.log(parseInt(cell.id));

        // const cellId = cell.id;
        // console.log(cell.id.slice(5, cell.id.length));
        // const cellIdInt = parseInt(cellId.slice(5, cellId.length));
        const cellId = makeIndex(cell.dataset.employee_id, cell.dataset.date);

        const scheduleCell = new Schedule({
            cellId: cellId,
            employeeId: parseInt(cell.dataset.employee_id),
            statusId: parseInt(activeButton.id),
            date: cell.dataset.date,
            isDelete: false,
            isActive: true
        });

        if (activeButton.id > 0) {
            const isAddSchedule = this._scheduleListModel.addIfNotExist(scheduleCell.get, cellId);
            if (isAddSchedule === true)
                statusView.render(cell, activeButton);
        } else {
            this._scheduleListModel.remove({
                employeeId: parseInt(cell.dataset.employee_id),
                date: cell.dataset.date
            });
            if (this._scheduleListModel.scheduleIsExist(cellId))
                statusView.render(cell, activeButton);
        }

        console.log(this._scheduleListModel.getAll());
    }
}
