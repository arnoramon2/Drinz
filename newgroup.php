<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();


if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $naam = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $groepen = CallAPI("GET", $DB . "/tblgroepen");

        $nextID = 0;
        foreach ($groepen as $groep) {
            if ($groep['groepID'] > $nextID) {
                $nextID = $groep["groepID"];
            }
        }

        $checknaam = array();
        foreach ($groepen as $groep) {
            $checknaam[] = $groep['groepnaam'];
        }

        $naamcheck = array_flip($checknaam);

        if (array_key_exists($_POST['groepsnaam'], $naamcheck)) {
            $naam = "Groepsnaam is al in gebruik!";
        } else {
            $newgroup = array();
            $newgroup['groepID'] = $nextID + 1;
            $newgroup['groepnaam'] = $_POST['groepsnaam'];

            $result = CallAPI("POST", $DB . '/tblgroepen', json_encode($newgroup));
            header('location: checkin.php');
            exit;
        }


    }


}


?>


<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>New group</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <a href="checkin.php"><i class="fa fa-arrow-left fa-2x back"></i> Back</a>
    <h1 class="text-center">New group</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col">


        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Name</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info" style="color: #CD5727"></i>
                    </span>
                    <input type="text" name="groepsnaam" class="form-control" placeholder="Name">
                </div>
            </div>
        </div>
        <h6 class="text-center"><?php echo $naam ?></h6>

        <button type="submit" class="btn btn-primary btn-lg btn-block margin-top-25" name="submit">Add</button>
    </form>
</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

