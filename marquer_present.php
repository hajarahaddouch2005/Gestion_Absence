<!DOCTYPE html>
<html lang="en">
<?php

session_start();
    require "file/database.php";
    require "file/functions.php";
$stagiaire = getEtudiant($_GET["id"]);
$nom_for=$_SESSION["nom"];
 $heure = date("H")+1;
$nom_for=$_SESSION["nom"];
     $datee=date("Y-m-d");

if (marquerPresent($_GET['id'], $heure, $_SESSION['nom'], $datee)) {

            $_SESSION["message"] = "Present a été bien marquer";
            header("Location: compt_Formateur.php");
            exit();

        } else {
            $_SESSION["message"] = "Erreur lors de votre action, veuillez réessayer.";
            header("Location: compt_Formateur.php");
            exit();
        }
?>

