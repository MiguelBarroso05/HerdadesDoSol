<style>
    .sidebar {

        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: black;
        width: 15%;
        min-height: 692.69px;
    }

    .sidebar .active {
        background-color: rgb(255, 172, 57);
        border-radius: 0.75rem;
    }

    .sidebar a {
        text-decoration: none;
        color: black;
    }
</style>
<div class="sidebar bg-card rounded-3">
    <div class="d-flex flex-column">
        <a class="py-3 px-3 {{ Route::is('account') ? 'active' : '' }}" href="{{ route('account') }}">
            <i class="bi bi-layout-sidebar-inset me-3 fs-5"></i>My Account
        </a>
        <a class="py-3 px-3 {{ Route::is('personal-info') ? 'active' : '' }}" href="{{ route('personal-info') }}">
            <i class="bi bi-person me-3 fs-5"></i>Personal Information
        </a>
        <a class="py-3 px-3 {{ Route::is('payment-methods') ? 'active' : '' }}" href="{{ route('payment-methods') }}">
            <i class="bi bi-wallet2 me-3 fs-5"></i>Payment Methods
        </a>
        <a class="py-3 px-3 {{ Route::is('orders') ? 'active' : '' }}" href="{{ route('orders') }}">
            <i class="bi bi-book me-3 fs-5"></i>Orders
        </a>
        <a class="py-3 px-3 {{ Route::is('wishlist') ? 'active' : '' }}" href="{{ route('wishlist') }}">
            <i class="bi bi-star me-3 fs-5"></i>Wishlist
        </a>
        <a class="py-3 px-3 {{ Route::is('history') ? 'active' : '' }}" href="{{ route('history') }}">
            <i class="bi bi-bookmark me-3 fs-5"></i>History
        </a>
        <a class="py-3 px-3 {{ Route::is('reviews') ? 'active' : '' }}" href="{{ route('reviews') }}">
            <i class="bi bi-chat-left me-3 fs-5"></i>Reviews
        </a>
        <a class="py-3 px-3 {{ Route::is('support') ? 'active' : '' }}" href="{{ route('support') }}">
            <i class="bi bi-wrench me-3 fs-5"></i>Support
        </a>
    </div>
    <form method="post" action="{{ route('logout') }}" id="logout-form" class="py-3 px-3">
        @csrf
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-3 fs-5"></i>Logout
        </a>
    </form>
</div>
