

<?php

    
$connect = new PDO("mysql:host=localhost;dbname=projet_gestion", "root", "");

if($_POST["query"] != '')
{

 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "
 SELECT stagiaire.id,stagiaire.nom,stagiaire.prenom,absence.* FROM `absence`,stagiaire where stagiaire.id=absence.id_stag and stagiaire.Filiere=".$search_text."
 ";
}
else
{
 $query = "SELECT stagiaire.id,stagiaire.nom,stagiaire.prenom,absence.* FROM `absence`,stagiaire where stagiaire.id=absence.id_stag ";
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
            <td>'.$row["date_absence"].'</td>
            <td>'.$row["crn_horaire"].'</td>
            <td>'.$row["type_absence"].'</td>
            <td>'.$row["formateur"].'</td>
            <td><a href="deleteAbsence.php?id='.$row["id"].'"><i class="fa fa-trash-o"></i></a></td>
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