
<!DOCTYPE html>
<html lang="en">
<?php
   session_start();
    require "file/database.php";
    require "file/functions.php";
    $fil=listeFil();
    $nom=$_SESSION["nom"];

?>

<!-- doctors23:12-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/OFPPT.png">
    <title></title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
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
                                    <a href="Alert3.php">
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
                            <a href="Alert3.php">View all Notifications</a>
                        </div>
                    </div>
                </li>
               
                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="../assets/img/user.jpg" width="40">
							<span class="status online"></span></span>
                        <span><?= $nom  ?></span>
                    </a>
					<div class="dropdown-menu">
						
						<a class="dropdown-item" href="login2.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
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
                        <li >
                            <a href="compt_Directeur2.php"><i class="fa fa-dashboard"></i> <span>Table De Bord</span></a>
                        </li>
                        <li class="active">
                            <a href="Stagaire.php"><i class="fa fa-user"></i> <span>Stagiaire</span></a>
                        </li>
                        <li>
                            <a href="seance.php"><i class="fa  fa-tasks"></i> <span>Seance</span></a>
                        </li>
                        
                    </ul>
                 </div>
             </div>
         </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">ADD Stagiaire</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="liste_stag.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Liste Stagaire</a>
                    
                    </div>
                </div>
				 <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                       <form action="Stagaire.php" method="POST" name="contact">

                    <form action="http://dreamguys.co.in/preclinic/template/index.html" class="form-signin">
                    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nomS" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" name="prenomS" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>CIN</label>
                            <input type="text"  name="CIN" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Filiere</label>
                            <select id="type" class="form-control" name="Filiere" >
                            <?php foreach($fil as $a): ?>
                            <option value="<?= $a["0"] ?>"><?= $a["0"] ?></option>
                            <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" name="ajouterstag" type="submit">Add</button>
                        </div>
                       </div></div></div></div>




                   </form>
                    </form>
                </div>
            </div>
         
				
            </div>
            
            </div>
        </div>
		<div id="delete_doctor" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Doctor?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- doctors23:17-->
</html>