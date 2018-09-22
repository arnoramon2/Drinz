<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();
if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $drinks = CallAPI("GET", $DB . "/tbldranken");
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Pot</title>
    <link rel="shortcut icon" href="images/icoon.ico" />
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <h1 class="text-center">Group name</h1>
    <div id="pot" class="rounded-circle">
        <p class="pot">€<?php echo rand(5, 100) ?></p>
    </div>
    <hr class="round">
    <br>
    <button type="submit" class="btn btn-success" style="width: 100%" data-toggle="modal"
            data-target="#add">
        New drink
        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
    </button>
    <hr class="round">
    <h3 class="text-center" style="color: white">History:</h3>
    <ol class="list-unstyled margin-top-25">
        <li class="border">
            <div class="row ranking-container" >
                <div class="col-4">
                    <img src="images/testdrink.png" class="rounded-circle mx-auto d-block margin-top-7" alt="drink" width="75" height="75">
                </div>
                <div class="col-7">
                    <p class="margin-top-20"> <strong>-10$</strong></p>
                    <p> 5 stella artois</p>
                </div>
            </div>
        </li>
        <li class="border">
            <div class="row ranking-container" >
                <div class="col-4">
                    <img src="images/testdrink.png" class="rounded-circle mx-auto d-block margin-top-7" alt="drink" width="75" height="75">
                </div>
                <div class="col-7">
                    <p class="margin-top-20"> <strong>-10$</strong></p>
                    <p> 5 stella artois</p>

                </div>
            </div>
        </li>
    </ol>
    <hr class="round">


    <!-- Modal DRANKEN-->
    <div class="modal fade" id="add" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose a drink</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>

                </div>

                <div class="modal-body container">
                    <h2 class="col-12 text-center">Hot drinks</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($drinks as $drink) { ?>
                            <?php
                            if ($drink['soort'] == 0) { ?>
                                <form method="POST" class="col-4 ">
                                    <div class="choose">
                                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid "
                                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>"
                                             height="2000">
                                    </div>
                                    <p class="text-center"><?php echo $drink['naam'] ?>
                                        <input type="text" name="drankid" value="<?php echo $drink['drankID'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success align-bottom" name="drinkz">
                                            <a href="pot.php"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>


                    <h2 class="col-12 text-center">Soda</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($drinks as $drink) { ?>
                            <?php
                            if ($drink['soort'] == 1) { ?>
                                <form method="POST" class="col-4 ">
                                    <div class="choose">
                                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid "
                                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>"
                                             height="2000">
                                    </div>
                                    <p class="text-center"><?php echo $drink['naam'] ?>
                                        <input type="text" name="drankid" value="<?php echo $drink['drankID'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success align-bottom" name="drinkz">
                                            <a href="pot.php"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>


                    <h2 class="col-12 text-center">Beer</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($drinks as $drink) { ?>
                            <?php
                            if ($drink['soort'] == 2) { ?>
                                <form method="POST" class="col-4 ">
                                    <div class="choose">
                                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid "
                                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>"
                                             height="2000">
                                    </div>
                                    <p class="text-center"><?php echo $drink['naam'] ?>
                                        <input type="text" name="drankid" value="<?php echo $drink['drankID'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success align-bottom" name="drinkz">
                                            <a href="pot.php"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>


                    <h2 class="col-12 text-center">Cocktails / Gins</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($drinks as $drink) { ?>
                            <?php
                            if ($drink['soort'] == 3) { ?>
                                <form method="POST" class="col-4 ">
                                    <div class="choose">
                                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid "
                                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>"
                                             height="2000">
                                    </div>
                                    <p class="text-center"><?php echo $drink['naam'] ?>
                                        <input type="text" name="drankid" value="<?php echo $drink['drankID'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success align-bottom" name="drinkz">
                                            <a href="pot.php"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

