const { ActivityType, Events } = require("discord.js")
const { REST } = require("@discordjs/rest");
const { Routes } = require("discord-api-types/v10");

module.exports = {
    name: Events.ClientReady,
    once: true,
    execute(client) {
        const rest = new REST({ version: "10" }).setToken(client.token);
        console.log(`${client.user.username} is on!`);
        async function setCommands() {
            try {
                await rest.put(Routes.applicationCommands(client.user.id), {
                body: client.slashdatas,
                });
            } catch (error) {
                console.error(error);
            }
          }
          setCommands()  
    }
}