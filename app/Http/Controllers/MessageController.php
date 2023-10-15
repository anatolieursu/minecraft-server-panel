<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Forum;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MessageController extends Controller
{
    public function create($id, MessageRequest $request) {
        $dataAboutForum = Forum::where("id", $id)->first();
        if(!$dataAboutForum) {
            throw new NotFoundHttpException;
        }
        if(Auth::user()->staff || $dataAboutForum->user_id == Auth::user()->id || Auth::user()->admin) {
            Message::create([
                "user_id" => Auth::user()->id,
                "avatar" => Auth::user()->avatar,
                "username" => Auth::user()->username,
                "content" => $request->content,
                "forum_id" => $id,
                "reply_from_msg_id" => $request->replyFrom
            ]);
            return redirect()->back();
        } else {
            throw new NotFoundHttpException;
        }
    }
}
