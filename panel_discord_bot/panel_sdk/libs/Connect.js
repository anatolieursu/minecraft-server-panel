const GetApplications = require("./resources/GetApplications");
const GetEvents = require("./resources/GetEvents");
const FetchAPI = require("./utilities/fetch_api");

class Connect {
    connected = false;
    events;
    forums;
    async connect_to_panel(bot_token, panel_url) {
        const connect_url = panel_url + "/api/connect"
        const fetch_post = new FetchAPI();
        const data = await fetch_post.post(connect_url, {"bot_token": bot_token})
        if(data.error_response) {
            console.log(data.error_response);
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
    async on_staff_applications(panel_url) {
        if(!this.connected) {
            console.log("Connect first!");
        } else {
            const on_applications_url = panel_url + "/api/on/applications";
            const result_applications = await GetApplications(on_applications_url);
            this.applications = await result_applications.response;
            return this.applications
        }
    }
    async on_forums(panel_url) {
        if(!this.connected) {
            console.log("Connect first!");
        } else {
            const on_forum_url = panel_url + "/api/on/forums";
            const result_forums = await GetApplications(on_forum_url);
            this.forums = await result_forums.response;
            return this.forums
        }
    }
}

module.exports = Connect