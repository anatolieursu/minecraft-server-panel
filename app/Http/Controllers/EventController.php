<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {   
        if(Auth::user()->staff || Auth::user()->admin) {
            $lastOne = event::orderBy("id", "desc")->first();
            if(!$lastOne) {
                $version = 0.1;
            } else {
                $version = $lastOne->version + 0.1;
            }
            event::create([
                "user_id" => Auth::user()->id,
                "title" => $request->title,
                "content" => $request->content,
                "image_path" => $this->storageImage($request),
                "version" => $version
            ]);
            return redirect()->route("welcome");
        } else {
            return redirect()->route("welcome");
        }
    }
    private function storageImage($request) {
        $fileName = $request->file . '-' . uniqid() . '.' . $request->file("file")->extension();
        return $request->file->move(public_path("event_images"), $fileName);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $id, event $event)
    {
        $infoAboutEvent = $event->where("id", $id)->first();
        if(!$infoAboutEvent) {
            throw new NotFoundHttpException;
        } else {
            return view("event_view", [
                "data" => $infoAboutEvent
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, event $event)
    {
        $user_id = Auth::user()->id;
        $theEvent = $event->where("id", $id)->first();
        if($theEvent) {
            if($user_id == $theEvent->user_id || Auth::user()->admin) {
                $theEvent->delete();
                return redirect()->back();
            } else {
                throw new NotFoundHttpException;
            }
        } else {
            throw new NotFoundHttpException;
        }
    }
}
