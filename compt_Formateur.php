<!DOCTYPE html>
<html lang="en">

<?php
session_start();
    require "file/database.php";
    require "file/functions.php";
    $nom=$_SESSION["nom"];
    $fi=listfr($nom);
    
    $heure = date("H")+1;
    $st=Seance($nom,date("Y-m-d"),$heure);           
           

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/OFPPT.png">
    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                    <img src="assets/img/OFPPT.png" width="35" height="35" alt=""> <span></span>
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
                                    <a href="Alert2.php">
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
                            <a href="Alert2.php">View all Notifications</a>
                        </div>
                    </div>
                </li>
               
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="../assets/img/user.jpg" width="24" >
                            <span class="status online"></span>
                        </span>
                        <span><?= $nom  ?> </span>
                    </a>
                    <div class="dropdown-menu">
                        
                        <a class="dropdown-item" href="login2.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    
                    <a class="dropdown-item" href="login2.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="compt_Formateur.php"><i class="fa fa-dashboard"></i> <span>Stagiaire</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
         <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                           <div class="panel panel-default">
                            <?php foreach($st as $a): ?>
                            
                              <div class="panel-heading"><h4>Date_Seance : <?= $a["1"] ?></h4></div>
                                  <div csslass="panel-body">
                                      <h4>Date_Debut :  <?= $a["2"] ?></h4>
                                      <h4>Date_Fin :  <?= $a["3"] ?></h4>
                             <?php endforeach; ?>
                                     <?php foreach($fi as $f): ?>
                                   
                                      <h4>Filiere :  <?= $f["1"] ?> </h4>
                                  
                          
       
                                  </div>
                                </div>
                            </div>
<table class="table">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>CNI</th>
            <th>Filier</th>
            <th>Action</th>
        </tr>
        <?php foreach(Liste($f["1"]) as $a): ?>
            <tr>
                <td><?=$a["1"] ?></td>
                <td><?=$a["2"] ?></td>
                <td><?=$a["3"] ?></td>
                <td><?=$a["4"] ?></td>

                <td><a href="marquer_absence.php?id=<?=$a["0"] ?>" class="btn btn-danger">Absence</a>              <a href="marquer_present.php?id=<?=$a["0"] ?>" class="btn btn-success">Present</a>        <a href="marquer_retard.php?id=<?=$a["0"] ?>" class="btn btn-info">En Retard</a></td>
            </tr>
        <?php endforeach; ?><?php endforeach; ?>
    </table>
                </div>
                
    
    
</div>
        </div>
                    </div>   

            

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