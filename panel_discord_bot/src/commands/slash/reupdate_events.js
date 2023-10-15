const { EmbedBuilder, PermissionsBitField, Embed } = require("discord.js");
const { SlashCommandBuilder } = require("@discordjs/builders");
const EventObject = require("../../controllers/EventObject");
module.exports = {
  data: new SlashCommandBuilder()
    .setName("new_events")
    .setDescription("Find the new events"),
    run: async (client, interaction) => {
      const data = new EventObject();
      await data.configureEvents()
      const events = await data.events;

      const channel = interaction.channel;

      for (let index = 0; index < events.length; index++) {
        const element = events[index];
        const embed = {
          title: element.title,
          description: element.content + `\nVersion: ${element.version}`,
          color: 0x0099ff,
          author: {
            "name": element.user_id
          }
        };
        channel.send({embeds: [embed]})
      }

      interaction.reply("Re-updated!\nNew Events: " + events.length)
    }
 };