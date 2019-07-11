<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArchiveItem;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archiveItems = ArchiveItem::all();
        return view('archive.index')->with('archive', $archiveItems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('archive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $validatedData = $request->validate([
            'id' => 'required|unique:archive|numeric',
            'most_points_score' => 'numeric',
            'highest_week_score' => 'numeric'
        ]);

        // Create new archive item
        $archiveItem = new ArchiveItem;

        // create documents

        $archiveItem->id = $request->input('id');
        $archiveItem->league_champ_team = $request->input('league_champ_team');
        $archiveItem->most_points_team = $request->input('most_points_team');
        $archiveItem->most_points_score = $request->input('most_points_score');
        $archiveItem->highest_week_team = $request->input('highest_week_team');
        $archiveItem->highest_week_score = $request->input('highest_week_score');
        $archiveItem->save();
        return redirect('/archive')->with('success', 'Archive Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $archiveItem = ArchiveItem::find($id);
        return view('archive.show')->with('archiveItem',$archiveItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archiveItem = ArchiveItem::find($id);
        return view('archive.edit')->with('archiveItem',$archiveItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate data
        $validatedData = $request->validate([
            'most_points_score' => 'numeric',
            'highest_week_score' => 'numeric'
        ]);

        $archiveItem = ArchiveItem::find($id);

        // update documents

        $archiveItem->league_champ_team = $request->input('league_champ_team');
        $archiveItem->most_points_team = $request->input('most_points_team');
        $archiveItem->most_points_score = $request->input('most_points_score');
        $archiveItem->highest_week_team = $request->input('highest_week_team');
        $archiveItem->highest_week_score = $request->input('highest_week_score');
        $archiveItem->save();
        return redirect('/archive')->with('success', 'Archive Updated');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete post
        $archiveItem = ArchiveItem::find($id);

        // delete documents
        
        $archiveItem->delete();
        return redirect('/archive')->with('success', 'Archive Year Deleted');
    }
}
