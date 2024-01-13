<li class="menu-item">
    <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link">
        <span class="menu-icon"><i class="fas fa-plane"></i></span>

        <span class="menu-text">Sales </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="menuIcons">
        <ul class="sub-menu">
            <li class="menu-item">
                <a href="{{ route('bookSales') }}" class="menu-link">
                    <span class="menu-text">New Sale </span>
                    {{-- <span class="menu-icon"><i class="fas fa-plane-departure"></i></span> --}}
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-text">All Bookings </span>
                </a>
            </li> --}}
            <li class="menu-item">
                <a href="{{ route('authorizedSales') }}" class="menu-link">
                    <span class="menu-text">Authorized Sales </span>
                    {{-- <span class="menu-icon"><i class="fas fa-user-check"></i></span> --}}
                </a>
            </li>
        </ul>
    </div>
</li>
