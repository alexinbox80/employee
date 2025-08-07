import ScheduleList from './model/ScheduleList.js';
import RadioButtonList from './model/RadioButtonList.js';
import eventEmitter from './helpers/eventEmitter.js';
import TableView from './view/TableView.js';
import dataHandler from './helpers/dataHandler.js';

export default {
    _eventEmitter: eventEmitter,
    _scheduleListModel: new ScheduleList,
    _radioButtonModel: new RadioButtonList,
    //_dataHandler: new DataHandler,

    init() {
        console.log('Schedule controller');

        // this._eventEmmiter.addListener('added', this._renderCart.bind(this));
        // this._eventEmmiter.addListener('removed', this._renderCart.bind(this));
        // this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));
        // this._eventEmmiter.addListener('loaded', this._renderShowcase.bind(this));


        //this._eventEmmiter.emit('added', this._clickListener);

        //console.log(this);

        // this._cartModel.load();
        // this._showcaseModel.load();

        const ans = this._scheduleListModel.createScheduleList();
        this._tableView = new TableView(this._scheduleListModel, this._radioButtonModel);

        // if (this._radioButtonModel.createRadioButtonList())
        //     console.log(this._radioButtonModel.getAll());

        // console.log(ans);
        // console.log(this._scheduleListModel.getAll());
        //
        // console.log(this._radioButtonModel.getActive());


        const submitButton = document.querySelector('#save__schedule');
        const scheduleList = this._scheduleListModel.getAll();
        submitButton.addEventListener('click', this._clickListenerSubmit.bind(this, scheduleList));

    },

    _clickListenerSubmit(scheduleList) {
        console.log(scheduleList);
        dataHandler
            .createSchedules(error => { console.log(error) }, { schedules: scheduleList })
            .then((result) => {
                const answer = JSON.parse(JSON.stringify(result));
                let alertBlock = document.querySelector('.alert-message');
                alertBlock.textContent = '';
                switch (answer.status.toLowerCase()) {
                    case 'ok':
                        console.log(JSON.stringify(result));
                        const message = `Данные успешно сохранены`;
                        this._renderBlock(alertBlock, message, 'success', 'beforeend');
                        this._alertBlockAutoClose(alertBlock, 3000);
                        break;
                    case 'error':
                        console.log(JSON.stringify(result));
                        const error = 'Возникла ошибка при сохранении данных';
                        this._renderBlock(alertBlock, error, 'danger', 'beforeend');
                        this._alertBlockAutoClose(alertBlock, 3000);
                        break;
                    default:
                        console.log('Wrong Answer');
                }
            });
    },

    _getHtml(message, type = 'success') {
        return `<div class="alert alert-${type} alert-dismissible fade show">
                                ${message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`;
    },

    _renderBlock(container, message, type = 'success', target = 'afterbegin') {
        container.insertAdjacentHTML(target, this._getHtml(message, type));
        return true;
    },

    _alertBlockAutoClose(block, delay) {
        setTimeout(function() {
            if (block) {
                block.textContent = '';
            }
        }, delay);
    }
}
