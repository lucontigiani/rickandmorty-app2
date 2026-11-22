<x-layouts.explorer title="Nueva lista">
    <h1 class="text-2xl font-bold mb-4">Nueva lista</h1>

    <form method="POST" action="{{ route('listas.store') }}" class="bg-white rounded shadow p-6 max-w-lg space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-semibold mb-1">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="border rounded px-3 py-2 w-full" required>
            @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block font-semibold mb-1">Descripción (opcional)</label>
            <input id="description" type="text" name="description" value="{{ old('description') }}"
                   class="border rounded px-3 py-2 w-full">
            @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="type" class="block font-semibold mb-1">Tipo de lista</label>
            <select id="type" name="type" class="border rounded px-3 py-2 w-full" required>
                <option value="character" @selected(old('type') === 'character')>Personajes</option>
                <option value="episode" @selected(old('type') === 'episode')>Episodios</option>
            </select>
            @error('type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            <p class="text-sm text-gray-600 mt-1">No se puede cambiar después de crear la lista.</p>
        </div>

        <button class="bg-gray-900 text-black rounded px-4 py-2">Crear lista</button>
    </form>
</x-layouts.explorer>