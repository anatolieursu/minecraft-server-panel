const config = require("./config");
const panel = require("./panel_sdk");

const connect = panel.connect_server.connect_to_panel(config.bot_token, config.panel_url);

console.log(connect);