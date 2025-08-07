import paragraph from './Paragraph.js';
import statusView from './StatusView.js';

export default class TableView {
    constructor(scheduleListModel, radioButtonModel) {
        this._scheduleListModel = scheduleListModel;
        this._radioButtonModel = radioButtonModel;
        this._init();
        this._render();
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
            const date = new Date(schedule.date); // August 8, 2025 (a Friday)
            const dayOfMonth = date.getDate();
            const index = parseInt(schedule.employee_id) * 100 + dayOfMonth;
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
                'employee_id': parseInt(cell.dataset.employee_id),
                'status_id': parseInt(activeButton.id),
                'date': cell.dataset.date,
                'isDelete': false
            });
            statusView.render(cell, activeButton);
        } else {
            this._scheduleListModel.remove({
                'employee_id': parseInt(cell.dataset.employee_id),
                'date': cell.dataset.date,
            })
            statusView.render(cell, activeButton);
        }

        console.log(this._scheduleListModel.getAll());
    }
}
