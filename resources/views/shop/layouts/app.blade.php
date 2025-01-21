<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Online Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold">{{ config('app.name') }}</a>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">Products</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-gray-900">
                        Cart ({{ Cart::getTotalQuantity() }})
                    </a>
                    @auth
                        <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-gray-900">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Register</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-sm mt-8">
        <div class="container mx-auto px-4 py-6">
            <p class="text-center text-gray-600">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
