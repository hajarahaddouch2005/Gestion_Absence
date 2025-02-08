<!DOCTYPE html>
<html lang="en">

<?php

    session_start();
    require "file/database.php";
    require "file/functions.php";
    $stagiaire = getEtudiant($_GET["id"]);
    $_SESSION['bn'] = $stagiaire["nom"]; 
    $_SESSION['cn'] = $stagiaire["prenom"]; 
    $_SESSION['dn'] = $stagiaire["CIN"]; 
    $_SESSION['idd'] = $_GET["id"]; 
$tt=getnoann($_GET["id"]);
        $nom=$_SESSION["nom"];


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
                            <img class="rounded-circle" src="../assets/img/user.jpg" width="24" >
                            <span class="status online"></span>
                        </span>
                        <span><?=$nom?></span>
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
                            <a href="compt_gestionnaire.php"><i class="fa fa-dashboard"></i> <span>Table De Bord</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Stagiaire : <?= $stagiaire["nom"] ?> <?= $stagiaire["prenom"] ?></h3></div>
                <div class="panel-body">
                    <h4>CIN : <?=$stagiaire["CIN"] ?></h4>
                    <h4>Nombre Absence Ce Annee : <?=$tt["bb"] ?></h4>

                    <hr>
                      </div>
                    </div>
                    <label>Search by Month</label>
   <select id="multi_search_filter" class="form-control" style="width:500px"  name="multi_search_filter" >
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>

</select>
<label>Search by Jours</label>
<input type="Date" name="dee" class="form-control" id="dee" >

<input type="hidden" name="hidden_country" id="hidden_country" />
<input type="hidden" name="hidden_d" id="hidden_d" />

   <div style="clear:both"></div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>Date Absence</th>
       <th>Horaire</th>
       <th>Type Absence</th>
       <th>Formateur</th>
       <th>Etat</th>
      </tr>
     </thead>
     <tbody>
     </tbody>
    </table>

               




<form method="post" action="exe.php">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>

                </div> 

            </div>
        </div>
    </div>
       </div>
       </div>
       </div>
     <script>
$(document).ready(function(){

 load_data();
 
 function load_data(query='')
 {
  $.ajax({
   url:"in.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('tbody').html(data);
   }
  })
 }

 $('#multi_search_filter').change(function(){
  $('#hidden_country').val($('#multi_search_filter').val());
  var query = $('#hidden_country').val();
  load_data(query);
 });
 $('#dee').change(function(){
  $('#hidden_d').val($('#dee').val());
  var query = $('#hidden_d').val();
  load_data(query);
 });
 
});
</script>       

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