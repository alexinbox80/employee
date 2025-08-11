import configure from './config/configure.js';
import ScheduleList from './model/ScheduleList.js';
import RadioButtonList from './model/RadioButtonList.js';
import eventEmitter from './helpers/eventEmitter.js';
import TableView from './view/TableView.js';
import SaveButton from './model/SaveButton.js';

export default {
    _eventEmitter: eventEmitter,
    _scheduleListModel: new ScheduleList,
    _radioButtonModel: new RadioButtonList,

    init() {
        if (configure.debug) {
            console.log('Schedule controller');
        }

        // this._eventEmitter.addListener('added', this._renderCart.bind(this));
        // this._eventEmitter.addListener('removed', this._renderCart.bind(this));
        // this._eventEmitter.addListener('loaded', this._renderCart.bind(this));
        //this._eventEmitter.addListener('loaded', this._tableView._render.bind(this));

        //this._eventEmmiter.emit('added', this._clickListener);

        //console.log(this);

        // this._cartModel.load();
        //this._tableView.load();

        this._scheduleListModel.createScheduleListApi()
            .then(
                data => {
                    if (data === true) {
                        new TableView(this._scheduleListModel, this._radioButtonModel).render();
                    }

                    new SaveButton(this._scheduleListModel);
                }
        );
    }
}
