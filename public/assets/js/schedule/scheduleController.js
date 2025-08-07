import ScheduleList from './model/ScheduleList.js';
import RadioButtonList from './model/RadioButtonList.js';
import eventEmitter from './helpers/eventEmitter.js';
import StatusView from './view/StatusView.js';
import TableView from './view/TableView.js';

export default {
    _eventEmitter: eventEmitter,
    _scheduleListModel: new ScheduleList,
    _radioButtonModel: new RadioButtonList,
    _statusView: new StatusView,
    //_tableView: new TableView,

    init()
    {
        console.log('Schedule controller');

        // this._eventEmmiter.addListener('added', this._renderCart.bind(this));
        // this._eventEmmiter.addListener('removed', this._renderCart.bind(this));
        // this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));
        // this._eventEmmiter.addListener('loaded', this._renderShowcase.bind(this));

        //this._eventEmitter.addListener('loaded', this._renderPageCart.bind(this));
        //return super.load(dataHandler.getCatalog.bind(dataHandler), Good);
        //this._scheduleListModel.load();


        //this._eventEmmiter.emit('added', this._clickListener);

        //console.log(this);

        // this._cartModel.load();
        // this._showcaseModel.load();

        const tableCells = document.querySelectorAll('#onduty__create .cell__event');
        tableCells.forEach(cell => {
            cell.addEventListener('click', this._clickListener.bind(this, cell));
        });

        // const radioStatusPane = document.querySelectorAll('.radioStatusPanel');
        // radioStatusPane.forEach(radio => {
        //     radio.addEventListener('click', this._radioClickListener.bind(this, radio));
        // });

        const ans = this._scheduleListModel.createScheduleList();

        this._tableView = new TableView(this._scheduleListModel.getAll());

        if (this._radioButtonModel.createRadioButtonList())
            console.log(this._radioButtonModel.getAll());

        console.log(ans);
        console.log(this._scheduleListModel.getAll());

        console.log(this._radioButtonModel.getActive());

    },

    _clickListener(cell) {
        const activeButton = this._radioButtonModel.getActive();
        if (activeButton.id > 0) {
            this._scheduleListModel.add({
                'employee_id': parseInt(cell.dataset.employee_id),
                'status_id': parseInt(cell.dataset.status_id),
                'date': cell.dataset.date,
            });
            this._statusView.render(cell, activeButton);
        } else {
            this._scheduleListModel.remove({
                'employee_id': parseInt(cell.dataset.employee_id),
                'date': cell.dataset.date,
            })
            this._statusView.render(cell, activeButton);
        }

        console.log(this._scheduleListModel.getAll());
    }
}
