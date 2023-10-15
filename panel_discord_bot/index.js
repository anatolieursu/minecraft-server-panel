const config = require("./config");
const panel = require("./panel_sdk");
const { Client, Collection, Events, GatewayIntentBits, Partials } = require("discord.js");
const client = new Client({
    intents: [GatewayIntentBits.AutoModerationConfiguration, GatewayIntentBits.AutoModerationExecution, GatewayIntentBits.DirectMessageReactions, GatewayIntentBits.DirectMessageTyping, GatewayIntentBits.DirectMessages, GatewayIntentBits.GuildEmojisAndStickers, GatewayIntentBits.GuildIntegrations, GatewayIntentBits.GuildInvites, GatewayIntentBits.GuildMembers, GatewayIntentBits.GuildMessageReactions, GatewayIntentBits.GuildMessageTyping, GatewayIntentBits.GuildMessages, GatewayIntentBits.GuildModeration, GatewayIntentBits.GuildPresences, GatewayIntentBits.GuildScheduledEvents, GatewayIntentBits.GuildVoiceStates, GatewayIntentBits.GuildWebhooks, GatewayIntentBits.Guilds, GatewayIntentBits.MessageContent],
    partials: [Partials.Message, Partials.Channel, Partials.GuildMember, Partials.Reaction, Partials.GuildScheduledEvent, Partials.User, Partials.ThreadMember],
    shards: "auto"
  });
const { readdirSync } = require("node:fs");

client.commandaliases = new Collection();
client.commands = new Collection();
client.slashcommands = new Collection();
client.slashdatas = [];

// Slash command handler
const slashcommands = [];
readdirSync("./src/commands/slash").forEach(async (file) => {
  const command = await require(`./src/commands/slash/${file}`);
  client.slashdatas.push(command.data.toJSON());
  client.slashcommands.set(command.data.name, command);
});

// Event handler
readdirSync("./src/events").forEach(async (file) => {
  const event = await require(`./src/events/${file}`);
  if (event.once) {
    client.once(event.name, (...args) => event.execute(...args));
  } else {
    client.on(event.name, (...args) => event.execute(...args));
  }
});

// Process listeners
process.on("unhandledRejection", (e) => {
    console.log(e);
});
process.on("uncaughtException", (e) => {
    console.log(e);
});
process.on("uncaughtExceptionMonitor", (e) => {
    console.log(e);
});

client.login(config.bot_token);