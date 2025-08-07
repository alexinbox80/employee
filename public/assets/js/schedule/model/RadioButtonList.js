import eventEmitter from '../helpers/eventEmitter.js';

export default class RadioButtonList {

    constructor() {
        this._radioButtonList = [];
        this._activeButton = null;
        this._eventEmitter = eventEmitter;
        this.init();
    }

    init() {
        const lists = [];
        const radioStatusPanel = document.querySelectorAll('.radioStatusPanel');
        radioStatusPanel.forEach(radio => {
            radio.addEventListener('click', this._radioClickListener.bind(this, radio));
        });

        for (const button of radioStatusPanel) {
            lists.push({
                'id': parseInt(button.dataset.id),
                'letter': button.dataset.letter,
                'color': button.dataset.color,
                'description': button.dataset.description
            })
        }

        if (lists.length) {
            this._radioButtonList = lists;
        }
    }

    _radioClickListener(button) {
        this._activeButton = {
            'id': parseInt(button.dataset.id),
            'letter': button.dataset.letter,
            'color': button.dataset.color,
            'description': button.dataset.description
        };
    }

    _findActiveButton() {
        let active = null;
        const buttons = document.querySelectorAll('.radioStatusPanel');

        for (const button of buttons) {
            if (button.checked) {
                active = {
                    'id': parseInt(button.dataset.id),
                    'letter': button.dataset.letter,
                    'color': button.dataset.color,
                    'description': button.dataset.description
                }
            }
        }

        if(active != null)
            this._activeButton = active;
    }

    getAll() {
        return this._radioButtonList;
    }

    getActive() {
        this._findActiveButton();
        return this._activeButton;
    }
}
