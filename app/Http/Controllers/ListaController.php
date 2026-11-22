<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListaController extends Controller
{
    public function index(Request $request)
    {
        $listas = $request->user()->listas() //parte siempre de las listas del usuario con sesión
            ->withCount(['characters', 'episodes'])
            ->orderBy('name')
            ->get();

        return view('listas.index', compact('listas'));
    }

    public function create()
    {
        return view('listas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('listas')->where('user_id', $request->user()->id),//valida que el nombre sea único para el usuario con sesión
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', Rule::in(['character', 'episode'])],
        ]);

        $request->user()->listas()->create($data);//completa user_id automáticamente a través de la relación. Por eso user_id no está en $fillable

        return redirect()->route('listas.index')->with('success', 'Lista creada.');
    }

    public function show(Request $request, int $lista)
{
    $lista = $request->user()->listas()->findOrFail($lista);

    $items = $lista->type === 'character'
        ? $lista->characters()->orderBy('name')->paginate(20)
        : $lista->episodes()->orderBy('season')->orderBy('episode_number')->paginate(20);

    return view('listas.show', compact('lista', 'items'));
}

public function addItem(Request $request, int $lista)
{
    $lista = $request->user()->listas()->findOrFail($lista);

    $data = $request->validate([
        'item_id' => ['required', 'integer'],
    ]);

    $relation = $lista->type === 'character' ? $lista->characters() : $lista->episodes(); //determina la relación según el tipo de lista
    $model = $lista->type === 'character' ? \App\Models\Character::class : \App\Models\Episode::class;

    $model::findOrFail($data['item_id']);

    $relation->syncWithoutDetaching([$data['item_id']]);//agrega el item a la lista sin eliminar los existentes

    return back()->with('success', 'Agregado a "'.$lista->name.'".');
}

public function removeItem(Request $request, int $lista, int $item)
{
    $lista = $request->user()->listas()->findOrFail($lista);

    $relation = $lista->type === 'character' ? $lista->characters() : $lista->episodes();
    $relation->detach($item);

    return back()->with('success', 'Quitado de "'.$lista->name.'".');
}

    public function destroy(Request $request, int $lista)
    {
        $request->user()->listas()->findOrFail($lista)->delete(); //busca la lista del usuario con sesión y la elimina. Si no existe, lanza un 404.

        return redirect()->route('listas.index')->with('success', 'Lista eliminada.');
    }
}