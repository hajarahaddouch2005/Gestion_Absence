<?php

session_start();
    require "file/database.php";
    require "file/functions.php";


if(deleteStagiaire($_GET["id"])):
    $_SESSION["message"] = "Stagaire a était bien supprimer";
        header("Location: liste_stag.php");
        exit();
endif;

?>