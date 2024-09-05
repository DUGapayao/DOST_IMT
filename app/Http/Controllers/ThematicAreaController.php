<?php

namespace App\Http\Controllers;

use App\Models\ThematicArea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThematicAreaController extends Controller
{
    public function index() {
        $allThematicArea = ThematicArea::all() ;
        return view('library.thematic-area.index', ['allThematicArea' => $allThematicArea]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'Title' => 'required',
        ]);
        

        ThematicArea::create($data);
        return redirect()->route('thematic-area.index');
    }

    public function update(ThematicArea $thematicArea, Request $request) {
        $data = $request->validate([
            'Title' => 'required',
        ]);
    
        $thematicArea->update($data);
    
        return redirect(route('thematic-area.index'));
    }
    


    public function destroy(ThematicArea $thematicArea){
        $thematicArea->delete();
        return redirect()->route('thematic-area.index');
    }

}
