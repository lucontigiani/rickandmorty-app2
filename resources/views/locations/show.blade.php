<x-layouts.explorer :title="$location->name">
    <a href="{{ route('locations.index') }}" class="text-sm text-gray-600 hover:underline">← Volver a ubicaciones</a>

    <div class="bg-white rounded shadow mt-3 p-6">
        <h1 class="text-2xl font-bold">{{ $location->name }}</h1>
        <dl class="mt-3 grid grid-cols-[auto_1fr] gap-x-4 gap-y-1">
            <dt class="text-gray-600">Tipo</dt>
            <dd>{{ $location->type ?: 'Desconocido' }}</dd>

            <dt class="text-gray-600">Dimensión</dt>
            <dd>{{ $location->dimension ?: 'Desconocida' }}</dd>
        </dl>
    </div>

    @foreach ([
        'Residentes' => $location->residents,
        'Personajes que nacieron aquí' => $location->natives,
    ] as $title => $characters)
        <h2 class="text-xl font-bold mt-8 mb-3">{{ $title }} ({{ $characters->count() }})</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($characters as $character)
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
                <p class="col-span-full text-gray-600">Ninguno registrado.</p>
            @endforelse
        </div>
    @endforeach
</x-layouts.explorer>