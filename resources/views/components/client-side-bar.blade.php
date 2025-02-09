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
        <a href="{{ route('account') }}" class="hs-py-3 hs-px-3 rounded-lg {{ Route::is('account') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i class="bi bi-layout-sidebar-inset hs-me-3 hs-fs-5"></i>My Account
        </a>
        <a href="{{ route('personal-info') }}" class="hs-py-3 hs-px-3 rounded-lg {{ (Route::is('personal-info') || Route::is('personal-info.edit'))  ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i class="bi bi-person hs-me-3 hs-fs-5"></i>Personal Information
        </a>
        <a href="{{ route('payment-methods') }}" class="hs-py-3 hs-px-3 rounded-lg {{ (Route::is('payment-methods') || Route::is('livewire.update'))  ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}" >
            <i class="bi bi-wallet2 hs-me-3 hs-fs-5"></i>Payment Methods
        </a>
        <a href="{{ route('orders.index') }}" class="hs-py-3 hs-px-3 rounded-lg {{ Route::is('orders.index') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i class="bi bi-book hs-me-3 hs-fs-5"></i>Orders
        </a>
        <a href="{{ route('wishlist') }}" class="hs-py-3 hs-px-3 rounded-lg {{ Route::is('wishlist') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i class="bi bi-star hs-me-3 hs-fs-5"></i>Wishlist
        </a>
        <a href="{{ route('history') }}" class="hs-py-3 hs-px-3 rounded-lg {{ Route::is('history') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i class="bi bi-bookmark hs-me-3 hs-fs-5"></i>History
        </a>
        <a href="{{ route('reviews') }}" class="hs-py-3 hs-px-3 rounded-lg {{ Route::is('reviews') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i class="bi bi-chat-left hs-me-3 hs-fs-5"></i>Reviews
        </a>
        <a href="{{ route('support') }}" class="hs-py-3 hs-px-3 rounded-lg {{ Route::is('support') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i class="bi bi-wrench hs-me-3 hs-fs-5"></i>Support
        </a>
    </div>
    <form method="post" action="{{ route('logout') }}" id="logout-form" class="hs-py-3 hs-px-3">
        @csrf
        <a href="{{ route('logout') }}"
           class="hs-py-3 hs-px-3 rounded-lg {{ Route::is('logout') ? 'bg-primary text-gray-900 hover:bg-primary !important' : 'hover:hs-bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right hs-me-3 hs-fs-5"></i>Logout
        </a>
    </form>
</div>

