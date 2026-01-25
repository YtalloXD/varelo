
<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' / IM' : 'IM' }}</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="/xlogo.png" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <nav class="navbar bg-base-100 shadow-md">
        <div class="navbar-start">
            <a href="/" class="btn btn-ghost text-xl">↪ IM</a>
        </div>
        <div class="navbar-end gap-2">
            @auth
                <a href="/profile" class="btn btn-ghost btn-sm">
                @if (auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="w-10 h-10 rounded-full object-cover">
                @else
                    <img src="{{ asset('default-avatar.png') }}" alt="Default Image" class="w-10 h-10 rounded-full object-cover">
                @endif
                <span class="text-sm">{{ auth()->user()->name }}</span></a>
                
                <form action="{{ route('theme.toggle') }}" method="POST">
                    @csrf
                    <button type="submit" class="theme-toggle">
                        {{ session('theme') === 'dark' ? '☀️' : '🌙' }}
                    </button>
                </form>

                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Logout</button>
                </form>
            @else
                <a href="/login" class="btn btn-ghost btn-sm">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
            @endauth
        </div>
    </nav>
    
    @if (session('success'))
    <div class="toast toast-top toast-center">
        <div class="alert alert-success animate-fade-out">
            <svg xmlns="<http://www.w3.org/2000/svg>" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="footer footer-center p-5 bg-base-300 text-base-content text-xs">
        <div>
            <p>© 2025 IM - Built by Ytalo with ❤️</p>
            {{-- <p>© 2025 IM - Built with Laravel and ❤️</p> --}}
        </div>
    </footer>
</body>

</html>