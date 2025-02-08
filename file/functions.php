<?php

/* functions */


/* Connexion a la base donnée */
function database()
{

    /* Base donnée */
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "projet_gestion";

    $db = new PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password,
        array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT
        )
    );

    return $db;

}


/* Connexion */

function connexion($username, $password)
{

    /* se connecter a la base de donnée */
    $db = database();

    $sttm = $db->prepare("SELECT * FROM utilisateur WHERE login = :login AND password = :password");
    $sttm->bindParam(':login', $username);
    $sttm->bindParam(':password', $password);

    if ($sttm->execute()) {
        $user = $sttm->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            extract($user);
            $_SESSION["id"] = $id;
            $_SESSION["login"] = $login;
            $_SESSION["type"] = $type;

            switch ($type) {
                case "directeur":
                    $sttm2 = $db->prepare("SELECT * FROM directeur WHERE id_user = :id");
                    $sttm2->bindParam(':id', $id);
                    if ($sttm2->execute()):
                        $directeur = $sttm2->fetch(PDO::FETCH_ASSOC);
                        extract($directeur);
                        $_SESSION["nom"] = $nom;
                        $_SESSION["prenom"] = $prenom;
                        $_SESSION["matricule"] = $matricule;
                    endif;
                    break;

                case "formateur":
                    $sttm2 = $db->prepare("SELECT * FROM formateur WHERE id_user = :id");
                    $sttm2->bindParam(':id', $id);
                    if ($sttm2->execute()):
                        $formateur = $sttm2->fetch(PDO::FETCH_ASSOC);
                        extract($formateur);
                        $_SESSION["nom"] = $nom;
                        $_SESSION["prenom"] = $prenom;
                        $_SESSION["matricule"] = $matricule;
                    endif;
                    break;
                     case "gestionnaire":
                    $sttm2 = $db->prepare("SELECT * FROM gestionnaire WHERE id_user = :id");
                    $sttm2->bindParam(':id', $id);
                    if ($sttm2->execute()):
                        $gestionnaire = $sttm2->fetch(PDO::FETCH_ASSOC);
                        extract($gestionnaire);
                        $_SESSION["nom"] = $nom;
                        $_SESSION["prenom"] = $prenom;
                        $_SESSION["matricule"] = $matricule;
                    endif;
                    break;

            }


            return true;
        } else {
            return false;
        }
    }

    return false;

}
function reglage($username, $password)
{

    /* se connecter a la base de donnée */
    $db = database();

    $sttm = $db->prepare("SELECT * FROM utilisateur WHERE login = :login AND password = :password");
    $sttm->bindParam(':login', $username);
    $sttm->bindParam(':password', $password);

    if ($sttm->execute()) {
        $user = $sttm->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            extract($user);
            $_SESSION["id"] = $id;
            $_SESSION["login"] = $login;
            $_SESSION["type"] = $type;

            switch ($type) {
                case "directeur":
                    header("Location: compt_directeur2.php");
                    break;

                case "formateur":
                    header("Location: compt_formateur.php");
                    break;
                     case "gestionnaire":
                    header("Location: compt_gestionnaire.php");
                    break;

            }


            return true;
        } else {
            return false;
        }
    }

    return false;

}
/* Inscription */

function inscription($login, $password, $type)
{

    $db = database();

    $sttm = $db->prepare("INSERT INTO utilisateur (login, password, type) VALUE (:login, :password, :type)");
    $sttm->bindParam(':login', $login);
    $sttm->bindParam(':password', $password);
    $sttm->bindParam(':type', $type);

    $sttm->execute();

    $id = $db->lastInsertId();


    return $id;

}

/* Inscription étudiant */
function inscriptionformateur($id_user, $nom,$prenom, $matricule)
{

    $db = database();

    $sttm = $db->prepare("INSERT INTO formateur (id_user, nom, prenom, matricule) VALUE (:id_user, :nom, :prenom, :matricule)");

    $sttm->bindParam(':id_user', $id_user);
    $sttm->bindParam(':nom', $nom);
    $sttm->bindParam(':prenom', $prenom);
    $sttm->bindParam(':matricule', $matricule);

    if ($sttm->execute()) {
        return true;
    }

    return false;

}


/* Inscription Professeur */


