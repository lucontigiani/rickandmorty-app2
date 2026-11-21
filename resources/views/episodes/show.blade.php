<x-layouts.explorer :title="$episode->name">
    <a href="{{ route('episodes.index') }}" class="text-sm text-gray-600 hover:underline">← Volver a episodios</a>

    <div class="bg-white rounded shadow mt-3 p-6">
        <h1 class="text-2xl font-bold">{{ $episode->name }}</h1>
        <dl class="mt-3 grid grid-cols-[auto_1fr] gap-x-4 gap-y-1">
            <dt class="text-gray-600">Código</dt>
            <dd>{{ $episode->code }}</dd>

            <dt class="text-gray-600">Temporada</dt>
            <dd>{{ $episode->season }}</dd>

            <dt class="text-gray-600">Episodio</dt>
            <dd>{{ $episode->episode_number }}</dd>

            <dt class="text-gray-600">Fecha de emisión</dt>
            <dd>{{ $episode->air_date?->format('d/m/Y') ?? $episode->air_date_raw }}</dd>
        </dl>
    </div>

    <h2 class="text-xl font-bold mt-8 mb-3">Personajes ({{ $episode->characters->count() }})</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($episode->characters as $character)
            <div class="bg-white rounded shadow overflow-hidden flex">
                <img src="{{ $character->image }}" alt="{{ $character->name }}"
                     class="w-20 h-20 object-cover shrink-0" loading="lazy">
                <div class="p-3">
                    <a href="{{ route('characters.show', $character) }}" class="font-semibold hover:underline">
                        {{ $character->name }}
                    </a>
                    <p class="text-sm text-gray-600">{{ $character->species }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-full text-gray-600">Sin personajes registrados.</p>
        @endforelse
    </div>
</x-layouts.explorer>