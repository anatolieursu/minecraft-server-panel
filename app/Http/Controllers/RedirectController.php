<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\event;
use App\Models\Forum;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RedirectController extends Controller
{
    public function index() {
        $allData = Http::get("https://api.mcsrvstat.us/3/" . env("MINECRAFT_SERVER_IP"));
        if(!$allData["debug"]["ping"]) {
            $players = 0;
        } else {
            $players = $allData["players"]["online"];
        }
        return view("welcome", [
            "players" => $players,
            "events" => event::orderBy("id", "desc")->get()
        ]);
    }
    public function profile() {
        if(Auth::user()) {
            $allForums = Forum::where("user_id", Auth::user()->id)->orderBy("id", "desc")->get();
            $allStaffApplications = Apply::where("user_id", Auth::user()->id)->get();
            
            return view("profile", [
                "forums" => $allForums,
                "applys" => $allStaffApplications,
                "nrOfEvents" => count(event::where("user_id", Auth::user()->id)->get())
            ]);
        } else {
            return view("profile");
        }
    }


    public function logout() {
        Auth::logout();
        return redirect()->route("welcome");
    }

    public function personal() {
        $allStaff = Staff::all();
        $orderRanks = array();

        foreach ($allStaff as $staff) {
            $rankName = $staff->rank;

            if (!isset($orderRanks[$rankName])) {
                $orderRanks[$rankName] = array();
            }

            $orderRanks[$rankName][] = $staff->name;
        }

        return view("personal", [
            "staff" => $orderRanks,
            "nr" => count(Staff::all())
        ]);
    }
    public function redirectToApplyInStaff() {
        return view("apply_staff");
    }
    public function viewProfile($username) {
        $userInfo = User::where("username", $username)->first();
        if(!$userInfo) {
            throw new NotFoundHttpException;
        } else {
            if($userInfo->public || Auth::user()->admin) {
                $user_id = User::where("username", $username)->first()->id;
                $allForums = Forum::where("user_id", $user_id)->orderBy("id", "desc")->get();
                $allStaffApplications = Apply::where("user_id", $user_id)->get();
                
                return view("profile_view", [
                    "info" => $userInfo,
                    "forums" => $allForums,
                    "applys" => $allStaffApplications,
                    "nrOfEvents" => count(event::where("user_id", $user_id)->get())
                ]);
            } else {
                return redirect()->route("welcome");
            }
        }
    }

    public function redirectToAdmin() {
        if(Auth::user()->admin) {
            return view("admin", [
                "events" => event::all(),
                "qas" => Forum::all(),
                "applys" => Apply::where("status", "checking")->get(),
                "nr" => count(Forum::all()) + count(event::all()) + count(Apply::all())
            ]);
        } else {
            throw new NotFoundHttpException;
        }
    }
}