function inscriptiondirecteur($id_user, $nom,$prenom, $matricule)
{

    $db = database();

    $sttm = $db->prepare("INSERT INTO directeur (id_user, nom, prenom, matricule) VALUE (:id_user, :nom, :prenom, :matricule)");

    $sttm->bindParam(':id_user', $id_user);
    $sttm->bindParam(':nom', $nom);
    $sttm->bindParam(':prenom', $prenom);
    $sttm->bindParam(':matricule', $matricule);

    if ($sttm->execute()) {
        return true;
    }

    return false;

}
function inscriptiongestionnaire($id_user, $nom,$prenom, $matricule)
{

    $db = database();

    $sttm = $db->prepare("INSERT INTO gestionnaire (id_user, nom, prenom, matricule) VALUE (:id_user, :nom, :prenom, :matricule)");

    $sttm->bindParam(':id_user', $id_user);
    $sttm->bindParam(':nom', $nom);
    $sttm->bindParam(':prenom', $prenom);
    $sttm->bindParam(':matricule', $matricule);

    if ($sttm->execute()) {
        return true;
    }

    return false;

}


function marquerAbsence($stagiaire, $crn_horaire, $formateur, $date_absence)
{

        $db2 = database();

        $sttm2 = $db2->prepare("SELECT * FROM presence where id_stag= :id_stag and date_presence= :datee and crn_horaire= :crn_horaire and formateur= :formateur");
        $sttm2->bindParam(':id_stag', $stagiaire);
        $sttm2->bindParam(':crn_horaire', $crn_horaire);
        $sttm2->bindParam(':formateur', $formateur);
        $sttm2->bindParam(':datee', $datee);

        if ($sttm2->execute()) {
        $db3 = database();

        $sttm3 = $db3->prepare("DELETE FROM presence WHERE id_stag= :id_stag and date_presence= :datee and crn_horaire= :crn_horaire and formateur= :formateur");
        $sttm2->bindParam(':id_stag', $stagiaire);
        $sttm2->bindParam(':crn_horaire', $crn_horaire);
        $sttm2->bindParam(':formateur', $formateur);
        $sttm2->bindParam(':datee', $datee);

        $sttm3->execute();
       
        }
        $db = database();

         $sttm = $db->prepare("INSERT INTO absence (id_stag, crn_horaire,date_absence,formateur) VALUE (:id_stag, :crn_horaire, :date_absence, :formateur)");

    $sttm->bindParam(':id_stag', $stagiaire);
    $sttm->bindParam(':crn_horaire', $crn_horaire);
    $sttm->bindParam(':formateur', $formateur);
    $sttm->bindParam(':date_absence', $date_absence);


        if ($sttm->execute()) {
         return true;
        }else{
         return false;

        }


   

}

function marquerAutorisation($stagiaire, $crn_horaire, $type, $formateur, $datee)
{
        $db2 = database();

        $sttm2 = $db2->prepare("SELECT * FROM autorisation where id_stag= :id_stag and date_aut= :datee and crn_horaire= :crn_horaire and formateur= :formateur");
        $sttm2->bindParam(':id_stag', $stagiaire);
        $sttm2->bindParam(':crn_horaire', $crn_horaire);
        $sttm2->bindParam(':formateur', $formateur);
        $sttm2->bindParam(':datee', $datee);

        if ($sttm2->execute()) {
        $db3 = database();

        $sttm3 = $db3->prepare("UPDATE autorisation SET type_au=:type WHERE id_stag= :id_stag and date_au= :datee and crn_horaire= :crn_horaire and formateur= :formateur");
        $sttm2->bindParam(':id_stag', $stagiaire);
        $sttm2->bindParam(':crn_horaire', $crn_horaire);
        $sttm2->bindParam(':formateur', $formateur);
        $sttm->bindParam(':type', $type);

        $sttm2->bindParam(':datee', $datee);

        $sttm3->execute();
       
        }
    $db = database();

    $sttm = $db->prepare("INSERT INTO autorisation (id_stag,date_aut, crn_horaire,formateur,type_au) VALUE (:id_stag, :datee, :crn_horaire, :formateur, :type)");

    $sttm->bindParam(':id_stag', $stagiaire);
    $sttm->bindParam(':crn_horaire', $crn_horaire);
    $sttm->bindParam(':type', $type);
    $sttm->bindParam(':formateur', $formateur);
    $sttm->bindParam(':datee', $datee);


    if ($sttm->execute()) {
        return true;
    }

    return false;


}

