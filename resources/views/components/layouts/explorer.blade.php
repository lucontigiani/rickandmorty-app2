<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Rick & Morty Explorer' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="/" class="font-bold text-lg">Rick & Morty Explorer</a>
                <a href="{{ route('characters.index') }}" class="hover:underline">Personajes</a>
                <a href="{{ route('episodes.index') }}" class="hover:underline">Episodios</a>
                <a href="{{ route('locations.index') }}" class="hover:underline">Ubicaciones</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('profile.edit') }}" class="text-sm text-gray-600 hover:underline">
    {{ Auth::user()->name }}
</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="hover:underline">Salir</button>
                    </form>
                    <a href="{{ route('listas.index') }}" class="hover:underline">Mis listas</a>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="hover:underline">Ingresar</a>
                    <a href="{{ route('register') }}" class="hover:underline">Registrarse</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @if (session('success'))
    <div class="bg-green-100 text-green-800 rounded px-4 py-2 mb-4">{{ session('success') }}</div>
@endif
        {{ $slot }}
    </main>
</body>
</html>