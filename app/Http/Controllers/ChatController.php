<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

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
}
