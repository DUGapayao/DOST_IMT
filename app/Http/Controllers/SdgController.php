<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use Illuminate\Http\Request;

class SdgController extends Controller
{
    public function index() {
        $allSdg = Sdg::all();
        return view('library.sdg.index', ['allSdg' => $allSdg]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'Title' => 'required',
            'Description' => 'required',
        ]);

        Sdg::create($data);
        return redirect()->route('sdg.index');
    }

    public function update(Sdg $sdg, Request $request) {
        $data = $request->validate([
            'Title' => 'required',
            'Description' => 'required',
        ]);

        $sdg->update($data);
        return redirect()->route('sdg.index');
    }

    public function destroy(Sdg $sdg) {
        $sdg->delete();
        return redirect()->route('sdg.index');
    }
}
