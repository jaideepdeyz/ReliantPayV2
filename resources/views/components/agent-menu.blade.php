<li class="menu-title">Sales Transactions</li>

<li class="menu-item">
    <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link">
        <span class="menu-icon"><i class="fas fa-money-check"></i></span>

        <span class="menu-text">Sales </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="menuIcons">
        <ul class="sub-menu">
            <li class="menu-item">
                <a href="{{ route('bookSales') }}" class="menu-link">
                    <span class="menu-text">Manage Sales </span>
                    {{-- <span class="menu-icon"><i class="fas fa-plane-departure"></i></span> --}}
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-text">All Bookings </span>
                </a>
            </li> --}}
            {{-- <li class="menu-item">
                <a href="{{ route('authorizedSales') }}" class="menu-link">
                    <span class="menu-text">Sales Listing </span>
                    <span class="menu-icon"><i class="fas fa-user-check"></i></span>
                </a>
            </li> --}}
        </ul>
    </div>
</li>

<li class="menu-title">Reports</li>
<li class="menu-title">Settings</li>