if (isset($_POST["marquer-Etat"])) {

    if (!empty($_POST["type"]) 
    ) {

        $db3 = database();

        $sttm3 = $db3->prepare("UPDATE absence SET type_absence=:type where id=:id");
        $sttm3->bindParam(':id', $_SESSION["idjus"]);
       
        $sttm3->bindParam(':type', $type);

      if( $sttm3->execute()){
        header("Location: compt_gestionnaire.php");
      }
    } else {
        $_SESSION["message"] = "Vous avez laisser des champs vides !";
        header("Location: compt_gestionnaire.php");
        exit();
    }

}
function getAbs($id){
    $ab=[];
    $db=database();
    $sttm=$db->prepare("SELECT * FROM absence WHERE id=:id");
    $sttm->bindParam(':id',$id);
    if ( $sttm->execute()){
        $ab=$sttm->fetchAll();
        return $ab;
    }
    return $ab;
}









function marquerPresent($stagiaire, $crn_horaire,$formateur, $datee)
{       $db2 = database();

        $sttm2 = $db2->prepare("SELECT * FROM absence where id_stag= :id_stag and date_absence= :datee and crn_horaire= :crn_horaire and formateur= :formateur");
        $sttm2->bindParam(':id_stag', $stagiaire);
        $sttm2->bindParam(':crn_horaire', $crn_horaire);
        $sttm2->bindParam(':formateur', $formateur);
        $sttm2->bindParam(':datee', $datee);

        if ($sttm2->execute()) {
        $db3 = database();

        $sttm3 = $db3->prepare("DELETE FROM absence WHERE id_stag= :id_stag and date_absence= :datee and crn_horaire= :crn_horaire and formateur= :formateur");
        $sttm2->bindParam(':id_stag', $stagiaire);
        $sttm2->bindParam(':crn_horaire', $crn_horaire);
        $sttm2->bindParam(':formateur', $formateur);
        $sttm2->bindParam(':datee', $datee);

        $sttm3->execute();
       
        }
        $db = database();

        $sttm = $db->prepare("INSERT INTO presence (id_stag,date_presence,crn_horaire,formateur) VALUE (:id_stag, :datee, :crn_horaire, :formateur)");

        $sttm->bindParam(':id_stag', $stagiaire);
        $sttm->bindParam(':crn_horaire', $crn_horaire);
        $sttm->bindParam(':formateur', $formateur);
        $sttm->bindParam(':datee', $datee);


        if ($sttm->execute()) {
         return true;
        }else{
         return false;

        }
        
    //return false;        
}


function marquerRetard($stagiaire, $crn_horaire,$formateur, $datee)
{

    $db = database();

    $sttm = $db->prepare("INSERT INTO retard (id_stag,date_Retad,formateur,crn_horaire) VALUE (:id_stag, :datee, :formateur, :crn_horaire)");

    $sttm->bindParam(':id_stag', $stagiaire);
    $sttm->bindParam(':crn_horaire', $crn_horaire);
    $sttm->bindParam(':formateur', $formateur);
    $sttm->bindParam(':datee', $datee);


    if ($sttm->execute()) {
        return true;
    }else{

    return false;
   }

}
/* Marquer l'absence */


if (isset($_POST["marquer-Retard"])) {

    if (!empty($_POST["nom_for"]) && !empty($_POST["date_r"])
        && !empty($_POST["crn_horaire"])
    ) {


        if (marquerRetard($_POST['id'], $_POST["crn_horaire"], $_SESSION['nom'], $_POST['date_r'])) {

            $_SESSION["message"] = "Retard a été bien marquer";
            header("Location: compt_Formateur.php");
            exit();

        } else {
            $_SESSION["message"] = "Erreur lors de votre action, veuillez réessayer.";
           header("Location: compt_Formateur.php");
            exit();
        }


    } else {
        $_SESSION["message"] = "Vous avez laisser des champs vides !";
        header("Location: compt_Formateur.php");
        exit();
    }

}



