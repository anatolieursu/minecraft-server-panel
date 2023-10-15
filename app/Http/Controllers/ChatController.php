<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("live-chat");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = $request->input("author");
        $message = $request->input("message");

        Chat::create([
            'message' => $message,
            'author' => $author
        ]);
    }

    public function load(Request $request) {
        $start = $request->get('start');

        return response()->json(Chat::where("id", ">", $start)->get());
    }
    public function destroy() {
        if(Auth::user()) {
            if(Auth::user()->admin) {
                Chat::truncate();
                return redirect()->back();
            }
        }
        throw new NotFoundHttpException();
    }

    public function download_log() {
        $txt = "";
        foreach (Chat::all() as $chat) {
            $row = $chat->message . " | Author: " . $chat->author . " | " . $chat->created_at . "\n";
            $txt .= $row;
        }

        Storage::disk("local")->put('chat_log.txt', $txt);
        $file_path = Storage::disk('local')->path('chat_log.txt');
        return response()->download($file_path, 'chat_log.txt')->deleteFileAfterSend(true);
    }
    
}
