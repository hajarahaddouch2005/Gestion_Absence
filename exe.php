
<?php 
session_start();
require "file/database.php";
    require "file/functions.php";
$output=$_SESSION['ou'];
$bn=$_SESSION['bn'];
$cn=$_SESSION['cn'];
$dn=$_SESSION['dn'];
$datet=$_SESSION['nbb'];
$nombre=getnombre($_SESSION['idd'],$datet);

$out='';

if(isset($_POST["export"]))
{
 $out.='<div class="panel-heading"><h3>Nom Stagiaire : '.$bn.'</h3></div>
                <div class="panel-body">
                    <h4>Prenom Stagaire : '.$cn.'</h4>
                    <h4>CIN : '.$dn.'</h4>
                    <h4>Nombre Absence: '.$nombre["nb"].' </h4>
                    <hr><br><br>';
 $out.= '
   <table class="table table-striped" border="1px solid" width="100%">  
       <tr>  
       <th>Date Absence</th>
       <th>Horaire</th>
       <th>Type Absence</th>
       <th>Formateur</th> 
      
       </tr>
  ';

  $out.=$output;
  $out .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $out;
 }


 ?>