if (isset($_POST["marquer-Autorisation"])) {

    if (!empty($_POST["nom_for"]) && !empty($_POST["datee"])
        && !empty($_POST["crn_horaire"]) && !empty($_POST["type"])
    ) {


        if (marquerAutorisation($_POST['id'], $_POST["crn_horaire"], $_POST["type"], $_SESSION['nom'], $_POST['datee'])) {

            $_SESSION["message"] = "Autorisation a été bien marquer";
            header("Location: compt_Formateur.php");
            exit();

        } else {
            $_SESSION["message"] = "Erreur lors de votre action, veuillez réessayer.";
            header("Location: compt_Formateur.php");
            exit();
        }


    } else {
        $_SESSION["message"] = "Vous avez laisser des champs vides !";
        header("Location: compt_Formateur.php");
        exit();
    }

}
if (isset($_POST["marquer-Autorisation2"])) {

    if (!empty($_POST["nom_for"]) && !empty($_POST["datee"])
        && !empty($_POST["crn_horaire"]) && !empty($_POST["type"])
    ) {


        if (marquerAutorisation($_POST['id'], $_POST["crn_horaire"], $_POST["type"], $_SESSION['nom'], $_POST['datee'])) {

            $_SESSION["message"] = "Autorisation a été bien marquer";
            header("Location: Alert.php");
            exit();

        } else {
            $_SESSION["message"] = "Erreur lors de votre action, veuillez réessayer.";
            header("Location: Alert.php");
            exit();
        }


    } else {
        $_SESSION["message"] = "Vous avez laisser des champs vides !";
        header("Location: Alert.php");
        exit();
    }

}

if (isset($_POST["seance"])) {
            $db = database();



    if (!empty($_POST["datez"]) && !empty($_POST["heur_deb"])
        && !empty($_POST["heur_fin"]) && !empty($_POST["Form"]))
     {

    $sttm = $db->prepare("INSERT INTO seance (datee, date_debut, date_fin, formateur) VALUE (:datez,:heur_deb,:heur_fin,:Form)");

    $sttm->bindParam(':datez', $_POST["datez"]);
    $sttm->bindParam(':heur_deb', $_POST["heur_deb"]);
    $sttm->bindParam(':heur_fin', $_POST["heur_fin"]);
    $sttm->bindParam(':Form', $_POST["Form"]);

    if ($sttm->execute()) {
            $_SESSION["message"] = "Ajouer avec seccusful !";
    }else{
                    $_SESSION["message"] = " Error";

    }
        

}}




if (isset($_POST["ajouterstag"])) {
    


    if (!empty($_POST["nomS"]) && !empty($_POST["prenomS"])
        && !empty($_POST["CIN"]) && !empty($_POST["Filiere"]))
     {
        $db = database();

    $sttm = $db->prepare("INSERT INTO stagiaire (nom, prenom, CIN, Filiere) VALUE (:nomS,:prenomS,:CIN,:Filiere)");

    $sttm->bindParam(':nomS', $_POST["nomS"]);
    $sttm->bindParam(':prenomS', $_POST["prenomS"]);
    $sttm->bindParam(':CIN', $_POST["CIN"]);
    $sttm->bindParam(':Filiere', $_POST["Filiere"]);

    if ($sttm->execute()) {
            $_SESSION["message"] = "Ajouer avec seccusful !";
    }else{
                    $_SESSION["message"] = " Error";

    }
        

}}
/* Connexion */

if (isset($_POST["connexion"])) {

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (connexion($username, $password)) {
            $_SESSION["message"] = "vous êtes maintenant Connecté !";
            reglage($username, $password);
            exit();
        } else {
            $_SESSION["message"] = "Mot de pass / username Invalid !";
        }

    }

}


/* Inscription */
if (isset($_POST['signup'])) {

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["type"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["matricule"])) {


            $id_user = null;
            $id_user = inscription($_POST["username"], $_POST["password"], $_POST["type"]);

            if ($id_user != null) {
                if ($_POST["type"] == "formateur") {


                    if (inscriptionformateur($id_user, $_POST["nom"], $_POST["prenom"], $_POST["matricule"])) {

                        $_SESSION["message"] = "Vous êtes maintenant inscrit ! merci de  utilisant votre username et mot de passe";
                        header("Location: login2.php");
                        exit();
                    }

                } elseif ($_POST["type"] == "directeur") {

                    if (inscriptiondirecteur($id_user, $_POST["nom"], $_POST["prenom"], $_POST["matricule"])) {
                        $_SESSION["message"] = "Vous êtes maintenant inscrit ! merci de  utilisant votre username et mot de passe";
                        header("Location: login2.php");
                        exit();
                    }

                } elseif ($_POST["type"] == "gestionnaire") {

                    if (inscriptiongestionnaire($id_user, $_POST["nom"], $_POST["prenom"], $_POST["matricule"])) {
                        $_SESSION["message"] = "Vous êtes maintenant inscrit ! merci de  utilisant votre username et mot de passe";
                        header("Location: login2.php");
                        exit();
                    }
                }

            } else {

                $_SESSION["message"] = "Erreur lors de votre action, veuillez réessayer.";

            }

    } else {
        $_SESSION["message"] = "Vous avez laisser des champs vides !";
    }


}

