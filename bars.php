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
    <title>Bars</title>
</head>
<body>
<?php require_once('php/shared/navigatie.php'); ?>
<!--HTML CODE-->

<main class="container">
    <h1 class="text-center">All bars</h1>
    <div class="col-12">
        <a href="newbar.php" class="center-block">
            <button type="submit" class="btn btn-success" style="width: 100%">
                Add a new bar
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
            </button>
        </a>
    </div>

    <hr class="round">
    <h2>Visited</h2>
    <div class="row mt-4">
        <div  class="col-4"><img src="images/bars/bar1.jpg" class="rounded-circle img-fluid" alt="drink"><p class="text-center">Den osse</p></div>
        <div  class="col-4"><img src="images/bars/coffeebar1.jpg" class="rounded-circle img-fluid" alt="drink"><p class="text-center">Coffeebar Tkofietjen</p></div>
        <div  class="col-4"><img src="images/bars/tearoom3.png" class="rounded-circle img-fluid" alt="drink"><p class="text-center">Tearoom Pannenkoek</p></div>
    </div>
    <div class="row mt-4">
        <div  class="col-4"><img src="images/bars/studentbar1.jpg" class="rounded-circle img-fluid" alt="drink"><p class="text-center">Op den hoek</p></div>
        <div  class="col-4"><img src="images/bars/dancebar1.jpg" class="rounded-circle img-fluid" alt="drink"><p class="text-center">Den dancing</p></div>
        <div  class="col-4"><img src="images/bars/studentbar2.jpg" class="rounded-circle img-fluid" alt="drink"><p class="text-center">De flesse</p></div>
    </div>
    <hr class="round">
    <h2>Not visited</h2>
    <div class="row mt-4">
        <div  class="col-4"><img src="images/bars/tearoom1.png" class="rounded-circle img-fluid grayscale" alt="drink"><p class="text-center">Tea room Koffietje</p></div>
        <div  class="col-4"><img src="images/bars/bar2.jpg" class="rounded-circle img-fluid grayscale" alt="drink"><p class="text-center">Bar Suzy</p></div>
        <div  class="col-4"><img src="images/bars/bar3.jpg" class="rounded-circle img-fluid grayscale" alt="drink"><p class="text-center">Bar Bar</p></div>
    </div>
    <div class="row mt-4">
        <div  class="col-4"><img src="images/bars/coffeebar2.jpeg" class="rounded-circle img-fluid grayscale" alt="drink"><p class="text-center">Coffeebar Tisier</p></div>
        <div  class="col-4"><img src="images/bars/coffeebar3.jpg" class="rounded-circle img-fluid grayscale" alt="drink"><p class="text-center">Coffeebar 't Lepelken</p></div>
        <div  class="col-4"><img src="images/bars/tearoom2.jpg" class="rounded-circle img-fluid grayscale" alt="drink"><p class="text-center">Tearoom Thee</p></div>
    </div>
    <hr class="round">
</main>

<!--HTML CODE-->
<?php require_once('php/shared/footer.php'); ?>

