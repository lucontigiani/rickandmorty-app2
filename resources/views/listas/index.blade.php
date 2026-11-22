<x-layouts.explorer title="Mis listas">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Mis listas</h1>
        <a href="{{ route('listas.create') }}" class="bg-gray-900 text-black rounded px-4 py-2">Nueva lista</a>
    </div>

    <ul class="bg-white rounded shadow divide-y">
        @forelse ($listas as $lista)
            <li class="px-4 py-3 flex justify-between items-center">
                <div>
                    <a href="{{ route('listas.show', $lista->id) }}" class="font-semibold hover:underline">{{ $lista->name }}</a>
                    <p class="text-sm text-gray-600">
                        {{ $lista->type === 'character' ? 'Personajes' : 'Episodios' }}
                        · {{ $lista->type === 'character' ? $lista->characters_count : $lista->episodes_count }} elementos
                    </p>
                    @if ($lista->description)
                        <p class="text-sm text-gray-600">{{ $lista->description }}</p>
                    @endif
                </div>
                <form method="POST" action="{{ route('listas.destroy', $lista->id) }}"
                      onsubmit="return confirm('¿Eliminar esta lista?')">
                    @csrf
                    @method('DELETE') 
                    <button class="text-red-600 hover:underline">Eliminar</button>
                </form>
            </li>
        @empty
            <li class="px-4 py-3 text-gray-600">Todavía no tenés listas.</li>
        @endforelse
    </ul>
</x-layouts.explorer>