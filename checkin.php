<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();
if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $gebruikers = CallAPI("GET", $DB . "/tblgebruiker");
    $drinks = CallAPI("GET", $DB . "/tbldranken");
    $bars = CallAPI("GET", $DB . "/tblbars");
    $groepen = CallAPI("GET", $DB . "/tblgroepen");


    $mysqli = new mysqli("localhost", "root", "usbw", "drinkz");
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $stmt = $mysqli->prepare("SELECT gebruikerid FROM tblgebruiker WHERE login = ?");
    $stmt->bind_param('s', $_SESSION['login']);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();

    //print_r($result);


    $drankid = "";
    $groupid = "";
    $barid = "";
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'updatedrink') {
            $drankid = $_POST['drankid'];
            $stmt2 = $mysqli->prepare("UPDATE tblgebruiker SET drankID = ? WHERE gebruikerid = ?");
            $stmt2->bind_param("ii", $drankid, $result);
            $stmt2->execute();
            $stmt2->close();
            header('location:checkin.php');
        } else if ($_GET['action'] == 'updategroup') {

            $groupid = $_POST['group'];
            $stmt3 = $mysqli->prepare("UPDATE tblgebruiker SET groepID = ? WHERE gebruikerid = ?");
            $stmt3->bind_param("ii", $groupid, $result);
            $stmt3->execute();
            $stmt3->close();
            header('location:checkin.php');

        } else if ($_GET['action'] == 'updatebar') {

            $barid = $_POST['barid'];
            $stmt3 = $mysqli->prepare("UPDATE tblgebruiker SET barid = ? WHERE gebruikerid = ?");
            $stmt3->bind_param("ii", $barid, $result);
            $stmt3->execute();
            $stmt3->close();
            header('location:checkin.php');

        }
    }


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
    <title>Drinkz | Check In</title>
    <link rel="shortcut icon" href="images/icoon.ico"/>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>

