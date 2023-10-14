<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allWikis = Wiki::all();
        $orderRanks = array();

        foreach ($allWikis as $wiki) {
            $rankName = $wiki->section;

            if (!isset($orderRanks[$rankName])) {
                $orderRanks[$rankName] = array();
            }

            $orderRanks[$rankName][] = [
                "id" => $wiki->id,
                "button_name" => $wiki->button_name
            ];
        }
        return view("wiki", [
            "wikis" => $orderRanks,
            "nr" => count(Wiki::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\Response
     */
    public function show($button_name ,Wiki $wiki)
    {
        // ORDER BUTTONS
        $allWikis = Wiki::all();
        $orderRanks = array();

        foreach ($allWikis as $wiki) {
            $rankName = $wiki->section;

            if (!isset($orderRanks[$rankName])) {
                $orderRanks[$rankName] = array();
            }

            $orderRanks[$rankName][] = [
                "id" => $wiki->id,
                "button_name" => $wiki->button_name
            ];
        }
        // ORDER BUTTONS

        $infoAboutWiki = Wiki::where("button_name", $button_name)->first();
        if(!$infoAboutWiki) {
            return redirect()->route("wiki");
        } else {
            return view("wiki", [
                "categoryWIKI" => [
                    "title" => $infoAboutWiki->title,
                    "content" => $infoAboutWiki->content,
                    "image_path" => $infoAboutWiki->image_path
                ],
                "wikis" => $orderRanks,
                "nr" => count($allWikis)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\Response
     */
    public function edit(Wiki $wiki)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wiki $wiki)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wiki $wiki)
    {
        //
    }
}
