const Connect = require("./Connect")
const get_events = require("./resources/GetEvents")

module.exports = {
    connect_server: new Connect(),
    getEvents: new get_events()
}