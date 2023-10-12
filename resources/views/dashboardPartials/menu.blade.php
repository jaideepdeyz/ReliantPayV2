<!--- Menu -->
<ul class="menu">

    <li class="menu-title">Navigation</li>

    <li class="menu-item">
        <a href="{{ route('dashboard') }}" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
            <span class="menu-text"> Dashboards </span>
        </a>

    </li>

    <li class="menu-item">
        <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link">
            <span class="menu-icon"><i class="fas fa-user"></i></span>
            <span class="menu-text"> Employees </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="menuIcons">
            <ul class="sub-menu">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-text">All Employees </span>
                    </a>
                </li>

            </ul>
        </div>
    </li>
    @if (Auth::user()->role == 'SADMIN' || Auth::user()->role == 'Admin')
        <li class="menu-item">
            <a href="#settings" data-bs-toggle="collapse" class="menu-link">
                <span class="menu-icon"><i class="mdi mdi-bullseye"></i></span>
                <span class="menu-text"> Settings </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="settings">
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{ route('employee-management.index') }}" class="menu-link">
                            <span class="menu-text">All Employees </span>
                        </a>
                    </li>
                    @if (Auth::User()->role == 'SADMIN')
                        <li class="menu-item ">
                            <a class="menu-link " href="#">
                                <span class="menu-text">Manage Departments </span>
                            </a>
                        </li>
                        <li class="menu-item ">
                            <a class="menu-link " href="#">
                                <span class="menu-text">Scholarship Schemes </span>
                            </a>
                        </li>
                        <li class="menu-item ">
                            <a class="menu-link " href="#">
                                <span class="menu-text">Manage File Titles </span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </li>
    @endif
</ul>
<!--- End Menu -->
