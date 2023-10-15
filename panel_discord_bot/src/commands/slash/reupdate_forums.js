const { EmbedBuilder, PermissionsBitField, Embed } = require("discord.js");
const { SlashCommandBuilder } = require("@discordjs/builders");
const ForumObject = require("../../controllers/ForumObject");
const config = require("../../../config");
module.exports = {
  data: new SlashCommandBuilder()
    .setName("new_forums")
    .setDescription("Find the new forums"),
    run: async (client, interaction) => {
      const data = new ForumObject();
      await data.configureForums()
      const forums = await data.forums;

      const channel = interaction.channel;

      for (let index = 0; index < forums.length; index++) {
        const element = forums[index];
        const link = element.link;
        const embed = {
          title: element.title,
          description: element.description + `\nUrgency: ${element.urgency}\nLink: ${link}`,
          color: 0x0099ff,
          author: {
            "name": element.username,
            "image": element.avatar
          }
        };
        channel.send({embeds: [embed]})
      }

      interaction.reply("Re-updated!\nNew Forums: " + forums.length)
    }
 };