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
    $bars = CallAPI("GET", $DB . "/tblbars");
    $groepen = CallAPI("GET", $DB . "/tblgroepen");

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
    <title>Feed</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">

        <?php
        foreach ($gebruikers as $gebruiker) {
            ?>


                <div class="row ranking-container">
                    <div class="col-4">
                        <a href="profile.php">
                            <img src="<?php echo $gebruiker['image'] ?>"
                                 class="rounded-circle mx-auto d-block margin-top-7"
                                 alt="profilepic" width="75" height="75">
                        </a>
                    </div>
                    <div class="col-7">
                        <p class="text-center margin-top-20"><strong
                                    class='orange'><?php echo $gebruiker['vnaam'] ?></strong> is
                            drinking
                            <?php
                            $a = findInArray($drinks, $gebruiker['drankID'], 'drankID');
                            if ($gebruiker['drankID'] == 0) {

                                echo "<strong class='orange'>nothing</strong>";
                            } else { ?>
                                <strong><?php echo $drinks[$a]['naam'] ?> </strong>
                                <?php
                            }
                            ?>
                            with
                            <?php
                            $b = findInArray($groepen, $gebruiker['groepID'], 'groepID');
                            if ($gebruiker['groepID'] == 0) {
                                echo "<strong class='orange'> no one </strong>";
                            } else { ?>
                                <strong class='orange'><?php echo $groepen[$b]['groepnaam'] ?></strong>
                                <?php
                            }
                            ?>
                            at
                            <?php
                            $c = findInArray($bars, $gebruiker['barid'], 'barid');
                            if ($gebruiker['barid'] == 0) {
                                echo "<strong class='orange'> no place</strong>.";
                            } else { ?>
                                <strong class='orange'><?php echo $bars[$c]['naam'] . "." ?></strong>
                                <?php
                            }
                            ?>

                    </div>
                </div>
            <hr class="round">

            <?php
        }
        ?>

</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

