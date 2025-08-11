import configure from '../config/configure.js';
import dataHandler from '../helpers/dataHandler.js';
import alertWindow from '../view/AlertWindow.js';

export default class SaveButton {
    constructor(scheduleListModel) {
        this._scheduleListModel = scheduleListModel;
        this._init();
    }

    _init() {
        const submitButtonTop = document.querySelector('#save__schedule-top');
        submitButtonTop.addEventListener('click', this._clickListenerSubmit.bind(this, this._scheduleListModel));

        const submitButton = document.querySelector('#save__schedule');
        submitButton.addEventListener('click', this._clickListenerSubmit.bind(this, this._scheduleListModel));
    }

    _clickListenerSubmit(scheduleListModel) {
        const scheduleList = scheduleListModel.getActive();
        if (configure.debug) console.log(scheduleList);

        if (scheduleList.length > 0)
            dataHandler
                .createSchedules(error => { console.log(error) }, { schedules: scheduleList })
                .then((result) => {
                    const answer = JSON.parse(JSON.stringify(result));
                    let alertBlock = document.querySelector('.alert-message');
                    alertBlock.textContent = '';
                    switch (answer.status.toLowerCase()) {
                        case 'ok':
                            if (configure.debug) console.log(JSON.stringify(result));
                            const message = `Данные успешно сохранены`;
                            alertWindow.renderBlock(alertBlock, message, 'success', 'beforeend');
                            alertWindow.alertBlockAutoClose(alertBlock, 3000);
                            break;
                        case 'error':
                            if (configure.debug) console.log(JSON.stringify(result));
                            const error = 'Возникла ошибка при сохранении данных';
                            alertWindow.renderBlock(alertBlock, error, 'danger', 'beforeend');
                            alertWindow.alertBlockAutoClose(alertBlock, 3000);
                            break;
                        default:
                            console.log('Wrong Answer');
                    }
                });

        scheduleListModel.clearActive();
    }
}
