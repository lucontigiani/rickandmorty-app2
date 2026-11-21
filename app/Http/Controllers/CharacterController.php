<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(Request $request) //entrega los datos de la petición (lo que llega por la URL, como ?name=rick)
    {
        $characters = Character::query()
            ->when($request->filled('name'), fn ($q) => $q->where('name', 'like', '%'.$request->name.'%')) //si el request tiene un parámetro 'name', filtra los personajes cuyo nombre contenga ese valor
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status)) //si el request tiene un parámetro 'status', filtra los personajes cuyo estado sea ese valor
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString(); //mantiene los parámetros de la URL en la paginación, para que al cambiar de página no se pierdan los filtros aplicados

        return view('characters.index', compact('characters'));
    }
    public function show(Character $character)
    {
    $character->load(['origin', 'location', 'episodes' => fn ($q) => $q->orderBy('season')->orderBy('episode_number')]);

        return view('characters.show', compact('character'));
    }

    }