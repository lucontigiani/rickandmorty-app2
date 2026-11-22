<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $types = Location::query()->whereNotNull('type')->where('type', '!=', '')
            ->select('type')->distinct()->orderBy('type')->pluck('type');

        $locations = Location::query()
            ->withCount(['residents', 'natives']) //agrega a cada ubicación las columnas residents_count y natives_count con una sola consulta, para mostrar cuántos personajes tiene cada una sin cargarlos.
            ->when($request->filled('name'), fn ($q) => $q->where('name', 'like', '%'.$request->name.'%'))
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('locations.index', compact('locations', 'types'));
    }

    public function show(Location $location)
    {
        $location->load([
            'residents' => fn ($q) => $q->orderBy('name'),
            'natives' => fn ($q) => $q->orderBy('name'),
        ]);

        return view('locations.show', compact('location'));
    }
}