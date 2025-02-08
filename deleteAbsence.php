<?php

session_start();
    require "file/database.php";
    require "file/functions.php";


if(deleteAbsence($_GET["id"])):
    $_SESSION["message"] = "L'absence a était bien supprimer";
        header("Location: compt_Directeur2.php");
        exit();
endif;

?>