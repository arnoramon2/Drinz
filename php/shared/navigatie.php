<nav class="navbar navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent"
            aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <?php if (empty($_SESSION['login'])) { ?>
        <a href="">Drinkz</a>
    <?php } else { ?>
        <a href="profile.php"><?php echo "Welcome to Drinkz, " . $_SESSION['login']; ?></a>
    <?php }; ?>
</nav>
<hr class="round">
<header class="container">


    <div class="collapse clearfix" id="navbarToggleExternalContent">
        <ul class="navbar-nav">
            <?php if (empty($_SESSION['login'])) { ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Login </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="login.php">Login</a>
                        <a class="dropdown-item" href="register.php">Register</a>

                    </div>
                </li>

                <?php
            } else {
            ?>
            <li class="nav-item">
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="checkin.php">Check in</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="feed.php">Feed</a>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Groups</a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="members.php">Group Members</a>
                    <a class="dropdown-item" href="pot.php">Pot</a>
                </div>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="ranking.php">Ranking</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="overzicht.php">Overview</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <?php echo "Your profile, " . $_SESSION['login']; ?></a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="profile.php">View Profile</a>
                    <a class="dropdown-item" href="medals.php">Medals</a>
                    <a class="dropdown-item" href="bars.php">Bars</a>
                    <a class="dropdown-item" href="drinks.php">Drinkz</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
        <?php }; ?>
        <hr class="round">
    </div>


</header>
