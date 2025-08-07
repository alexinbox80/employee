import eventEmitter from "../helpers/eventEmitter.js";

export default class RadioButtonList {

    constructor() {
        this._radioButtonList = [];
        this._activeButton = null;
        this._eventEmitter = eventEmitter;
        this.init();
    }

    init() {
        const radioStatusPane = document.querySelectorAll('.radioStatusPanel');
        radioStatusPane.forEach(radio => {
            radio.addEventListener('click', this._radioClickListener.bind(this, radio));
        });
    }

    _radioClickListener(button) {
        this._activeButton = {
            'id': parseInt(button.dataset.id),
            'letter': button.dataset.letter,
            'color': button.dataset.color,
            'description': button.dataset.description
        };
    }

    createRadioButtonList() {
        const lists = [];
        const buttons = document.querySelectorAll('.radioStatusPanel');

        for (const button of buttons) {
                lists.push({
                    'id': parseInt(button.dataset.id),
                    'letter': button.dataset.letter,
                    'color': button.dataset.color,
                    'description': button.dataset.description
                })
        }

        if (lists.length) {
            this._radioButtonList = lists;
            return true;
        } else
            return false;
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
