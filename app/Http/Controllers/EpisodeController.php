<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Request $request)
    {
        $seasons = Episode::query()->select('season')->distinct()->orderBy('season')->pluck('season');

        $episodes = Episode::query()
            ->when($request->filled('name'), fn ($q) => $q->where('name', 'like', '%'.$request->name.'%'))
            ->when($request->filled('season'), fn ($q) => $q->where('season', $request->season))
            ->orderBy('season')
            ->orderBy('episode_number')
            ->paginate(20)
            ->withQueryString();

        return view('episodes.index', compact('episodes', 'seasons'));
    }

    public function show(Episode $episode)
    {
        $episode->load(['characters' => fn ($q) => $q->orderBy('name')]);

        return view('episodes.show', compact('episode'));
    }
}