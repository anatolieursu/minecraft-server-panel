const GetEvents = require("./resources/GetEvents");

class Connect {
    connect_to_panel(bot_token, panel_url) {
        const connect_url = panel_url + "/api/connect"
        const data = {
            bot_token: bot_token
        };

        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        };

        fetch(connect_url, requestOptions)
            .then(response => {
                if (!response.ok) {
                    console.log(response)
                    throw new Error('Cererea a eșuat');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Eroare:', error);
            });
    }
    on_events(panel_url) {
        const on_events_url = panel_url + "/api/on/events"
        GetEvents(on_evens_url)
    }
}

module.exports = Connect