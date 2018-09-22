<?php require_once('php/config.php'); ?>
<?php require_once('php/api.php'); ?>
<?php

session_start();
if (empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    //PHP CODE HIER
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('php/shared/links.php'); ?>
    <title>Medals</title>
    <link rel="shortcut icon" href="images/icoon.ico" />
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <h1 class="text-center">My medals</h1>
    <hr class="round">
    <div class="row mt-4">
        <div  class="col-4"><img src="images/testmedal.png" class="rounded-circle img-fluid grayscale" alt="medal">
            <br>
        <p class="text-center">10 beers in one night</p></div>
        <div  class="col-4"><img src="images/testmedal.png" class="rounded-circle img-fluid" alt="medal">
            <p class="text-center">5 different beers</p></div>
        <div  class="col-4"><img src="images/testmedal.png" class="rounded-circle img-fluid" alt="medal">
            <p class="text-center">Visited 5 bars in one week</p></div>
    </div>
    <div class="row mt-4">
        <div  class="col-4"><img src="images/testmedal.png" class="rounded-circle img-fluid " alt="medal" width="100" height="100">
            <br>
            <p class="text-center">Went out 3 days in one week</p></div>
        <div  class="col-4"><img src="images/testmedal.png" class="rounded-circle img-fluid grayscale" alt="medal">
            <p class="text-center">3 different drinks in one night</p></div>
        <div  class="col-4"><img src="images/testmedal.png" class="rounded-circle img-fluid" alt="medal">
            <p class="text-center">10 beers</p></div>
    </div>
    <hr class="round">
</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

