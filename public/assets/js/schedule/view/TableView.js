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
                    id: makeIndex(schedule.employee_id, schedule.date),
                    employee_id: schedule.employee_id,
                    status_id: schedule.status_id,
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
        });
    }

    _render() {
        const scheduleList = this._scheduleListModel.getAll();
        scheduleList.forEach((schedule) => {
            const index = makeIndex(schedule.employee_id, schedule.date);
            const cell = document.querySelectorAll(`#cell-${ index }`);

            cell.forEach((item) => {
                const button = this._radioButtonModel.getAll();
                paragraph.createParagraph(item, button[schedule.status_id]);
            })
        });
    }

    _render2(scheduleList) {
        scheduleList.forEach((schedule) => {
            const index = makeIndex(schedule.employee_id, schedule.date);
            const cell = document.querySelectorAll(`#cell-${ index }`);

            cell.forEach((item) => {
                const button = this._radioButtonModel.getAll();
                paragraph.createParagraph(item, button[schedule.status_id]);
            })
        });
    }

    _clickListener(cell) {
        const activeButton = this._radioButtonModel.getActive();
        if (activeButton.id > 0) {
            this._scheduleListModel.add({
                cell_id: makeIndex(cell.dataset.employee_id, cell.dataset.date),
                employee_id: parseInt(cell.dataset.employee_id),
                status_id: parseInt(activeButton.id),
                date: cell.dataset.date,
                isDelete: false,
                isActive: true
            });
            statusView.render(cell, activeButton);
        } else {
            this._scheduleListModel.remove({
                employee_id: parseInt(cell.dataset.employee_id),
                date: cell.dataset.date
            })
            statusView.render(cell, activeButton);
        }

        console.log(this._scheduleListModel.getAll());
    }
}
