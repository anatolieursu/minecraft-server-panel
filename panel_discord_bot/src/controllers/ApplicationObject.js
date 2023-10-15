const config = require("../../config");

class ApplicationObject {
    applications;
    async configureApplications() {
        try {
          const panel = require("../../panel_sdk");
          const connect = panel.connect_server;
          await connect.connect_to_panel(config.bot_token, config.panel_url);

          const applications = await connect.on_staff_applications(config.panel_url);
          this.applications = applications;
        } catch (error) {
          console.error('Eroare:', error);
        }
      }
      
}

module.exports = ApplicationObject