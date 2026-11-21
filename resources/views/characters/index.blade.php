<x-layouts.explorer title="Personajes">
    <h1 class="text-2xl font-bold mb-4">Personajes</h1>

    <form method="GET" action="{{ route('characters.index') }}" class="flex gap-2 mb-6">
        <input type="text" name="name" value="{{ request('name') }}"
               placeholder="Buscar por nombre" class="border rounded px-3 py-2 flex-1">
        <select name="status" class="border rounded px-3 py-2">
            <option value="">Todos los estados</option>
            @foreach (['Alive' => 'Vivo', 'Dead' => 'Muerto', 'unknown' => 'Desconocido'] as $value => $label)
                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="bg-gray-900 text-white rounded px-4 py-2">Filtrar</button>
    </form>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($characters as $character)
        <div class="bg-white rounded shadow overflow-hidden flex">
            <img src="{{ $character->image }}" alt="{{ $character->name }}"
                 class="w-32 h-32 object-cover shrink-0" loading="lazy">
            <div class="p-3">
                <a href="{{ route('characters.show', $character) }}" class="font-semibold hover:underline">
    {{ $character->name }}
</a>
                <p class="text-sm text-gray-600">{{ $character->species }} · {{ $character->status }}</p>
            </div>
        </div>
    @empty
        <p class="col-span-full text-gray-600">No se encontraron personajes.</p>
    @endforelse
</div>

    <div class="mt-6">
        {{ $characters->links() }}
    </div>
</x-layouts.explorer>