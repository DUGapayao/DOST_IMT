<?php

namespace App\Http\Controllers;

use App\Models\Hnrda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HnrdaController extends Controller
{
    public function index() {
        $allHnrda = Hnrda::all() ;
        return view('library.hnrda.index', ['allHnrda' => $allHnrda]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required'
        ]);

        Hnrda::create($data);
        return redirect()->route('hnrda.index');
    }

    public function update(Hnrda $hnrda, Request $request){
        $data = $request->validate([
            'title' => 'required'
        ]);

        $hnrda->update($data);

        return redirect(route('hnrda.index'));
    }

    public function destroy(Hnrda $hnrda){
        $hnrda->delete();
        return redirect()->route('hnrda.index');
    }
}
