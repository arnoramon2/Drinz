<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php
//PHP CODE HIER
session_start();

if (!empty($_SESSION['login'])) {
    header("location: feed.php");
} else {
    $loginmis = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $logins = CallAPI("GET", $DB . "/tblgebruiker");

        if (isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['paswoord'])) {
            $user_login = $_POST['login'];
            $user_paswoord = $_POST['paswoord'];

            $checkLogins = array();
            $checkWachtwoorden = array();
            foreach ($logins as $login) {
                $checkWachtwoorden[$login['login']] = $login['paswoord'];
            }
            if (array_key_exists($user_login, $checkWachtwoorden)) {
                $user_paswoord = md5($user_paswoord);
                if ($checkWachtwoorden[$user_login] == $user_paswoord) {

                    foreach ($logins as $login) {
                       $id = $login['gebruikerid'];
                       $_SESSION['test2'] = $id;
                        $id = $login['gebruikerid'];
                    }
                    $_SESSION['login'] = $_POST['login'];
                    //print("login en wacht ok");

                    header("location: checkin.php");
                } else {
                    $loginmis = "Je login was verkeerd";
                }
            } else {
                $loginmis = "passwoord was verkeerd";
            }
        } else {
            echo "no check";
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Document</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<!--HTML CODE-->

<main class="container">


    <img src="images/login/drinkz_logo.png" class="col-12" alt="">


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-signin">
        <p class="text-center">Please log in</p>
        <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle" style="color: #CD5727"></i>
                                </span>
            <input type="text" id="login" name="login" class="form-control" placeholder="Username"
                   autocomplete="new-password"
                   required autofocus>
        </div>
        <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key" style="color: #CD5727"></i>
                                </span>

            <input type="password" id="paswoord" name="paswoord" class="form-control"
                   placeholder="Password" autocomplete="new-password" required>
        </div>
        <p>No account yet ?<a href="register.php" style="color: #CD5727">Register</a></p>
        <button class="btn btn-primary btn-block" type="submit" name="submit">Log in</button>
        <p class="text-center"><?php echo $loginmis ?></p>
    </form>
</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

