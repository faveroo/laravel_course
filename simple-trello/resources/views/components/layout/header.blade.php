<nav class="navbar bg-dark">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand text-white">
            Home
        </a>

        @auth
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white"
                href="#"
                role="button"
                data-bs-toggle="dropdown">
                {{ auth()->user()->name }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">Perfil</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth
</nav>