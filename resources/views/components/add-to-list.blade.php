@props(['type', 'itemId'])

@auth
    @php
        $listas = auth()->user()->listas()->where('type', $type)->orderBy('name')->get();
    @endphp

    <div class="mt-4">
        @if ($listas->isEmpty())
            <p class="text-sm text-gray-600">
                No tenés listas de {{ $type === 'character' ? 'personajes' : 'episodios' }}.
                <a href="{{ route('listas.create') }}" class="underline">Creá una</a>.
            </p>
        @else
            @foreach ($listas as $lista)
                <form method="POST" action="{{ route('listas.items.add', $lista->id) }}" class="inline">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $itemId }}">
                    <button class="border rounded px-3 py-1 text-sm hover:bg-gray-100">+ {{ $lista->name }}</button>
                </form>
            @endforeach
        @endif
    </div>
@endauth