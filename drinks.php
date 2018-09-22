<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();
if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    //PHP CODE HIER
    $drinks = CallAPI("GET", $DB . "/tbldranken");


    $mysqli = new mysqli("localhost", "root", "usbw", "drinkz");
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $sql = "SELECT gebruikerid FROM tblgebruiker WHERE login = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $_SESSION['login']);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $image = ($result);
    $stmt->close();

    $sql2 = "SELECT distinct(drankid) FROM tblHeeftgedronken WHERE gebruikerid= ?";
    $stmt2 = $mysqli->prepare($sql2);
    $stmt2->bind_param('s', $result);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $arrreedsgedronken = array();
    while ($myrow = $result2->fetch_assoc()) {
        array_push($arrreedsgedronken, $myrow['drankid']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newdrink = array();
        $newdrink['gebruikerid'] = $result;
        $newdrink['drankID'] = $_POST['drank'];

        $newdrinkresult = CallAPI("POST", $DB . "/tblheeftgedronken", json_encode($newdrink));
        //print_r($newdrink);
        header('location:drinks.php');
        exit;
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Drinks</title>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <h1 class="text-center">All drinks</h1>
    <hr class="round">

    <h2 class="text-center">Hot Drinks</h2>
    <div class="row mt-4">
        <?php
        foreach ($drinks as $drink) {
            if ($drink['soort'] == 0) {


                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col-4">
                    <div class="overzicht">
                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid"
                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>">
                    </div>
                    <p class="text-center"><?php echo $drink['naam'] ?>
                        <input type="text" name="drank" value="<?php echo $drink['drankID'] ?>" hidden>
                        <br>
                        <?php
                        if (in_array($drink['drankID'], $arrreedsgedronken)) { ?>
                            <button type="submit" class="btn btn-danger" disabled>
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        } else { ?>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#<?php echo $drink['drankID'] ?>">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                    </p>
                </form>


                <?php
            }
        }
        ?>
    </div>
    <hr class="round">

    <h2 class="text-center">Soda</h2>
    <div class="row mt-4">
        <?php
        foreach ($drinks as $drink) {
            if ($drink['soort'] == 1) { ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col-4">

                    <div class="overzicht">
                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid"
                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>">
                    </div>

                    <p class="text-center"><?php echo $drink['naam'] ?>
                        <input type="text" name="drank" value="<?php echo $drink['drankID'] ?>" hidden>
                        <br>
                        <?php
                        if (in_array($drink['drankID'], $arrreedsgedronken)) { ?>
                            <button type="submit" class="btn btn-danger" disabled>
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        } else { ?>

                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#<?php echo $drink['drankID'] ?>">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                    </p>
                </form>
                <?php
            }
        }
        ?>
    </div>

    <hr class="round">
    <h2 class="text-center">Beer</h2>
    <div class="row mt-4">
        <?php
        foreach ($drinks as $drink) {
            if ($drink['soort'] == 2) { ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col-4">
                    <div class="overzicht">
                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid"
                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>">
                    </div>
                    <p class="text-center"><?php echo $drink['naam'] ?>
                        <input type="text" name="drank" value="<?php echo $drink['drankID'] ?>" hidden>
                        <br>
                        <?php
                        if (in_array($drink['drankID'], $arrreedsgedronken)) { ?>
                            <button type="submit" class="btn btn-danger" disabled>
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        } else { ?>

                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#<?php echo $drink['drankID'] ?>">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                    </p>
                </form>
                <?php
            }
        }
        ?>
    </div>
    <hr class="round">
    <h2 class="text-center">Cocktails / Gins</h2>
    <div class="row mt-4">
        <?php
        foreach ($drinks

                 as $drink) {
            if ($drink['soort'] == 3) { ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col-4">
                    <div class="overzicht">
                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid"
                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>">
                    </div>
                    <p class="text-center"><?php echo $drink['naam'] ?>
                        <input type="text" name="drank" value="<?php echo $drink['drankID'] ?>" hidden>
                        <br>
                        <?php
                        if (in_array($drink['drankID'], $arrreedsgedronken)) { ?>
                            <button type="submit" class="btn btn-danger" disabled>
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        } else { ?>

                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#<?php echo $drink['drankID'] ?>">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                    </p>
                </form>
                <?php
            }
        }
        ?>

    </div>
    <hr class="round">
    <?php
    foreach ($drinks as $drink) { ?>
        <!-- Modal -->
        <div class="modal fade" id="<?php echo $drink['drankID'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $drink['naam'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Type of drink:
                            <?php

                            if ($drink['soort'] == 0) {
                                echo "Hot Drinks";
                            } else if ($drink['soort'] == 1) {
                                echo "Soda";
                            } else if ($drink['soort'] == 2) {
                                echo "Beer";
                            } else if ($drink['soort'] == 3) {
                                echo "Cocktail / gin";
                            }
                            ?>
                        </p>
                        <?php
                        if (!empty($drink['alcohol'])) {
                            ?>  <p>Alchohol: <?php echo $drink['alcohol'] ?> °</p>

                            <?php
                        }
                        ?>
                        <img src="<?php echo $drink['image'] ?>" alt="" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

