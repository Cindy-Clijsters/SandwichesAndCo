<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
        </ul>
    </form>

    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
            <i class="ion ion-android-person d-lg-none"></i>
            <div class="d-sm-none d-lg-inline-block">Hallo, {{ administrator.fullName }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="logout.php" class="dropdown-item has-icon">
                    <i class="ion ion-log-out"></i> Afmelden
                </a>
            </div>
        </li>
    </ul>
</nav>