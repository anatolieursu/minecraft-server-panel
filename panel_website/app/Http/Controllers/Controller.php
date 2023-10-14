<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutMeSet;
use App\Models\event;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setAboutMe(AboutMeSet $request) {
        $user = User::where("id", Auth::user()->id)->first();
        if($user) {
            $user->about = $request->aboutMe;
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->route("welcome");
        }
    }
    public function privateProfile() {
        if($this->makePublic(false)) {
            return redirect()->back();
        } else {
            throw new NotFoundHttpException;
        }
    }
    public function publicProfile() {
        if($this->makePublic(true)) {
            return redirect()->back();
        } else {
            throw new NotFoundHttpException;
        }
    }

    private function makePublic($status) {
        $user = User::where("id", Auth::user()->id)->first();
        if($user) {
            $user->public = $status;
            $user->save();
            return true;
        } else {
            return false;
        }
    }

    public function search(Request $request) {
        $request->validate([
            "content" => "required"
        ]);
        $content = $request->content;

        $firstEvent = event::where("title", "LIKE", "%" . $content . "%")
            ->first();

        $red = "none";
        $first_id = "";
        if($firstEvent) {
            $red = $firstEvent->title;
            $first_id = $firstEvent->id;
        }
        $allContains = event::where("title", "LIKE", "%" . $content . "%")
            ->orWhere("content", "LIKE", "%" . $content . "%")
            ->get();
        $justIds = array();
        foreach($allContains as $container) {
            $justIds[] = $container->id;
        }

        session()->put("allContains", $justIds);

        return redirect()->route("welcome", [
            "search" => $content,
            "id" => $first_id,
            "#" . $red
        ]);
    }
}