function listfr($nom)
{

    $fl = [];

    $db = database();

    $sttm = $db->prepare("SELECT * FROM filiere where formateur=:nom ORDER BY RAND( ) LIMIT 1");
    $sttm->bindParam(':nom', $nom);
    if ($sttm->execute()) {
        $fl = $sttm->fetchAll();
        return $fl;
    }

    return $fl;
}

function listformateur()
{

    $formateur = [];

    $db = database();

    $sttm = $db->prepare("SELECT * FROM formateur");
    if ($sttm->execute()) {
        $formateur = $sttm->fetchAll();
        return $formateur;
    }

    return $formateur;
}
function Seance($for,$de,$heur)
{

    $formateur = [];

    $db = database();

    $sttm = $db->prepare("SELECT * FROM seance  where datee=:dt and formateur=:for and date_debut=:heur");
    $sttm->bindParam(':dt', $de);
    $sttm->bindParam(':for', $for);
    $sttm->bindParam(':heur', $heur);

    if ($sttm->execute()) {
        $formateur = $sttm->fetchAll();
        return $formateur;
    }else{
        return "aucun Seance at heur";
    }

    return $formateur;
}

function toutstag()
{

    $st = [];

    $db = database();

    $sttm = $db->prepare("SELECT * FROM stagiaire");
    if ($sttm->execute()) {
        $st = $sttm->fetchAll();
        return $st;
    }

    return $st;
}
function getnoann($id)
{
    $stag = [];

    $db = database();

    $sttm = $db->prepare("SELECT count(*) as bb from absence where id_stag=:id and year(date_absence) = year(Date(now()))");
    $sttm->bindParam(':id', $id);

    if ($sttm->execute()) {
        $stag = $sttm->fetch(PDO::FETCH_ASSOC);
        return $stag;
    }

    return $stag;
}
function getnombre($id,$dee)
{
    $stag = [];

    $db = database();

    $sttm = $db->prepare("SELECT count(*) as nb from absence where id_stag=:id and date_absence=:de");
    $sttm->bindParam(':id', $id);
    $sttm->bindParam(':de', $dee);

    if ($sttm->execute()) {
        $stag = $sttm->fetch(PDO::FETCH_ASSOC);
        return $stag;
    }

    return $stag;
}

function getEtudiant($id)
{
    $stag = "";

    $db = database();

    $sttm = $db->prepare("SELECT * FROM stagiaire where id=:id");
    $sttm->bindParam(':id', $id);
    if ($sttm->execute()) {
        $stag = $sttm->fetch(PDO::FETCH_ASSOC);
        return $stag;
    }

    return $stag;
}


function calculerAbsences($id)
{

    $nombreAbsences = 0;

    $db = database();

    $sttm = $db->prepare("SELECT count(id_etudiant) FROM absence where id_etudiant=:id and is_old=0 ");
    $sttm->bindParam(':id', $id);
    if ($sttm->execute()) {
        $nombreAbsences = $sttm->fetch(PDO::FETCH_ASSOC);
        return $nombreAbsences;
    }

    return $nombreAbsences;
}


function liststat()
{

    $sat = [];

    $db = database();

    $sttm = $db->prepare("SELECT * FROM stagiaire");
    if ($sttm->execute()) {
        $sat = $sttm->fetchAll();
        return $sat;
    }

    return $sat;

}



