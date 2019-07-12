<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArchiveItem;
use App\Document;

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
            'id' => 'required|unique:archive|integer',
            'most_points_score' => 'numeric|sometimes|nullable',
            'highest_week_score' => 'numeric|sometimes|nullable'
        ]);

        $archiveId = $request->input('id');

        // Create new archive item
        $archiveItem = new ArchiveItem;
        $archiveItem->id = $archiveId;
        $archiveItem->league_champ_team = $request->input('league_champ_team');
        $archiveItem->most_points_team = $request->input('most_points_team');
        $archiveItem->most_points_score = $request->input('most_points_score');
        $archiveItem->highest_week_team = $request->input('highest_week_team');
        $archiveItem->highest_week_score = $request->input('highest_week_score');
        $archiveItem->save();

        // retrieve the saved archive item object
        $archiveItemSaved = ArchiveItem::find($archiveId);

        if($request->file('documents')) {
            $documentObjects = [];
            // file upload
            $allowedfileExtension=['pdf','jpg','png','gif','doc','docx'];
            $files = $request->file('documents');
            foreach($files as $file) {
                $fileNameWithExt = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $fileName."_".time().'.'.$extension;
                if(in_array($extension,$allowedfileExtension)) {
                    // upload
                    $path = $file->storeAs('public/documents', $fileNameToStore);
                    // create a new document object in array
                    $documentObjects[] = new Document([
                        'file_name' => $fileNameToStore,
                        'description' => ''
                    ]);
                }
            }
            // save all the created document objects
            if(count($documentObjects>0)) {
                $archiveItemSaved->documents()->saveMany($documentObjects);
            }
            // if uploaded files, redirect to the edit form
            return redirect('archive/'.$archiveId.'/edit')->with('success', 'Files Uploaded');
        } else {
            // if no uploaded files, redirect to archive index
            return redirect('/archive')->with('success', 'Archive Created');
        }
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
            'most_points_score' => 'numeric|sometimes|nullable',
            'highest_week_score' => 'numeric|sometimes|nullable'
        ]);

        // update the ArchiveItem
        $archiveItem = ArchiveItem::find($id);
        $archiveItem->league_champ_team = $request->input('league_champ_team');
        $archiveItem->most_points_team = $request->input('most_points_team');
        $archiveItem->most_points_score = $request->input('most_points_score');
        $archiveItem->highest_week_team = $request->input('highest_week_team');
        $archiveItem->highest_week_score = $request->input('highest_week_score');
        $archiveItem->save();

        // update file descriptions
        $documentNames = $request->get('documentNames');
        if($documentNames) {
            foreach($documentNames as $key => $value) {
                $document = Document::find($key);
                $document->description = $value;
                $document->save();
            }
        }

        // upload new files
        if($request->file('documents')) {
            $documentObjects = [];
            // file upload
            $allowedfileExtension=['pdf','jpg','png','gif','doc','docx'];
            $files = $request->file('documents');
            foreach($files as $file) {
                $fileNameWithExt = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $fileName."_".time().'.'.$extension;
                if(in_array($extension,$allowedfileExtension)) {
                    // upload
                    $path = $file->storeAs('public/documents', $fileNameToStore);
                    // create a new document object in array
                    $documentObjects[] = new Document([
                        'file_name' => $fileNameToStore,
                        'description' => ''
                    ]);
                }
            }
            // save all the created document objects
            if($documentObjects) {
                $archiveItem->documents()->saveMany($documentObjects);
            }
            // if uploaded files, redirect to the edit form
            return redirect('archive/'.$id.'/edit')->with('success', 'Files Uploaded');
        } else {
            // if no uploaded files, redirect to archive index
            return redirect('/archive')->with('success', 'Archive Created');
        }     
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
