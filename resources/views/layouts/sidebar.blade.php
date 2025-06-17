<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh;">
    <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Admin Panel</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-shop"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->is('admin/products*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-box"></i> Produk
            </a>
        </li>
        <li>
            <a href="{{ route('item-categories.index') }}" class="nav-link {{ request()->is('item-categories*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-tag"></i> Kategori Item
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->is('admin/orders*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-sheet-plastic"></i> Pesanan
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-users"></i> Pengguna
            </a>
        </li>
        <li>
            <a href="{{ route('admin.feedback.index') }}" class="nav-link {{ request()->is('admin/feedback*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-comment"></i> Feedback
            </a>
        </li>
    </ul>
</div>
