<style>
    .hs-sidebar {

        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: black;
        width: 15%;
        height: 693px;
    }

    .hs-sidebar .active {
        background-color: rgb(255, 172, 57);
        border-radius: 0.75rem;
    }

    .hs-sidebar a {
        text-decoration: none;
        color: black;
    }
</style>

<div class="hs-sidebar hs-bg-card hs-rounded-3">
    <div class="hs-d-flex hs-flex-column">
        <a class="hs-py-3 hs-px-3 {{ Route::is('account') ? 'active' : '' }}" href="{{ route('account') }}">
            <i class="bi bi-layout-sidebar-inset hs-me-3 hs-fs-5"></i>My Account
        </a>
        <a class="hs-py-3 hs-px-3 {{ Route::is('personal-info') || Route::is('personal-info.edit') ? 'active' : '' }}" href="{{ route('personal-info') }}">
            <i class="bi bi-person hs-me-3 hs-fs-5"></i>Personal Information
        </a>
        <a class="hs-py-3 hs-px-3 {{ Route::is('payment-methods') || Route::is('livewire.update') ? 'active' : '' }}" href="{{ route('payment-methods') }}">
            <i class="bi bi-wallet2 hs-me-3 hs-fs-5"></i>Payment Methods
        </a>
        <a class="hs-py-3 hs-px-3 {{ Route::is('orders') ? 'active' : '' }}" href="{{ route('orders') }}">
            <i class="bi bi-book hs-me-3 hs-fs-5"></i>Orders
        </a>
        <a class="hs-py-3 hs-px-3 {{ Route::is('wishlist') ? 'active' : '' }}" href="{{ route('wishlist') }}">
            <i class="bi bi-star hs-me-3 hs-fs-5"></i>Wishlist
        </a>
        <a class="hs-py-3 hs-px-3 {{ Route::is('history') ? 'active' : '' }}" href="{{ route('history') }}">
            <i class="bi bi-bookmark hs-me-3 hs-fs-5"></i>History
        </a>
        <a class="hs-py-3 hs-px-3 {{ Route::is('reviews') ? 'active' : '' }}" href="{{ route('reviews') }}">
            <i class="bi bi-chat-left hs-me-3 hs-fs-5"></i>Reviews
        </a>
        <a class="hs-py-3 hs-px-3 {{ Route::is('support') ? 'active' : '' }}" href="{{ route('support') }}">
            <i class="bi bi-wrench hs-me-3 hs-fs-5"></i>Support
        </a>
    </div>
    <form method="post" action="{{ route('logout') }}" id="logout-form" class="hs-py-3 hs-px-3">
        @csrf
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right hs-me-3 hs-fs-5"></i>Logout
        </a>
    </form>
</div>

