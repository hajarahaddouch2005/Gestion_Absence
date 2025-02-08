<!DOCTYPE html>
<html lang="en">
<?php

session_start();
    require "file/database.php";
    require "file/functions.php";
$stagiaire = getEtudiant($_GET["id"]);
$nom_for=$_SESSION["nom"];
$heure = date("H")+1;
     $datee=date("Y-m-d");
     if (marquerRetard($_GET['id'], $datee, $_SESSION['nom'], $heure)) {

            $_SESSION["message"] = "Retard a été bien marquer";
            header("Location: compt_Formateur.php");
            exit();

        } else {
            $_SESSION["message"] = "Erreur lors de votre action, veuillez réessayer.";
           header("Location: compt_Formateur.php");
            exit();
        }
?>

