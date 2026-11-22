<x-layouts.explorer :title="$lista->name">
    <a href="{{ route('listas.index') }}" class="text-sm text-gray-600 hover:underline">← Mis listas</a>

    <div class="mt-3 mb-6">
        <h1 class="text-2xl font-bold">{{ $lista->name }}</h1>
        <p class="text-gray-600">
            Lista de {{ $lista->type === 'character' ? 'personajes' : 'episodios' }}
            @if ($lista->description) · {{ $lista->description }} @endif
        </p>
        <a href="{{ route('listas.edit', $lista->id) }}" class="text-sm underline">Editar</a>
    </div>

    <ul class="bg-white rounded shadow divide-y">
        @forelse ($items as $item)
            <li class="px-4 py-3 flex justify-between items-center">
                @if ($lista->type === 'character')
                    <div class="flex items-center gap-3">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-12 h-12 rounded object-cover" loading="lazy">
                        <a href="{{ route('characters.show', $item) }}" class="font-semibold hover:underline">{{ $item->name }}</a>
                    </div>
                @else
                    <div>
                        <span class="text-gray-600">{{ $item->code }}</span>
                        <a href="{{ route('episodes.show', $item) }}" class="font-semibold hover:underline">{{ $item->name }}</a>
                    </div>
                @endif

                <form method="POST" action="{{ route('listas.items.remove', [$lista->id, $item->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline">Quitar</button>
                </form>
            </li>
        @empty
            <li class="px-4 py-3 text-gray-600">
                Esta lista está vacía. Agregá elementos desde el
                <a href="{{ $lista->type === 'character' ? route('characters.index') : route('episodes.index') }}"
                   class="underline">explorador</a>.
            </li>
        @endforelse
    </ul>

    <div class="mt-6">
        {{ $items->links() }}
    </div>
</x-layouts.explorer>