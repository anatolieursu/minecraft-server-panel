const config = require("../../config");

class ForumObject {
    forums;
    async configureForums() {
        try {
          const panel = require("../../panel_sdk");
          const connect = panel.connect_server;
          await connect.connect_to_panel(config.bot_token, config.panel_url);

          const forums = await connect.on_forums(config.panel_url);
          this.forums = forums;
        } catch (error) {
          console.error('Eroare:', error);
        }
      }
      
}

module.exports = ForumObject