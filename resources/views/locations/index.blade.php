<x-layouts.explorer title="Ubicaciones">
    <h1 class="text-2xl font-bold mb-4">Ubicaciones</h1>

    <form method="GET" action="{{ route('locations.index') }}" class="flex gap-2 mb-6">
        <input type="text" name="name" value="{{ request('name') }}"
               placeholder="Buscar por nombre" class="border rounded px-3 py-2 flex-1">
        <select name="type" class="border rounded px-3 py-2">
            <option value="">Todos los tipos</option>
            @foreach ($types as $type)
                <option value="{{ $type }}" @selected(request('type') === $type)>{{ $type }}</option>
            @endforeach
        </select>
        <button class="bg-gray-900 text-white rounded px-4 py-2">Filtrar</button>
    </form>

    <ul class="bg-white rounded shadow divide-y">
        @forelse ($locations as $location)
            <li class="px-4 py-3 flex justify-between items-center">
                <div>
                    <a href="{{ route('locations.show', $location) }}" class="font-semibold hover:underline">
                        {{ $location->name }}
                    </a>
                    <p class="text-sm text-gray-600">
                        {{ $location->type ?: 'Tipo desconocido' }} · {{ $location->dimension ?: 'Dimensión desconocida' }}
                    </p>
                </div>
                <span class="text-sm text-gray-600">
                    {{ $location->residents_count }} residentes · {{ $location->natives_count }} nativos
                </span>
            </li>
        @empty
            <li class="px-4 py-3 text-gray-600">No se encontraron ubicaciones.</li>
        @endforelse
    </ul>

    <div class="mt-6">
        {{ $locations->links() }}
    </div>
</x-layouts.explorer>