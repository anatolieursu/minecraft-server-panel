const config = require("../../config");

class EventObject {
    events;
    setChannelId(new_id) {
        this.channel = new_id;
    }

    async configureEvents() {
        try {
          const panel = require("../../panel_sdk");
          const connect = panel.connect_server;
          await connect.connect_to_panel(config.bot_token, config.panel_url);
      
          const events = await connect.on_events(config.panel_url);
          this.events = events;
        } catch (error) {
          console.error('Eroare:', error);
        }
      }
      
}

module.exports = EventObject