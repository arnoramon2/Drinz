<?php
session_start();
$lastVisit = $_SERVER['HTTP_REFERER'];


if (stripos($lastVisit, 'profile.php') == true) {
    $naam = $_SESSION['login'];
    $locatie_map = "images\profile";
    $target_file = $locatie_map . basename($_FILES["drinkupload"]["name"]);

    $databaseName = $locatie_map . "\\" . $naam . ".jpg";

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        header("location: profile.php");
    } else {
        if (move_uploaded_file($_FILES["drinkupload"]["tmp_name"], "images/profile/" . $naam . ".jpg")) {
            header("location: profile.php");
        } else {
            header("location: profile.php");
        }

        $mysqli = new mysqli("localhost", "root", "usbw", "drinkz");
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $sql = "UPDATE tblgebruiker SET image = ? WHERE login = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $databaseName, $naam);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }




}

?>