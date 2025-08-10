export default class Schedule {
    constructor({cellId, employeeId, statusId, date, isDelete = false, isActive = false}) {
        this._cellId = cellId;
        this._employeeId = employeeId;
        this._statusId = statusId;
        this._date = date;
        this._isDelete = isDelete;
        this._isActive = isActive;
    }

    get cellId() { return this._cellId; }

    get employeeId() { return this._employeeId; }

    get statusId() { return this._statusId; }

    get date() { return this._date; }

    get isDelete() { return this._isDelete; }

    get isActive() { return this._isActive; }

    get get() {
        return {
            cellId: this._cellId,
            employeeId: this._employeeId,
            statusId: this._statusId,
            date: this._date,
            isDelete: this._isDelete,
            isActive: this._isActive
        };
    }
}
