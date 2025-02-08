<?php

session_start();
    require "file/database.php";
    require "file/functions.php";


if(deleteseance($_GET["id"])):
    $_SESSION["message"] = "L'absence a était bien supprimer";
        header("Location: liste_seance.php");
        exit();
endif;

?>