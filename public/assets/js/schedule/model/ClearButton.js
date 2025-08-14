import configure from '../config/configure.js';
import employeeId from "../utils/getEmployeeIdFromCellId.js";
import dateFormat from "../utils/dateFormat.js";
import statusView from "../view/StatusView.js";

export default class ClearButton {
    constructor(scheduleListModel) {
        this._scheduleListModel = scheduleListModel;
        this._init();
    }

    _init() {
        const clearButtonTop = document.querySelector('#clear__schedule-top');
        clearButtonTop.addEventListener('click', this._clickClearListener.bind(this, this._scheduleListModel));

        const clearButtonBottom = document.querySelector('#clear__schedule-bottom');
        clearButtonBottom.addEventListener('click', this._clickClearListener.bind(this, this._scheduleListModel));
    }

    _clickClearListener(scheduleListModel) {
        if (configure.debug) console.log('click clear');
        location.reload();
        // const scheduleList = scheduleListModel.getActive();
        // if (configure.debug) console.log(scheduleList);
        //
        // scheduleList.forEach((schedule) => {
        //     const cell = document.querySelector(`#cell-${ schedule.cellId }`);
        //     //cell.remove();
        //
        //     this._scheduleListModel.drop({
        //         cellId: schedule.cellId
        //     });
        //
        //     console.log();
        // })
    }
}
