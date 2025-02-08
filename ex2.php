<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "projet_gestion");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM stagiaire";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Nom</th>  
                         <th>prenom</th>  
                         <th>CIN</th>  
      
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["nom"].'</td>  
                         <td>'.$row["prenom"].'</td>  
                         <td>'.$row["CIN"].'</td>  
       
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>
