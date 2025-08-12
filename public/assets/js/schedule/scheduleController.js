import configure from './config/configure.js';
import ScheduleList from './model/ScheduleList.js';
import RadioButtonList from './model/RadioButtonList.js';
import eventEmitter from './helpers/eventEmitter.js';
import TableView from './view/TableView.js';
import SaveButton from './model/SaveButton.js';
import dateVolumeObject from './vo/DateVolumeObject.js';

export default {
    _eventEmitter: eventEmitter,
    _scheduleListModel: new ScheduleList,
    _radioButtonModel: new RadioButtonList,

    init() {
        const urlParams = new URLSearchParams(window.location.search);
        const month = parseInt(urlParams.get('month')); // Retrieves the value of the 'name' parameter
        const year = parseInt(urlParams.get('year'));

        if (configure.debug) {
            console.log('Schedule controller');
        }

        const dVolumeObject = new dateVolumeObject(1, month, year);

        // this._eventEmitter.addListener('added', this._renderCart.bind(this));
        // this._eventEmitter.addListener('removed', this._renderCart.bind(this));
        // this._eventEmitter.addListener('loaded', this._renderCart.bind(this));
        //this._eventEmitter.addListener('loaded', this._tableView._render.bind(this));

        //this._eventEmmiter.emit('added', this._clickListener);

        //console.log(this);

        // this._cartModel.load();
        //this._tableView.load();

        this._scheduleListModel.createScheduleListApi(dVolumeObject)
            .then(
                data => {
                    const table = new TableView(this._scheduleListModel, this._radioButtonModel);

                    if (data === true) {
                        table.render();
                    }

                    new SaveButton(this._scheduleListModel, table);
                }
        );
    }
}
