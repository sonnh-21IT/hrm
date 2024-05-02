<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->is('country*') ? 'active' : '' }}"><a href="{{ route('country.index') }}"><i class="fa-solid fa-earth-asia"> </i><span>Country</span></a></li>
                    <li class="{{ request()->is('user*') ? 'active' : '' }}"><a href="{{ route('user.index') }}"><i class="fa-solid fa-user"></i> <span>User</span></a></li>
                    <li class="{{ request()->is('company*') ? 'active' : '' }}"><a href="{{ route('company.index') }}"><i class="fa-solid fa-building"></i> <span>Company</span></a></li>
                    <li class="{{ request()->is('role*') ? 'active' : '' }}"><a href="{{ route('role.index') }}"><i class="fa-solid fa-dice-d20"></i> <span>Role</span></a></li>
                    <li class="{{ request()->is('department*') ? 'active' : '' }}"><a href="{{ route('department.index') }}"><i class="fa-regular fa-calendar-minus"></i> <span>Department</span></a></li>
                    <li class="{{ request()->is('project*') ? 'active' : '' }}"><a href="{{ route('project.index') }}"><i class="fa-solid fa-bars-progress"></i> <span>Project</span></a></li>
                    <li class="{{ request()->is('task*') ? 'active' : '' }}"><a href="{{ route('task.index') }}"><i class="fa-solid fa-list-check"></i> <span>Task</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>