<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php
session_start();


$arrError = array();
$arrError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registreer'])) {
        if (!empty($_POST['gebruikersnaam']) && !empty($_POST['paswoord']) && !empty($_POST['geboortedatum'])) {
            $users = CallAPI("GET", $DB . "/tblgebruiker");
            #print_r($users);

            $max = 0;
            foreach ($users as $user) {
                if ($user["gebruikerid"] > $max) {
                    $max = $user["gebruikerid"];
                }
            }

            $checkLogins = array();
            foreach ($users as $user) {
                $checkLogins[] = $user['login'];
            }


            $loginCheck = array_flip($checkLogins);
            #print_r($loginCheck);

            if (array_key_exists($_POST['gebruikersnaam'], $loginCheck)) {
                echo "Gebruiker bestaat al";
            } else {
                if ($_POST['paswoord'] == $_POST['paswoord2']) {
                    $paswoord = md5($_POST['paswoord']);

                    $user_nieuw = array();
                    $user_nieuw['gebruikerid'] = $max + 1;

                    $user_nieuw['vnaam'] = $_POST['vnaam'];
                    $user_nieuw['naam'] = $_POST['naam'];
                    $user_nieuw['gender'] = $_POST['gender'];
                    $user_nieuw['email'] = $_POST['email'];
                    $user_nieuw['gebdatum'] = $_POST['geboortedatum'];

                    $user_nieuw['login'] = $_POST['gebruikersnaam'];
                    $user_nieuw['paswoord'] = $paswoord;

                    $user_nieuw['image'] = "images/profile/default.jpg";

                    //print_r($user_nieuw);

                    $result = CallAPI("POST", $DB . "/tblgebruiker", json_encode($user_nieuw));

                    $_SESSION['login'] = $_POST['gebruikersnaam'];

                    header('location:feed.php');
                    exit;
                } else {
                    echo "Wachtwoorden komen niet overeen";
                }
            }
        }
    }

}
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Register</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<!--HTML CODE-->

<main class="container">

    <a href="index.php" style="color: #CD5727"><i class="fa fa-arrow-left fa-2x back" style="color: #CD5727"></i> Back
        to login.. </a>


    <img src="images/login/drinkz_logo.png" class="col-12" alt="">

    <h1 class="text-center">Become part of our family</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-signin">

        <h4 class="text-center">Algemene gegevens</h4>

        <div class="row">
            <div class="col-12">
                <label for="name">vnaam</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user" style="color: #CD5727"></i></div>
                        <input type="text" name="vnaam" class="form-control" id="vnaam"
                               placeholder="John" required>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <label for="name">naam</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user-o" style="color: #CD5727"> </i></div>
                        <input type="text" name="naam" class="form-control" id="naam"
                               placeholder="Doe" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <label for="name">Gender</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-transgender" style="color: #CD5727"></i></div>
                        <select class="form-control" name="gender">
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <label for="name">Email</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-envelope-o" style="color:#CD5727;"></i></div>
                        <input type="email" name="email" class="form-control" id="email"
                               placeholder="john.doe@email.com" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <label for="name">Date of birth</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon"><i class="fa fa-birthday-cake" style="color: #CD5727"></i></div>
                        <input type="date" name="geboortedatum" class="form-control" id="geboortedatum"
                               placeholder="Doe" required>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="text-center">Login gegevens</h4>
        <div class="row">
            <div class="col-12">
                <label for="name">Login</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-sign-in" style="color: #CD5727"></i></div>
                        <input type="text" name="gebruikersnaam" class="form-control" id="gebruikersnaam"
                               placeholder="johnny" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <label for="name">password</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-unlock-alt" style="color: #CD5727"></i></div>
                        <input type="password" name="paswoord" class="form-control" id="paswoord"
                               placeholder="password" required>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <label for="name">repeat password</label>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon"><i class="fa fa-unlock-alt" style="color: #CD5727"></i></div>
                        <input type="password" name="paswoord2" class="form-control" id="paswoord2"
                               placeholder="password" required>
                    </div>
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary btn-block" name="registreer">Registreer!</button>
    </form>

</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

