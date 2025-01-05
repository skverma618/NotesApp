<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notes = Note::orderBy("created_at","desc")
        // ->where("user_id", auth()->user()->id)
        // ->where("user_id", request()->user()->id)
        ->where("user_id", $request->user()->id)
        ->paginate(12);
        return view("note.index", ["notes" => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'note' => ['required', 'string']
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $note = Note::create($validatedData);

        return to_route('note.show', $note->id)->with('message','Note was Created!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if(auth()->user()->id != $note->user_id) {
            // return to_route('note.index')->with('message','Not allowzed to visit the page');
            abort(code: '403');
        }
        return view("note.show", ["note"=> $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view("note.edit", ["note" => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validatedData = $request->validate([
            'note' => ['required', 'string']
        ]);

        $note->update($validatedData);
        return to_route('note.edit', $note->id)->with('message','Note Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
