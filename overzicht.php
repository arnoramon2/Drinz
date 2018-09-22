<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>

<?php
session_start();
if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $overzichten = CallAPI("GET", $DB . "/tblheeftgedronken");
    $gebruikers = CallAPI("GET", $DB . "/tblgebruiker");
    $drinks = CallAPI("GET", $DB . "/tbldranken");
    foreach ($gebruikers as $gebruiker) {
        $id = $gebruiker['gebruikerid'];
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
    //print_r($id);
    //print($_SESSION['test2']);
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
    //print_r($result);
}
?>

    <!doctype html>
    <html lang="en">
    <head>
        <?php require_once('php/shared/links.php'); ?>
        <title>Profile</title>
        <link rel="shortcut icon" href="images/icoon.ico"/>
    </head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
    <!--HTML CODE-->

    <main class="container">
        <h1 class="text-center">Overview</h1>
        <hr class="round">


        <h2 class="text-center">Hot Drinks</h2>
        <div class="row mt-4">

            <?php
            foreach ($overzichten as $overzicht) {
                if ($overzicht['gebruikerid'] == $result) {
                    $a = findInArray($drinks, $overzicht['drankID'], 'drankID');
                    if ($drinks[$a]['soort'] == 0) {
                        //echo $drinks[$a]['image'];
                        ?>
                        <hr class="round">
                        <div class="col-4">
                            <div class="overzicht">
                                <img src="<?php echo $drinks[$a]['image'] ?>" alt="" class="rounded-circle img-fluid">
                            </div>
                            <p class="text-center"><?php echo $drinks[$a]['naam'] ?></p>
                        </div>

                        <?php
                    }
                }
            }
            ?>
        </div>
        <hr class="round">

        <h2 class="text-center">Soda</h2>
        <div class="row mt-4">
            <?php
            foreach ($overzichten as $overzicht) {
                if ($overzicht['gebruikerid'] == $result) {
                    $a = findInArray($drinks, $overzicht['drankID'], 'drankID');
                    if ($drinks[$a]['soort'] == 1) {
                        //echo $drinks[$a]['image'];
                        ?>
                        <hr class="round">
                        <div class="col-4">
                            <div class="overzicht">
                                <img src="<?php echo $drinks[$a]['image'] ?>" alt="" class="rounded-circle img-fluid">
                            </div>
                            <p class="text-center"><?php echo $drinks[$a]['naam'] ?></p>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <hr class="round">

        <h2 class="text-center">Beer</h2>
        <div class="row mt-4">
            <?php
            foreach ($overzichten as $overzicht) {
                if ($overzicht['gebruikerid'] == $result) {
                    $a = findInArray($drinks, $overzicht['drankID'], 'drankID');
                    if ($drinks[$a]['soort'] == 2) {
                        //echo $drinks[$a]['image'];
                        ?>
                        <hr class="round">
                        <div class="col-4">
                            <div class="overzicht">
                                <img src="<?php echo $drinks[$a]['image'] ?>" alt="" class="rounded-circle img-fluid">
                            </div>
                            <p class="text-center"><?php echo $drinks[$a]['naam'] ?></p>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <hr class="round">

        <h2 class="text-center">Cocktails / gin</h2>
        <div class="row mt-4">
            <?php
            foreach ($overzichten as $overzicht) {
                if ($overzicht['gebruikerid'] == $result) {
                    $a = findInArray($drinks, $overzicht['drankID'], 'drankID');
                    if ($drinks[$a]['soort'] == 3) {
                        //echo $drinks[$a]['image'];
                        ?>
                        <hr class="round">
                        <div class="col-4">
                            <div class="overzicht">
                                <img src="<?php echo $drinks[$a]['image'] ?>" alt="" class="rounded-circle img-fluid">
                            </div>
                            <p class="text-center"><?php echo $drinks[$a]['naam'] ?></p>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <hr class="round">

    </main>

    <!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>