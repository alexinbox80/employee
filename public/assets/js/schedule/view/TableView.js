import configure from '../config/configure.js';
import employeeId from '../utils/getEmployeeIdFromCellId.js';
import day from '../utils/getDayFromCellId.js';
import paragraph from './Paragraph.js';
import statusView from './StatusView.js';
import makeIndex from '../utils/makeIndex.js';
import ScheduleList from '../model/ScheduleList.js';
import dataHandler from '../helpers/dataHandler.js'
import Schedule from '../model/Schedule.js';
import dateFormat from '../utils/dateFormat.js';

export default class TableView extends ScheduleList {
    constructor(scheduleListModel, radioButtonModel) {
        super();
        this._scheduleListModel = scheduleListModel;
        this._radioButtonModel = radioButtonModel;
        this._init();
    }

    load() {
        return super.load(dataHandler.getSchedules.bind(dataHandler), Schedule);
    }

    _init() {
        const tableCells = document.querySelectorAll('#onduty__create .cell__event');
        tableCells.forEach(cell => {
            cell.addEventListener('click', this._clickListener.bind(this, cell));
            cell.addEventListener('dblclick', this._doubleClickListener.bind(this, cell));
        });
    }

    render() {
        const scheduleList = this._scheduleListModel.getAll();
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
        const cellId = parseInt(cell.id.slice(5, cell.id.length));

        const scheduleCell = new Schedule({
            cellId: cellId,
            employeeId: employeeId(cellId),
            statusId: parseInt(activeButton.id),
            date: dateFormat(cell.dataset.date),
            isDelete: false,
            isActive: true
        });

        if (activeButton.id > 0) {
            const isAddSchedule = this._scheduleListModel.addIfNotExist(scheduleCell.get, cellId);
            if (isAddSchedule === true)
                statusView.render(cell, activeButton);
        } else {
            this._scheduleListModel.remove({
                employeeId: parseInt(employeeId(cellId)),
                date: dateFormat(cell.dataset.date)
            });
            if (this._scheduleListModel.scheduleIsExist(cellId))
                statusView.render(cell, activeButton);
        }

        if (configure.debug)
            console.log(this._scheduleListModel.getAll());
    }
}
