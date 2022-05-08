<?php

include "connexion.php";
if($_POST["query"] != '')
{
 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = " SELECT * FROM etudiant WHERE Classe IN (".$search_text.") ";
}
else
{
 $query = "SELECT * FROM etudiant";
}

$statement = $pdo->prepare($query);

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
   <td>'.$row["cin"].'</td>
   <td>'.$row["nom"].'</td>
   <td>'.$row["prenom"].'</td>
   <td>'.$row["email"].'</td>
   <td>'.$row["Classe"].'</td>
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