function Liste($fil){
$stag = [];
    $db = database();
    $sttm = $db->prepare("SELECT * FROM stagiaire where Filiere=:fil");
    $sttm->bindParam(":fil", $fil);
    if ($sttm->execute()) {

        $stag = $sttm->fetchAll();
        return $stag;

    }
    return $stag;
        
}
function listeStag(){
$stag = [];
$fil=$_POST["seleFil"];
if($fil==""){
    $db = database();
    $sttm = $db->prepare("SELECT * FROM stagiaire");

    if ($sttm->execute()) {

        $stag = $sttm->fetchAll();
        return $stag;

    }            

}else{
    $db = database();
    $sttm = $db->prepare("SELECT * FROM stagiaire where Filiere=:fil");
    $sttm->bindParam("fil", $fil);

    if ($sttm->execute()) {

        $stag = $sttm->fetchAll();
        return $stag;

    }
} 
return $stag;
}




function listeFormateur(){
$form = [];

    $db = database();

    $sttm = $db->prepare("SELECT * FROM formateur");
    
    if ($sttm->execute()) {

        $form = $sttm->fetchAll();
        return $form;

    }            

return $form;

}

function listeFil(){
$fil = [];

    $db = database();

    $sttm = $db->prepare("select DISTINCT(nom) from filiere");
    
    if ($sttm->execute()) {

        $fil = $sttm->fetchAll();
        return $fil;

    }            

return $fil;

}
function listeSeance(){
$fil = [];

    $db = database();

    $sttm = $db->prepare("select * from seance");
    
    if ($sttm->execute()) {

        $fil = $sttm->fetchAll();
        return $fil;

    }            

return $fil;

}




function listeAbsencehier(){
$fil1 = [];

    $db = database();

    $sttm = $db->prepare("SELECT stagiaire.nom,stagiaire.prenom,absence.date_absence,absence.crn_horaire,absence.formateur,absence.type_absence FROM absence,stagiaire where stagiaire.id=absence.id_stag and absence.date_absence=DATE(NOW())-1");
    
    if ($sttm->execute()) {

        $fil1 = $sttm->fetchAll();
        return $fil1;

    }            

return $fil1;

}
function listeRetardhier(){
$fil = [];

    $db = database();

    $sttm = $db->prepare("SELECT stagiaire.nom,stagiaire.prenom,retard.date_Retad,retard.formateur,retard.crn_horaire FROM retard,stagiaire where stagiaire.id=retard.id_stag and retard.date_Retad=DATE(NOW())-1 ");
    
    if ($sttm->execute()) {

        $fil = $sttm->fetchAll();
        return $fil;

    }            

return $fil;

}












function listeAbsent(){
$fil = [];

$a=$_POST["seleFil"];
if($a==""){
$db = database();

    $sttm = $db->prepare("SELECT stagiaire.nom,stagiaire.prenom,absence.* FROM `absence`,stagiaire where stagiaire.id=absence.id_stag ");
        $sttm->bindParam(":fil", $a);

    if ($sttm->execute()) {

        $fil = $sttm->fetchAll();
        return $fil;

    }      
}else{
    $db = database();

    $sttm = $db->prepare("SELECT stagiaire.nom,stagiaire.prenom,absence.* FROM `absence`,stagiaire where stagiaire.id=absence.id_stag and stagiaire.Filiere=:fil");
        $sttm->bindParam(":fil", $a);

    if ($sttm->execute()) {

        $fil = $sttm->fetchAll();
        return $fil;

    }            
}
return $fil;

}








/* Cette fonction permet de calculer le nombre des absences pour chaque étudiant */

function alertsAbsence()
{
    /* Tableau */
    $alerts = [];

    $db = database();

    $sttm = $db->prepare("SELECT count(*) from absence where date_absence=date('d/m/Y', mktime(0,0,0,date('m'), date('d')-1, date('Y')))");

    if ($sttm->execute()) {

        $alerts = $sttm->fetchAll();
        return $alerts;

    }

    return $alerts;


}


function deleteStagiaire($id)
{

    $db = database();

    $sttm = $db->prepare("DELETE FROM stagiaire WHERE id=:id");
    $sttm->bindParam(":id", $id);

    if ($sttm->execute()) {
        return true;
    } else {
        return false;
    }

}


function deleteseance($id)
{

    $db = database();

    $sttm = $db->prepare("DELETE FROM seance WHERE id=:id");
    $sttm->bindParam(":id", $id);

    if ($sttm->execute()) {
        return true;
    } else {
        return false;
    }

}
function deleteAbsence($id)
{

    $db = database();

    $sttm = $db->prepare("DELETE FROM absence WHERE id=:id");
    $sttm->bindParam(":id", $id);

    if ($sttm->execute()) {
        return true;
    } else {
        return false;
    }

}






