<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Mapsily</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #111; color: #fff; }
        
        /* Custom Pagination */
        .pagination { display: flex; gap: 5px; list-style: none; padding: 0; }
        .page-item { border-radius: 8px; overflow: hidden; }
        .page-link { background: #222; border: 1px solid #333; color: #888; padding: 8px 14px; text-decoration: none; font-size: 13px; font-weight: 600; }
        .page-item.active .page-link { background: #85f43a; color: #000; border-color: #85f43a; }
        .page-item.disabled .page-link { opacity: 0.3; }
    </style>
</head>
<body class="bg-[#111] text-gray-200">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-[#1a1a1a] border-r border-gray-800 hidden md:block">
            <div class="p-6">
                <a href="/" class="flex items-center gap-2">
                    <img src="/assets/img/Mapsily-wihte-logo.png" class="h-8 w-auto">
                    <span class="text-xs bg-gray-800 text-gray-400 px-2 py-1 rounded">Admin</span>
                </a>
            </div>
            <nav class="mt-4 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#85f43a] text-black' : 'hover:bg-gray-800' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.users') ? 'bg-[#85f43a] text-black' : 'hover:bg-gray-800' }}">
                    Users
                </a>
                <a href="{{ route('admin.leads') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.leads') ? 'bg-[#85f43a] text-black' : 'hover:bg-gray-800' }}">
                    Leads
                </a>
                <a href="{{ route('admin.pricing.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.pricing.index') ? 'bg-[#85f43a] text-black' : 'hover:bg-gray-800' }}">
                    Pricing Rules
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.settings.index') ? 'bg-[#85f43a] text-black' : 'hover:bg-gray-800' }}">
                    General Settings
                </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1">
            <header class="h-16 bg-[#1a1a1a] border-b border-gray-800 flex items-center justify-between px-8">
                <h2 class="font-bold text-lg">@yield('page_title', 'Admin Dashboard')</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-400">Welcome, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:underline">Logout</button>
                    </form>
                </div>
            </header>
            
            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 border border-green-500 text-green-500 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('admin_content')
            </main>
        </div>
    </div>

</body>
</html>
