<!DOCTYPE html>
<html lang="en">

<?php
session_start();
    require "file/database.php";
    require "file/functions.php";
        $nom=$_SESSION["nom"];
$connect = new PDO("mysql:host=localhost;dbname=projet_gestion", "root", "");

$query = "SELECT stagiaire.id,stagiaire.nom,stagiaire.prenom,absence.date_absence,absence.crn_horaire,absence.formateur FROM absence,stagiaire where stagiaire.id=absence.id_stag and absence.date_absence=DATE(NOW())-1";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$query2 = "SELECT stagiaire.id,stagiaire.nom,stagiaire.prenom,retard.date_Retad,retard.formateur,retard.crn_horaire FROM retard,stagiaire where stagiaire.id=retard.id_stag and retard.date_Retad=DATE(NOW())-1";

$statement2 = $connect->prepare($query2);

$statement2->execute();

$result2 = $statement2->fetchAll();

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  
  <link href="css/bootstrap-select.min.css" rel="stylesheet" />
  <script src="js/bootstrap-select.min.js"></script>
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header" style="background-color:#295975">
            <div class="header-left">
                <a href="index-2.html" class="logo">
                    <img src="assets/img/logo.png" width="35" height="35" alt=""> <span></span>
                </a>
            </div>
            
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">*</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                
                                <li class="notification-message">
                                    <a href="Alert.php">
                                        <div class="media">
                      <span class="avatar">A</span>
                      <div class="media-body">

                        <p class="noti-details">

                          <span class="noti-title">
                        
                          </span>You Have ****** Notification<span class="noti-title">
                          </span>

                        </p>

                      </div>
                                        </div>
                                    </a>
                                </li>
                                
                                
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="Alert.php">View all Notifications</a>
                        </div>
                    </div>
                </li>
               
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="../assets/img/user.jpg" width="24">
                            <span class="status online"></span>
                        </span>
                        <span><?= $nom  ?></span>
                    </a>
                    <div class="dropdown-menu">

                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                   
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="compt_gestionnaire.php"><i class="fa fa-dashboard"></i> <span>Table De Bord</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title"></h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                    </div><h2 >Alerts</h2>
                </div>


                <div class="row">
                    <div class="col-md-12">
        <div class="container">    <h4>Absences Hier</h4>

   
   
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     
      <tr>
       <th>Nom</th>
       <th>prenom</th>
       <th>Date Absence</th>
       <th>Horaire</th>
       <th>Formateur</th>
       <th></th>
      </tr>
    <?php foreach($result as $a): ?>
            <tr>
                <td><?=$a["1"] ?></td>
                <td><?=$a["2"] ?></td>
                <td><?=$a["5"] ?></td>
                <td><?=$a["4"] ?></td>
                <td><?=$a["6"] ?></td>
                <td><?=$a["5"] ?></td>
                <td><a href="Autorisation2.php?id=<?=$a["0"] ?>" class="btn btn-danger"><i class="fa fa-flag-o"></i>Autorisation</a>
</tr>
<?php endforeach; ?>
    </table>
   </div>
   </div>
</div>
<div class="row">
                    <div class="col-md-12">
        <div class="container">    <h4>Retard Hier</h4>

   
   
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     
      <tr>
       <th>Nom</th>
       <th>prenom</th>
       <th>Date Absence</th>
       <th>Horaire</th>
       <th>Formateur</th>
       <th></th>
      </tr>
    <?php foreach($result2 as $b): ?>
            <tr>
                <td><?=$b["1"] ?></td>
                <td><?=$b["2"] ?></td>
                <td><?=$b["3"] ?></td>
                <td><?=$b["5"] ?></td>
                <td><?=$b["4"] ?></td>
                <td><a href="Autorisation2.php?id=<?=$b["0"] ?>" class="btn btn-danger"><i class="fa fa-flag-o"></i>Autorisation</a>

</tr>
<?php endforeach; ?>
    </table>
   </div>
   </div>
</div>
</div>
   <br />
   <br />
   <br />
  </div>
 </body>
</html>



               
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>

</body>



</html>