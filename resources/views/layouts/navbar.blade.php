<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex flex-column" href="{{ route('home') }}">
            <strong>ApotekJaya</strong>
            <small class="fw-light" style="font-size: 0.75rem;">Toko Online</small>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                        href="{{ route('products.index') }}">Produk</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}"
                            href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle "
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role == 'admin')
                            <li><a class="dropdown-item" href="{{ route('admin.products.index') }}"><i class="fa-solid fa-user-tie" style="color: #63E6BE;"></i> Admin</a></li>
                            @endif

                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user" style="color: #63E6BE;"></i> Profile</a></li>
                            <li class="dropdown-item">
                                <a href="{{ route('orders.index') }}" class="link-dark link-underline link-underline-opacity-0"><i class="fa-solid fa-sheet-plastic" style="color: #63E6BE;"></i>  Order</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fa-solid fa-right-from-bracket" style="color: #63E6BE;"></i>  Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
