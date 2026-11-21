<x-layouts.explorer :title="$character->name"> 
    <a href="{{ route('characters.index') }}" class="text-sm text-gray-600 hover:underline">← Volver a personajes</a>

    <div class="bg-white rounded shadow mt-3 p-6 flex flex-col md:flex-row gap-6">
        <img src="{{ $character->image }}" alt="{{ $character->name }}" class="w-48 h-48 object-cover rounded shrink-0">

        <div>
            <h1 class="text-2xl font-bold">{{ $character->name }}</h1>
            <dl class="mt-3 grid grid-cols-[auto_1fr] gap-x-4 gap-y-1">
                <dt class="text-gray-600">Estado</dt>
                <dd>{{ $character->status }}</dd>

                <dt class="text-gray-600">Especie</dt>
                <dd>{{ $character->species }}</dd>

                @if ($character->type)
                    <dt class="text-gray-600">Tipo</dt>
                    <dd>{{ $character->type }}</dd>
                @endif

                <dt class="text-gray-600">Género</dt>
                <dd>{{ $character->gender }}</dd>

                <dt class="text-gray-600">Origen</dt>
                <dd>
                    @if ($character->origin)
                        {{ $character->origin->name }}
                    @else
                        Desconocido
                    @endif
                </dd>

                <dt class="text-gray-600">Ubicación actual</dt>
                <dd>
                    @if ($character->location)
                        {{ $character->location->name }}
                    @else
                        Desconocida
                    @endif
                </dd>
            </dl>
        </div>
    </div>

    <h2 class="text-xl font-bold mt-8 mb-3">Episodios ({{ $character->episodes->count() }})</h2>
    <ul class="bg-white rounded shadow divide-y">
        @forelse ($character->episodes as $episode)
         <li class="px-4 py-2">
    <span class="text-gray-600">{{ $episode->code }}</span>
    <a href="{{ route('episodes.show', $episode) }}" class="hover:underline">{{ $episode->name }}</a>
</li>
        @empty
            <li class="px-4 py-2 text-gray-600">Sin episodios registrados.</li>
        @endforelse
    </ul>
</x-layouts.explorer>