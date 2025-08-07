export default class Schedule {
    constructor({emloyee_id, status_id, date, isDelete}) {
        this._employee_id = employee_id;
        this._status_id = status_id;
        this._date = date;
        this._isDelete = isDelete;
    }

    get employeeId() { return this._employee_id; }

    get statusId() { return this._status_id; }

    get date() { return this._date; }

    get isDelete() { return this._isDelete; }
}
