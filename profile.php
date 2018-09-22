<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>

<?php

session_start();

if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    $mysqli = new mysqli("localhost", "root", "usbw", "drinkz");
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $sql = "SELECT image FROM tblgebruiker WHERE login = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s',$_SESSION['login'] );
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $image = ($result);
    $stmt->close();
    }

    if (!$image){
        $image = "images/profile/default.jpg";
    }

?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Profile</title>
    <link rel="shortcut icon" href="images/icoon.ico" />
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <h1 class="text-center">
        <?php if (empty($_SESSION['login'])) { ?>
        <?php } else { ?>
            <a href="profile.php"><?php echo$_SESSION['login']; ?></a>
        <?php }; ?>
    </h1>
    <img src="<?php echo $image ?>" class="rounded-circle mx-auto d-block container" alt="profilepic">


    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to use as profile picture.
        <input lang="fr" type="file" name="drinkupload" id="drinkupload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <hr class="round">

    <h2 class="text-center">Medal showcase</h2>
    <div class="row margin-top-20 col-4">

        <div
        <a href="medals.php"><img src="images/testmedal.png" class="rounded-circle" alt="medal"> </a></div>
        <div  class="col-4"><a href="medals.php"><img src="images/testmedal.png" class="rounded-circle" alt="medal" width="110" height="80"> </a></div>
        <div  class="col-4"><a href="medals.php"><img src="images/testmedal.png" class="rounded-circle" alt="medal" width="110" height="80"> </a></div>
    </div>
    <hr class="round">
    <h2 class="text-center">Bar showcase</h2>
    <div class="row margin-top-20">
        <div  class="col-4"><a href="bars.php"><img src="images/testbar.png" class="rounded-circle" alt="medal" width="100" height="100"></a></div>
        <div  class="col-4"><a href="bars.php"><img src="images/testbar.png" class="rounded-circle" alt="medal" width="100" height="100"></a></div>
        <div  class="col-4"><a href="bars.php"><img src="images/testbar.png" class="rounded-circle" alt="medal" width="100" height="100"></a></div>
    </div>
    <hr class="round">
    <h2 class="text-center">Drinks showcase</h2>
    <div class="row margin-top-20">
        <div  class="col-4"><a href="drinks.php"><img src="images/testdrink.png" class="rounded-circle" alt="medal" width="100" height="100"></a></div>
        <div  class="col-4"><a href="drinks.php"><img src="images/testdrink.png" class="rounded-circle" alt="medal" width="100" height="100"></a></div>
        <div  class="col-4"><a href="drinks.php"><img src="images/testdrink.png" class="rounded-circle" alt="medal" width="100" height="100"></a></div>
    </div>
    <hr class="round">
</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

