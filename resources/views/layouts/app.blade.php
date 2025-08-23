<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Product CRUD') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between">
        <a href="{{ route('products.index') }}" class="font-bold text-xl">Product CRUD</a>

        <div>
            @auth
                <span class="mr-4">Hi, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-500 text-white px-3 py-1 rounded">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Page Content -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>
</html>
