@if(Auth::user()->is_approved == 'Yes' && Auth::user()->is_active == 'Yes')

<li class="menu-title">Agents</li>

<li class="menu-item">
    <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link">
        <span class="menu-icon"><i class="fas fa-users-cog"></i></span>

        <span class="menu-text">Manage Agents </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="menuIcons">
        <ul class="sub-menu">
            <li class="menu-item">
                <a href="{{route('addAgent')}}" class="menu-link">
                    <span class="menu-text">Add Agent </span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="menu-title">Reports</li>

<li class="menu-title">Settings</li>
@endif
