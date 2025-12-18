<nav class="bg-dark-surface/80 border-b border-dark-border backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white hover:text-primary transition-colors">
                    CashFlow
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="{{ route('profile') }}" class="px-3 py-2 rounded-md text-sm font-medium text-text-secondary hover:text-white hover:bg-dark-bg transition-all">
                        Profile
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium text-text-secondary hover:text-white hover:bg-red-600/20 hover:text-red-400 transition-all cursor-pointer">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile menu button (Simplified for now, visible on small screens to ensure access) -->
            <div class="-mr-2 flex md:hidden">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('profile') }}" class="text-text-secondary hover:text-white p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-text-secondary hover:text-red-400 p-2">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>