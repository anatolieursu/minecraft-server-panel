<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumCreateRequest;
use App\Jobs\SendDiscordMessage;
use App\Models\Forum;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allForums = Forum::orderBy("id", "desc")->paginate(15);
        return view("forum", [
            "qas" => $allForums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ForumCreateRequest $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumCreateRequest $request)
    {
        Forum::create([
            "title" => $request->title,
            "description" => $request->description,
            "urgency" => $request->urgency,
            "user_id" => Auth::user()->id,
            "username" => Auth::user()->username,
            "avatar" => Auth::user()->avatar
        ]);
        SendDiscordMessage::dispatch("forums", $request->title);
        return redirect()->back();
    }
    public function load(Request $request) {
        $start = $request->get('start');
        $forumId = $request->get('forum');
        return response()->json(Message::where("id", '>', $start)->where("forum_id", $forumId)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $id, Forum $forum)
    {
        $qa = $forum::where("user_id", $user_id)->where("id", $id)->first();
        if(!$qa) {
            throw new NotFoundHttpException;
        } else {
            $acces = false;
            if(Auth::user()) {
                if($qa->user_id == Auth::user()->id || Auth::user()->staff || Auth::user()->admin) {
                    $acces = true;
                }
            }
            return view("forum_card", [
                "qa" => $qa,
                "acces" => $acces,
                "forum_id" => $id,
                "messages" => Message::where("forum_id", $id)->get()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Forum $forum)
    {
        $dataAboutForum = $forum::where("id", $id)->first();
        if(!$dataAboutForum) {
            throw new NotFoundHttpException;
        } else {
            if($dataAboutForum->user_id == Auth::user()->id || Auth::user()->admin) {
                $forum::where("id", $id)->delete();
                Message::where("forum_id", $id)->delete();
                return redirect()->back();
            } else {
                throw new NotFoundHttpException;
            }
        }
    }
}
