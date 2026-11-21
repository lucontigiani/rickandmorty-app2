<x-layouts.explorer title="Episodios">
    <h1 class="text-2xl font-bold mb-4">Episodios</h1>

    <form method="GET" action="{{ route('episodes.index') }}" class="flex gap-2 mb-6">
        <input type="text" name="name" value="{{ request('name') }}"
               placeholder="Buscar por nombre" class="border rounded px-3 py-2 flex-1">
        <select name="season" class="border rounded px-3 py-2">
            <option value="">Todas las temporadas</option>
            @foreach ($seasons as $season)
                <option value="{{ $season }}" @selected((string) request('season') === (string) $season)>
                    Temporada {{ $season }}
                </option>
            @endforeach
        </select>
        <button class="bg-gray-900 text-white rounded px-4 py-2">Filtrar</button>
    </form>

    <ul class="bg-white rounded shadow divide-y">
        @forelse ($episodes as $episode)
            <li class="px-4 py-3 flex justify-between items-center">
                <div>
                    <span class="text-gray-600">{{ $episode->code }}</span>
                    <a href="{{ route('episodes.show', $episode) }}" class="font-semibold hover:underline">
                        {{ $episode->name }}
                    </a>
                </div>
                <span class="text-sm text-gray-600">{{ $episode->air_date?->format('d/m/Y') }}</span>
            </li>
        @empty
            <li class="px-4 py-3 text-gray-600">No se encontraron episodios.</li>
        @endforelse
    </ul>

    <div class="mt-6">
        {{ $episodes->links() }}
    </div>
</x-layouts.explorer>