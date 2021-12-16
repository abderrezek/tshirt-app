<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarquePostRequest;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MarqueController extends Controller
{
    public function index(Request $request)
    {
        $marques = Marque::when($request->q, function ($query, $q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
        })->orderBy('created_at', 'desc')->paginate(10);
        // $marques = DB::table('marques')->orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('Marques/Index', [
            'marques' => $marques,
            'q' => $request->q,
        ]);
    }

    public function store(MarquePostRequest $request)
    {
        $validated = $request->validated();

        Marque::create($validated);

        if ($validated['create']) {
            // $marques = Marque::all('name');
            return redirect()->route('admin.clothes.create');
        }
        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Ajouter avec succès');
        return redirect()->route('admin.marques.index');
    }

    public function destroy(Request $request, Marque $marque)
    {
        if (is_null($marque)) {
            return redirect()->route('admin.marques.index');
        }
        $marque->delete();

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Supprimé avec succès');

        return redirect()->route('admin.marques.index');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:marques,id',
            'name' => 'required|string|min:3|max:50|unique:marques,name,' . $request->input('id'),
        ]);
        $marque = Marque::find($validated['id']);
        $marque->name = $validated['name'];
        $marque->save();

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Modifier avec succès');
        return redirect()->route('admin.marques.index');
    }
}
