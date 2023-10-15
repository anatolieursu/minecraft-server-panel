<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\event;
use App\Models\Forum;
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
        $this->connected = true;
        return response()->json("Succesfuly connect - BOT_TOKEN: " . str_pad($request->bot_token, 10));
    }
    public function on_events(Request $request) {
        $unseen_events = event::where("seen", false)->get();
        $array_of_events = [];
        foreach($unseen_events as $key => $event) {
            $array_of_events[$key] = [
                "user_id" => $event->user_id,
                "title" => $event->title,
                "content" => $event->content,
                "version" => $event->version,
            ];
            $event->seen = true;
            $event->save();
        }
        return response()->json($array_of_events);
    }
    public function on_applications() {
        $unseen_applications = Apply::where("seen", false)->get();
        $array_of_applications = [];
        foreach($unseen_applications as $key => $application) {
            $array_of_applications[$key] = [
                "user_id" => $application->user_id,
                "reason" => $application->reason,
                "category" => $application->category,
                "username" => $application->username,
                "age" => $application->age
            ];
            $application->seen = true;
            $application->save();
        }

        return response()->json($array_of_applications);
    }
    public function on_forums() {
        $unseen_forum = Forum::where("seen", false)->get();
        $array_of_forum = [];
        foreach($unseen_forum as $key => $forum) {
            $array_of_forum[$key] = [
                "title" => $forum->title,
                "description" => $forum->description,
                "urgency" => $forum->urgency,
                "user_id" => $forum->user_id,
                "username" => $forum->username,
                "avatar" => $forum->avatar,
                "link" => env("APP_URL") . "/forum/view/{$forum->user_id}/{$forum->id}" 
            ];
            $forum->seen = true;
            $forum->save();
        }

        return response()->json($array_of_forum);
    }
}
