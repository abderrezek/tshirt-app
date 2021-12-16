<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClothePostRequest;
use App\Jobs\ImageResize;
use App\Models\Clothe;
use App\Models\ClotheImage;
use App\Models\Marque;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ClotheController extends Controller
{
    public function index(Request $request)
    {
        $clothes = Clothe::when($request->q, function ($query, $q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('Clothes/Index', [
            'clothes' => $clothes,
            'q' => $request->q,
        ]);
    }

    public function create()
    {
        $marques = Marque::all(['name', 'id']);
        return Inertia::render('Clothes/Create', [
            'marques' => $marques,
        ]);
    }

    public function store(ClothePostRequest $request)
    {
        $validated = $request->validated();
        $validated['marque'] = (int)$validated['marque'];
        // dd($validated['size']);
        $createClothe = [
            'marque_id' => $validated['marque'],
            'name' => $validated['name'],
            'slug' => $validated['name'],
            'size' => $validated['size'],
            'qte' => $validated['qte'],
            'nb_added' => 0,
            'colors' => $validated['color'],
            'price' => $validated['price'],
            'is_sale' => $validated['isSolde'],
            // 'created_at' => now()->toDateTimeString(),
        ];
        if (isset($validated['solde'])) {
            $createClothe['sale'] = $validated['solde'];
        }
        if (!is_null($validated['description'])) {
            $createClothe['description'] = $validated['description'];
        }
        $clothe = Clothe::create($createClothe);

        if ($request->hasFile('image')) {
            $image = $validated['image'];
            $name = Str::lower(
                pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' .
                uniqid() . '.' .
                $image->getClientOriginalExtension()
            );
            $image->storeAs('public'.DIRECTORY_SEPARATOR.'clothes'.DIRECTORY_SEPARATOR.$clothe->id, $name);

            $clothe->images()->create([
                'image' => $name,
            ]);
            ImageResize::dispatch($clothe->id, $name);
        }

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Ajouter avec succès');

        return redirect()->route('admin.clothes.index')->with('success', 'Enregistré avec succès');
    }

    public function edit(Clothe $clothe)
    {
        $clothe_data = [
            'id' => $clothe->id,
            'name' => $clothe->name,
            'size' => $clothe->size,
            'qte' => $clothe->qte,
            'colors' => $clothe->colors,
            'price' => $clothe->price,
            'is_sale' => $clothe->is_sale,
            'sale' => $clothe->sale,
            'description' => $clothe->description,

            // 'marque' => $clothe->marque->name,
            'marque' => $clothe->marque_id,

            'image' => $clothe->images,
        ];
        $marques = Marque::all(['name', 'id']);
        return Inertia::render('Clothes/Edit', [
            'marques' => $marques,
            'clothe' => $clothe_data,
        ]);
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

    public function destroy(Request $request, Clothe $clothe)
    {
        if (is_null($clothe)) {
            return redirect()->route('admin.clothes.index');
        }
        $clothe->delete();

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Supprimé avec succès');

        return redirect()->route('admin.clothes.index');
    }
}
