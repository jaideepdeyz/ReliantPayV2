<!--- Menu -->
<ul class="menu">

    <li class="menu-title">Navigation</li>

    <li class="menu-item">
        <a href="{{ route('dashboard') }}" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
            <span class="menu-text"> Dashboard </span>
        </a>
    </li>
    @if(Auth::User()->role == RoleEnum::AGENT->value)
    <li class="menu-item">
        <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link">
            <span class="menu-icon"><i class="fas fa-user"></i></span>
            <span class="menu-text"> Book Sale </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="menuIcons">
            <ul class="sub-menu">
                <li class="menu-item">
                    <a href="{{route('agentsIndex')}}" class="menu-link">
                        <span class="menu-text">New Sale </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-text">All Bookings </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-text">Authorized Bookings </span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif
    @if(Auth::User()->is_approved == 'Yes')
        @if(Auth::User()->role == RoleEnum::DEALER->value)
        <li class="menu-item">
            <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link">
                <span class="menu-icon"><i class="fas fa-user"></i></span>
                <span class="menu-text"> Agents </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="menuIcons">
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{route('agentsIndex')}}" class="menu-link">
                            <span class="menu-text">Add Agent </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-text">All Agents </span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
        @endif
    @endif
    @if (Auth::user()->role == RoleEnum::ADMIN->value)
        <li class="menu-item">
            <a href="#settings" data-bs-toggle="collapse" class="menu-link">
                <span class="menu-icon"><i class="material-symbols-outlined">settings_accessibility</i></span>
                <span class="menu-text"> Dealers </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="settings">
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{route('dealersByStatus', StatusEnum::SUBMITTED->value)}}" class="menu-link">
                            <span class="menu-text">Pending Dealers</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('dealersByStatus', StatusEnum::APPROVED->value)}}" class="menu-link">
                            <span class="menu-text">Approved Dealers</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('dealersByStatus', StatusEnum::REJECTED->value)}}" class="menu-link">
                            <span class="menu-text">Rejected Dealers</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('dealersByActivityStatus', 'Yes')}}" class="menu-link">
                            <span class="menu-text">Active Dealers</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('dealersByActivityStatus', 'No')}}" class="menu-link">
                            <span class="menu-text">Inactive Dealers</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
</ul>
<!--- End Menu -->