<main>

    <div class="container row align-items-center checkin">

        <div class="col-4 content-center">
            <?php
            foreach ($gebruikers as $gebruiker) {
                if ($gebruiker['gebruikerid'] == $result) { ?>
                    <img src="<?php echo $gebruiker['image'] ?>" class="rounded-circle img-fluid ">
                    <?php
                }
            }

            ?>
        </div>

        <div class="col-8 content-center">
            <?php
            foreach ($gebruikers as $gebruiker) {
                if ($gebruiker['gebruikerid'] == $result) {
                    $a = findInArray($drinks, $gebruiker['drankID'], 'drankID');
                    ?>
                    <p><strong class='orange'><?php echo $_SESSION['login'] ?></strong> is drinking
                    <?php
                    if ($gebruiker['drankID'] == 0) {
                        echo "<strong class='orange'>nothing,</strong>";
                    } else { ?>
                        <strong class="orange"><?php echo $drinks[$a]['naam'] . "," ?></strong>
                        <?php
                    }
                    ?>
                    <?php
                    $b = findInArray($groepen, $gebruiker['groepID'], 'groepID');
                    if ($gebruiker['groepID'] == 0) {
                        echo "<strong class='orange'> alone </strong> at";
                    } else {
                        ?>
                        with<strong class='orange'> <?php echo $groepen[$b]['groepnaam'] ?></strong> at
                        <?php
                    }
                    ?>


                    <?php
                    $c = findInArray($bars, $gebruiker['barid'], 'barid');
                    if ($gebruiker['barid'] == 0) {
                        echo "<strong class='orange'> no place </strong>";
                    } else {

                        ?>
                        <strong class="orange"><?php echo $bars[$c]['naam'] ?></strong></p>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <hr class="round">
    <div class="container row align-items-center checkin">
        <div class="col-4">
            <i class="fa fa-beer fa-4x orange"></i>
        </div>
        <div class="col-5 justify-content-center">
            <p>Choose a drink</p>
        </div>
        <div class="col-3 justify-content-center">
            <a class="btn" data-toggle="modal"
               data-target="#dranken">
                <i class="fa fa-plus fa-3x orange" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <hr class="round">

    <div class="container row align-items-center checkin">
        <div class="col-4">
            <i class="fa fa-users fa-4x orange"></i>
        </div>
        <div class="col-5 justify-content-center">
            <p>Choose a group</p>
        </div>
        <div class="col-3 justify-content-center">
            <a class="btn" data-toggle="modal"
               data-target="#group">
                <i class="fa fa-plus fa-3x orange" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <hr class="round">
    <div class="container row align-items-center checkin">
        <div class="col-4">
            <i class="fa fa-home fa-4x orange"></i>
        </div>
        <div class="col-5 justify-content-center">
            <p>Choose a bar</p>
        </div>
        <div class="col-3 justify-content-center">
            <a class="btn" data-toggle="modal"
               data-target="#bars">
                <i class="fa fa-plus fa-3x orange" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <hr class="round)">


    <!-- Modal DRANKEN-->
    <div class="modal fade" id="dranken" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose a drink</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>

                </div>
                <div class="container"><h6>Or create a <a href="newdrink.php" style="color: #CD5727">new one <i
                                    class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></h6></div>

                <div class="modal-body container">
                    <h2 class="col-12 text-center">Hot drinks</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($drinks as $drink) { ?>
                            <?php
                            if ($drink['soort'] == 0) { ?>
                                <form method="POST" action="checkin.php?action=updatedrink" class="col-4 ">
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
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
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
                                <form method="POST" action="checkin.php?action=updatedrink" class="col-4">
                                    <div class="choose">
                                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid "
                                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>"
                                             height="2000">
                                    </div>
                                    <p class="text-center"><?php echo $drink['naam'] ?>
                                        <input type="text" name="drankid" value="<?php echo $drink['drankID'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="drinkz">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
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
                                <form method="POST" action="checkin.php?action=updatedrink" class="col-4">
                                    <div class="choose">
                                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid "
                                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>"
                                             height="2000">
                                    </div>
                                    <p class="text-center"><?php echo $drink['naam'] ?>
                                        <input type="text" name="drankid" value="<?php echo $drink['drankID'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="drinkz">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
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
                                <form method="POST" action="checkin.php?action=updatedrink" class="col-4">
                                    <div class="choose">
                                        <img src="<?php echo $drink['image'] ?>" class="rounded-circle img-fluid "
                                             alt="<?php echo $drink['naam'] ?>" name="<?php echo $drink['drankID'] ?>"
                                             height="2000">
                                    </div>
                                    <p class="text-center"><?php echo $drink['naam'] ?>
                                        <input type="text" name="drankid" value="<?php echo $drink['drankID'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="drinkz">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
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


    <!-- Modal GROUPS-->
    <div class="modal fade" id="group" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chooce a group</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>

                </div>
                <div class="container"><h6>Or create a <a href="newgroup.php" style="color: #CD5727">new one <i
                                    class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></h6></div>

                <div class="modal-body">
                    <form method="POST" action="checkin.php?action=updategroup" class="col-12">
                        <select class="form-control" name="group">
                            <option value="">Choose group you want to join</option>
                            <?php foreach ($groepen as $groep) {
                                ?>
                                <option value="<?php echo $groep['groepID'] ?>"><?php echo $groep['groepnaam'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success" name="drinkz">
                            Add me to this group <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal BARS-->
    <div class="modal fade" id="bars" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose a bar</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>

                </div>
                <div class="container"><h6>Or create a <a href="newbar.php" style="color: #CD5727">new one <i
                                    class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></h6></div>

                <div class="modal-body">

                    <h2 class="col-12">Cosy bars</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($bars as $bar) { ?>
                            <?php
                            if ($bar['type'] == 0) { ?>
                                <form method="POST" action="checkin.php?action=updatebar" class="col-4">
                                    <div class="choose">
                                        <img src="<?php echo $bar['image'] ?>" class="rounded-circle img-fluid"
                                             alt="<?php echo $bar['naam'] ?>" name="<?php echo $bar['barid'] ?>">
                                    </div>
                                    <p class="text-center"><?php echo $bar['naam'] ?>
                                        <input type="text" name="barid" value="<?php echo $bar['barid'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="bar">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <h2 class="col-12">Coffee bar</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($bars as $bar) { ?>
                            <?php
                            if ($bar['type'] == 1) { ?>
                                <form method="POST" action="checkin.php?action=updatebar" class="col-4">
                                    <div class="choose">
                                        <img src="<?php echo $bar['image'] ?>" class="rounded-circle img-fluid"
                                             alt="<?php echo $bar['naam'] ?>" name="<?php echo $bar['barid'] ?>">
                                    </div>
                                    <p class="text-center"><?php echo $bar['naam'] ?>
                                        <input type="text" name="barid" value="<?php echo $bar['barid'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="bar">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <h2 class="col-12">Tea room</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($bars as $bar) { ?>
                            <?php
                            if ($bar['type'] == 2) { ?>
                                <form method="POST" action="checkin.php?action=updatebar" class="col-4">
                                    <div class="choose">
                                        <img src="<?php echo $bar['image'] ?>" class="rounded-circle img-fluid"
                                             alt="<?php echo $bar['naam'] ?>" name="<?php echo $bar['barid'] ?>">
                                    </div>
                                    <p class="text-center"><?php echo $bar['naam'] ?>
                                        <input type="text" name="barid" value="<?php echo $bar['barid'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="bar">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <h2 class="col-12">Student bar</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($bars as $bar) { ?>
                            <?php
                            if ($bar['type'] == 3) { ?>
                                <form method="POST" action="checkin.php?action=updatebar" class="col-4">

                                    <div class="choose">
                                        <img src="<?php echo $bar['image'] ?>" class="rounded-circle img-fluid"
                                             alt="<?php echo $bar['naam'] ?>" name="<?php echo $bar['barid'] ?>">
                                    </div>
                                    <p class="text-center"><?php echo $bar['naam'] ?>
                                        <input type="text" name="barid" value="<?php echo $bar['barid'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="bar">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                    </p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <h2 class="col-12">Dance bar</h2>
                    <div class="row mt-4">
                        <?php
                        foreach ($bars as $bar) { ?>
                            <?php
                            if ($bar['type'] == 4) { ?>
                                <form method="POST" action="checkin.php?action=updatebar" class="col-4">
                                    <div class="choose">
                                        <img src="<?php echo $bar['image'] ?>" class="rounded-circle img-fluid"
                                             alt="<?php echo $bar['naam'] ?>" name="<?php echo $bar['barid'] ?>">
                                    </div>
                                    <p class="text-center"><?php echo $bar['naam'] ?>
                                        <input type="text" name="barid" value="<?php echo $bar['barid'] ?>"
                                               hidden>
                                        <br>
                                        <button type="submit" class="btn btn-success" name="bar">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
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

