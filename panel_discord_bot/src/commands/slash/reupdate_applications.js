const { EmbedBuilder, PermissionsBitField, Embed } = require("discord.js");
const { SlashCommandBuilder } = require("@discordjs/builders");
const EventObject = require("../../controllers/EventObject");
const ApplicationObject = require("../../controllers/ApplicationObject");
module.exports = {
  data: new SlashCommandBuilder()
    .setName("new_applications")
    .setDescription("Find the new staff applications"),
    run: async (client, interaction) => {
      const data = new ApplicationObject();
      await data.configureApplications();
      const applications = await data.applications;
      console.log(await applications)
      const channel = interaction.channel;

      for (let index = 0; index < applications.length; index++) {
        const element = applications[index];
        const embed = {
          title: element.username,
          description: element.reason + `\nAge: ${element.age}`,
          color: 0x0099ff,
          author: {
            "name": element.user_id
          }
        };
        channel.send({embeds: [embed]})
      }

      interaction.reply("Re-updated!\nNew Applications: " + applications.length)
    }
 };