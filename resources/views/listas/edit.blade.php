<x-layouts.explorer title="Editar lista">
    <h1 class="text-2xl font-bold mb-4">Editar lista</h1>

    <form method="POST" action="{{ route('listas.update', $lista->id) }}" class="bg-white rounded shadow p-6 max-w-lg space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold mb-1">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name', $lista->name) }}"
                   class="border rounded px-3 py-2 w-full" required>
            @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block font-semibold mb-1">Descripción (opcional)</label>
            <input id="description" type="text" name="description" value="{{ old('description', $lista->description) }}"
                   class="border rounded px-3 py-2 w-full">
            @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <p class="text-sm text-gray-600">
            Tipo: {{ $lista->type === 'character' ? 'Personajes' : 'Episodios' }} (no se puede cambiar).
        </p>

        <div class="flex gap-3">
            <button class="bg-gray-900 text-black rounded px-4 py-2">Guardar</button>
            <a href="{{ route('listas.show', $lista->id) }}" class="px-4 py-2 hover:underline">Cancelar</a>
        </div>
    </form>
</x-layouts.explorer>