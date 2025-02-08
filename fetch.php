<?php

//fetch.php

$connect = new PDO("mysql:host=localhost;dbname=projet_gestion", "root", "");

if($_POST["query"] != '')
{
 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "
 SELECT * FROM stagiaire 
 WHERE Filiere=".$search_text." 
 ";
}
else
{
 $query = "SELECT * FROM stagiaire ";
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
  $output .= '
  <tr>
   <td>'.$row["nom"].'</td>
   <td>'.$row["prenom"].'</td>
   <td>'.$row["CIN"].'</td>
   <td>'.$row["Filiere"].'</td>
   <td><a href="Detail2.php?id='.$row["id"] .'" class="btn btn-danger"><i class="fa fa-flag-o"></i>Detail</a></td>
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

?>