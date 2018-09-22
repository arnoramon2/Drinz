<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();
if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    //PHP CODE HIER
    $gebruikers = CallAPI("GET", $DB . "/tblgebruiker");
    $drinks = CallAPI("GET", $DB . "/tbldranken");
    function findInArray($arr, $value, $column = 0)
    {
        $nr = 0;
        foreach ($arr as $item) {
            if ($item[$column] == $value) {
                return $nr;
            }
            $nr++;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Members</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <h1 class="text-center">Members</h1>
        <?php
        foreach ($gebruikers as $gebruiker) {
            ?>
            <hr class="round">
                <div class="row ranking-container">

                    <div class="offset-1 col-3 p-1">
                        <img src="<?php echo $gebruiker['image'] ?>"
                             class="rounded-circle mx-auto d-block img-fluid"
                             alt="<?php echo "Profile image from " . $gebruiker['naam'] ?>"
                             style="height:85px; width: 85px;">
                    </div>

                    <div class="col-8">
                        <p class="margin-top-20 fontsize-25">
                            <?php
                            if ($gebruiker['gender'] == 0) { ?>
                                <i class="fa fa-mars" aria-hidden="true"></i>
                                <?php
                            } else { ?>
                                <i class="fa fa-venus" aria-hidden="true"></i>
                                <?php
                            }
                            ?>
                            <?php echo $gebruiker['naam'] . " " . $gebruiker['vnaam'] ?>
                        </p>

                    </div>
                </div>

            <?php
        }
        ?>
    <hr class="round">
</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

