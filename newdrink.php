<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();

if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $naam = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dranken = CallAPI("GET", $DB . "/tbldranken");

        $nextID = 0;
        foreach ($dranken as $drank) {
            if ($drank["drankID"] > $nextID) {
                $nextID = $drank["drankID"];
            }
        }

        $checknaam = array();
        foreach ($dranken as $drank) {
            $checknaam[] = $drank['naam'];
        }

        $naamcheck = array_flip($checknaam);

        if (array_key_exists($_POST['name'], $naamcheck)) {
            $naam = "Er bestaat al een drank met deze naam";
        } else {
            $newwdrink = array();
            $newwdrink['drankID'] = $nextID + 1;
            $newwdrink['naam'] = $_POST['name'];
            $newwdrink['alcohol'] = $_POST['percentage'];
            $newwdrink['soort'] = $_POST['soort'];
            $newwdrink['image'] = "images\drinks\defaultDrink.png";

            $result = CallAPI("POST", $DB . "/tbldranken", json_encode($newwdrink));
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
    <title>New drink</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <a href="checkin.php"><i class="fa fa-arrow-left fa-2x back"></i> Back</a>
    <h1 class="text-center">New drink</h1>



    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col">
        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Name</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
            </div>
        </div>
        <h6 class="text-center"><?php echo $naam ?></h6>
        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Type</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <select class="form-control" name="soort" onchange="toonAlchohol(this)">
                        <option value="0">Warme dranken</option>
                        <option value="1">Frisdrank</option>
                        <option value="2">Bier</option>
                        <option value="3">Cocktails</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="alchohol" class="row margin-top-25 d-none">
            <div class="col-4"><p><strong>Percentage</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-percent" style="color: #CD5727"></i>
                </span>
                    <select name="percentage" class="form-control">
                        <?php
                        for ($i = 0; $i <= 80; $i++) {
                            ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>

                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary btn-lg btn-block margin-top-25" name="submit">Add</button>
    </form>

</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

