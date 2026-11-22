<x-layouts.explorer title="Inicio">
    <h1 class="text-3xl font-bold mb-2">Rick & Morty Explorer</h1>
    <p class="text-gray-600 mb-6">Explorá los personajes, episodios y ubicaciones del universo de Rick and Morty.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ([
            ['Personajes', $characters, route('characters.index')],
            ['Episodios', $episodes, route('episodes.index')],
            ['Ubicaciones', $locations, route('locations.index')],
        ] as [$label, $total, $url])
            <a href="{{ $url }}" class="bg-white rounded shadow p-6 hover:shadow-md">
                <p class="text-4xl font-bold">{{ $total }}</p>
                <p class="text-gray-600">{{ $label }}</p>
            </a>
        @endforeach
    </div>

    @guest
        <p class="mt-8 text-gray-600">
            <a href="{{ route('register') }}" class="underline">Creá una cuenta</a>
            para organizar personajes y episodios en tus propias listas.
        </p>
    @endguest
</x-layouts.explorer>