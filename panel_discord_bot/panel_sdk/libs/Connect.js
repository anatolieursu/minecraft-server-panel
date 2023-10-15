const GetEvents = require("./resources/GetEvents");
const FetchAPI = require("./utilities/fetch_api");

class Connect {
    connected = false;
    events;
    async connect_to_panel(bot_token, panel_url) {
        const connect_url = panel_url + "/api/connect"
        const fetch_post = new FetchAPI();
        const data = await fetch_post.post(connect_url, {"bot_token": bot_token})
        if(data.error_response) {
            console.log("Found an error: " + data.error_response.toString);
        }
        if(data.status_code) {
            if(data.status_code === 200) {
                this.connected = true;
            }
        } else {
            console.log("No status code found");
        }
    }
    async on_events(panel_url) {
        if(!this.connected) {
            console.log("Connect first!");
        } else {
            const on_events_url = panel_url + "/api/on/events"
            const result_events = await GetEvents(on_events_url)
            this.events = await result_events.response
            return this.events
        }
    }
}

module.exports = Connect