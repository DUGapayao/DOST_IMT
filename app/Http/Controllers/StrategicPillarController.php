<?php

namespace App\Http\Controllers;

use App\Models\StrategicPillar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrategicPillarController extends Controller
{
    public function index() {
        $allStrategicPillar = StrategicPillar::all() ;
        return view('library.strategic-pillar.index', ['allStrategicPillar' => $allStrategicPillar]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'Title' => 'required',
        ]);
        

        StrategicPillar::create($data);
        return redirect()->route('strategic-pillar.index');
    }

    public function update(StrategicPillar $strategicPillar, Request $request) {
        $data = $request->validate([
            'Title' => 'required',
        ]);
    
        $strategicPillar->update($data);
    
        return redirect(route('strategic-pillar.index'));
    }
    


    public function destroy(StrategicPillar $strategicPillar){
        $strategicPillar->delete();
        return redirect()->route('strategic-pillar.index');
    }

}
