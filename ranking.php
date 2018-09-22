<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();
if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $gebruikers = CallAPI("GET", $DB . '/tblgebruiker');


    $mysqli = new mysqli("localhost", "root", "usbw", "drinkz");
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $arrreedsgedronken = array();
    foreach ($gebruikers as $gebruiker) {
        $sql = "SELECT gebruikerid FROM tblgebruiker WHERE login = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $gebruiker['login']);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $image = ($result);
        $stmt->close();
        // print_r("AA " . $result . "<br>");

        $sql2 = "SELECT COUNT(drankid) FROM tblHeeftgedronken WHERE gebruikerid= ?";
        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param('s', $result);
        $stmt2->execute();
        $stmt2->bind_result($result2);
        $stmt2->fetch();
        $image2 = ($result2);
        $stmt2->close();
        //print_r("BB " . $result2 . "<br>");


        $arrreedsgedronken[] = $result2;
        //echo("*");
        //print_r(count($arrreedsgedronken));
    }

//print_r($arrreedsgedronken);
    //echo "------";
    //print_r($result);
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Ranking</title>
    <link rel="shortcut icon" href="images/icoon.ico" />
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <h1 class="text-center">Ranking</h1>
    <?php
    foreach ($gebruikers as $gebruiker) {
        $sql5 = "SELECT gebruikerid FROM tblgebruiker WHERE login = ?";
        $stmt5 = $mysqli->prepare($sql5);
        $stmt5->bind_param('s', $gebruiker['login']);
        $stmt5->execute();
        $stmt5->bind_result($result5);
        $stmt5->fetch();
        $image5 = ($result5);
        $stmt5->close();
        //print_r($result5);;
        //echo ($arrreedsgedronken[$result5]);
        ?>
        <hr class="round">

        <span class="badge badge-default badge-pill"><?php echo $gebruiker["gebruikerid"] + 1 ?></span>
        <div class="row ranking-container">

            <div class="col-3">
                <img src="<?php echo $gebruiker['image'] ?>" class="rounded-circle mx-auto d-block margin-top-25"
                     alt="profilepic" width="75" height="75">
                <p class="text-center small"><?php echo $gebruiker['naam'] . " " . $gebruiker['vnaam'] ?></p>

            </div>
            <div class="col-3">
                <a href="drinks.php">
                    <i class="fa fa-glass fa-3x ranking-content" aria-hidden="true" style="color: #CD5727"></i>
                    <p class="text-center margin-top-25"><strong><?php echo $arrreedsgedronken[$result5] ?></strong></p>
                </a>
            </div>
            <div class="col-3">
                <a href="medals.php">
                    <i class="fa fa-trophy fa-3x ranking-content" aria-hidden="true" style="color: #CD5727"></i>
                    <p class="text-center margin-top-25"><strong>14</strong></p>
                </a>
            </div>
            <div class="col-3">
                <a href="bars.php">
                    <i class="fa fa-home fa-3x ranking-content" aria-hidden="true" style="color: #CD5727"></i>
                    <p class="text-center margin-top-25"><strong>12</strong></p>
                </a>
            </div>
        </div>

        <?php
    }
    ?>


</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

