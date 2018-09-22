<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();

if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $naam = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bars = CallAPI("GET", $DB . "/tblbars");

        $nextID = 0;
        foreach ($bars as $bar) {
            if ($bar['barid'] > $nextID) {
                $nextID = $bar["barid"];
            }
        }

        $checknaam = array();
        foreach ($bars as $bar) {
            $checknaam[] = $bar['naam'];
        }

        $naamcheck = array_flip($checknaam);

        if (array_key_exists($_POST['naam'], $naamcheck)) {
            $naam = "Deze café naam is al in gebruik";
        } else {

            $newbar = array();
            $newbar['barid'] = $nextID + 1;
            $newbar['naam'] = $_POST['naam'];
            $newbar['gemeente'] = $_POST['gemeente'];
            $newbar['postcode'] = $_POST['postcode'];
            $newbar['straat'] = $_POST['straat'];
            $newbar['nummer'] = $_POST['nummer'];
            $newbar['type'] = $_POST['type'];
            $newbar['image'] = "images/bars/default.jpg";

            $result = CallAPI("POST", $DB . '/tblbars', json_encode($newbar));
            // print_r($newbar);

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
    <title>New bar</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <a href="checkin.php"><i class="fa fa-arrow-left fa-2x back"></i> Back</a>
    <h1 class="text-center">Make a new bar</h1>


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col">
        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Bar name</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <input type="text" name="naam" class="form-control" placeholder="Bar name">
                </div>
            </div>
        </div>
        <h6 class="text-center"><?php echo $naam ?></h6>

        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Street name</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <input type="text" name="straat" class="form-control" placeholder="Street name">
                </div>
            </div>
        </div>
        <div class="row margin-top-25">
            <div class="col-4"><p><strong>House number</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <input type="number" name="nummer" class="form-control" placeholder="House number">
                </div>
            </div>
        </div>
        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Postal code</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <input type="number" name="postcode" class="form-control" placeholder="Postal code">
                </div>
            </div>
        </div>
        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Town</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <input type="text" name="gemeente" class="form-control" placeholder="Town">
                </div>
            </div>
        </div>

        <div class="row margin-top-25">
            <div class="col-4"><p><strong>Type</strong></p></div>
            <div class="col-8">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info" style="color: #CD5727"></i>
                </span>
                    <select class="form-control" name="type">
                        <option value="0">Cozy bar</option>
                        <option value="1">Coffee bar</option>
                        <option value="2">Tea room</option>
                        <option value="3">Student bar</option>
                        <option value="4">Dance bar</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block margin-top-25" name="submit">Add</button>
    </form>

    <!--HTML CODE-->
    <?php require_once('php/shared/footer.php'); ?>

