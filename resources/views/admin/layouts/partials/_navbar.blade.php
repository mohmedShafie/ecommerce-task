<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar" aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="WafiAdminNavbar">
        <ul class="navbar-nav">

            <!-- dashboard -->
            <li class="nav-item" >
                <a class="nav-link {{Request::is('admin')?'active-page':''}}"
                   href="{{route('admin.dashboard')}}">
                    <i class="fa-solid fa-gauge nav-icon"></i>{{trans('messages.dashboard')}}
                </a>
            </li>



            <!-- branches -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{Request::is('admin/home/*') || Request::is('admin/') ?'active-page':''}}" href="#" id="dashboardsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-staff-snake nav-icon"></i>
                    {{trans('messages.categories')}}
                </a>
            </li>
            <!-- end branches -->



        </ul>
    </div>
</nav>
