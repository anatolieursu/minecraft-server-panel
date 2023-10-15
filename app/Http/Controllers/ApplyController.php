<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffApply;
use App\Jobs\SendDiscordMessage;
use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApplyController extends Controller
{
    public function staffApply(StaffApply $request) {
        Apply::create([
            "user_id" => Auth::user()->id,
            "reason" => $request->reason,
            "age" => $request->age,
            "username" => Auth::user()->username
        ]);
        SendDiscordMessage::dispatch("applications", Auth::user()->username);
        return redirect()->route("welcome");
    }
    public function upgradeStatus($id, Request $request) {
        $request->validate([
            "status" => "required"
        ]);
        if(Auth::user()->admin) {
            $apply = Apply::where("id", $id)->first();
            if(!$apply) {
                throw new NotFoundHttpException;
            } else {
                $apply->status = $request->status;
                $apply->save();
                return redirect()->back();
            }
        } else {
            throw new NotFoundHttpException;
        }
    }
    public function delete($apply_id) {
        if(!Auth::user() || !Auth::user()->admin) {
            throw new NotFoundHttpException();
        }
        $apply = Apply::where("id", $apply_id)->first();
        if(!$apply) {
            throw new NotFoundHttpException();
        }
        $apply->delete();
        return redirect()->back();
    }
}
