<?php

    session_start();
$id=$_SESSION['idd'];

$connect = new PDO("mysql:host=localhost;dbname=projet_gestion", "root", "");

if($_POST["query"] != '')
{
  if(strlen($_POST["query"])>2){
    $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "
 SELECT * FROM absence 
 WHERE date_absence=".$search_text." and id_stag=".$id."
 ";
}
else
{
 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "
 SELECT * FROM absence 
 WHERE month(date_absence)=".$search_text." and id_stag=".$id."
 ";
}

}
else
{
 $query = "SELECT * FROM absence where id_stag=".$id." ";
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '';

if($total_row > 0)
{
 foreach($result as $row)
 {
  $_SESSION['nbb']=$row["date_absence"];
  $output .= '
  <tr>
   <td>'.$row["date_absence"].'</td>
   <td>'.$row["crn_horaire"].'</td>
   <td>'.$row["type_absence"].'</td>
   <td>'.$row["formateur"].'</td>
   <td><a href="Etat.php?id='.$row["id"] .'" class="btn btn-danger"><i class="fa fa-flag-o"></i>Etat</a></td>
  </tr>
  ';
 }
}
else
{
 $output .= '
 <tr>
  <td colspan="5" align="center">No Data Found</td>
 </tr>
 ';
}

echo $output;
$_SESSION['ou']=$output;

?>