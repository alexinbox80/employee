import configure from '../config/configure.js';

export default {
    _url: configure.url,

    async getSchedules(errorCallBack, month, year) {
        return await fetch(`${this._url}schedules?month=${month}&year=${year}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    return errorCallBack(response.status);
                }
            })
            .then((data) => data)
            .catch((error) => {
                return errorCallBack(error);
            })
    },

    async createSchedules(errorCallBack, data) {
        return await fetch(`${this._url}schedules`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
            .then((response) => {
                if (response.ok) {
                    return response.json()
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    },

    async deleteFromModels(errorCallBack, id) {
        return await fetch(`${this._url}delete`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: {id: id}
        })
            .then((response) => {
                if (response.ok) {
                    return true;
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    }
}
