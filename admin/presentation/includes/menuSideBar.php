<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard.php">{{ companyName }}</a>
        </div>

        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img alt="image" src="assets/img/avatar/avatar-male.png">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">{{ administrator.fullName }}</div>
            </div>
        </div>

        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
            <li {% if menuItem is defined and menuItem == "dashboard" %} class="active" {% endif %}>
                <a href="dashboard.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>
            
            <li class="menu-header">Algemeen</li>
            <li {% if menuItem is defined and menuItem == "profile" %} class="active" {% endif %}>
                <a href="profile.php"><i class="ion ion-android-person"></i><span>Mijn profiel</span></a>
            </li>
            
        </ul>

        <div class="p-3 mt-4 mb-4">
            <a href="logout.php" class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block">
                <i class="ion ion-log-out"></i> <div>Afmelden</div>
            </a>
        </div>

    </aside>
</div>