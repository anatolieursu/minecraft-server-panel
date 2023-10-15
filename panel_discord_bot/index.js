const config = require("./config");
const panel = require("./panel_sdk");

const connect = panel.connect_server;
connect.connect_to_panel(config.bot_token, config.panel_url)
    .then(cn => {
        return connect.on_events(config.panel_url)
    })
    .then(events => {
        for (let index = 0; index < events.length; index++) {
            const element = events[index];
        }
    });
console.log(connect);