<?php

namespace App\Http\Controllers;

use App\Models\Hnrda;

use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HnrdaController extends Controller
{
    public $formFields = [
        'title' => ['id' => 'title', 'type' => 'text', 'label' => 'Title'],
    ];

    public function index() {
        $hnrdas = Hnrda::all();
        return view('hnrdas', ['hnrdas' => $hnrdas, 'formFields' => $this->formFields]);
    }

    public function store(Request $request): RedirectResponse
    {
        Hnrda::create([
            'title' => $request->title,
        ]);

        return redirect(route('hnrdas.index'));
    }

    public function update($hnrdaID, Request $request): RedirectResponse
    {
        $hnrda = Hnrda::findOrFail($hnrdaID);
        $hnrda->update([
            'title' => $request->title,
        ]);

        return redirect(route('hnrdas.index'));
    }

    public function destroy($hnrdaID)
    {
        $hnrda = Hnrda::findOrFail($hnrdaID);
        $hnrda->delete();

        return redirect(route('hnrdas.index'));
    }
}
