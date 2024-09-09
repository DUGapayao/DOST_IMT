<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index() {
        $allPriority = Priority::all() ;
        return view('library.priority.index', ['allPriority' => $allPriority]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required'
        ]);

        Priority::create($data);
        return redirect()->route('priority.index');
    }

    public function update(Priority $priority, Request $request){
        $data = $request->validate([
            'title' => 'required'
        ]);

        $priority->update($data);

        return redirect(route('priority.index'));
    }

    public function destroy(Priority $priority){
        $priority->delete();
        return redirect()->route('priority.index');
    }
}
