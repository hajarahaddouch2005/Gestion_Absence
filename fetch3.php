<?php

    
$connect = new PDO("mysql:host=localhost;dbname=projet_gestion", "root", "");

if($_POST["query"] != '')
{

 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "
 SELECT * FROM stagiaire where Filiere=".$search_text."
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
                <td>
                <a href="deletestagiaire.php?id='.$row["id"].'" class="btn btn-success"><i class="fa fa-flag-o"></i>Delete</a></td>
        </tr>
  ';
 }
}
else
{
 $output .= '
 <tr>
  <td colspan="7" align="center">No Data Found</td>
 </tr>
 ';
}

echo $output;

?>