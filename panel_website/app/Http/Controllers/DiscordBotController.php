<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscordBotController extends Controller
{
    private $connected = false;
    public function connect(Request $request) {
        if(!isset($request->bot_token)) {
            return response()->json("Set the bot token in params", 404);
        }
        if(empty(env("BOT_TOKEN"))) {
            return response()->json("First, set in .env panel BOT_TOKEN property", 404);
        }
        if($request->bot_token != env("BOT_TOKEN")) {
            return response()->json("Invalid Bot Token", 404);
        }
        return response()->json("Succesfuly connect - BOT_TOKEN: " . str_pad($request->bot_token, 10));
    }
    public function on_events() {
        if(!$this->connected) {
            return response()->json("Connect first!", 404);
        }
    }
}
