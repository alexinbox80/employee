export default {
    _url: 'http://localhost:8080',

    async createSchedules(errorCallBack, data) {
        return await fetch(`${this._url}/schedules`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
            .then((response) => {
                if (response.ok) {
                    //return true;
                    return response.json()
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    },

    deleteFromModels(errorCallBack, id) {
        return fetch(`${this._url}/delete`, {
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
