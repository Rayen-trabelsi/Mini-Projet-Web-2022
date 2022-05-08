<!--

// Create connection
$conn = mysqli_connect("localhost", "root", "", "gestion_etudiant");
$sql = "SELECT * FROM etudiant WHERE prenom LIKE '%".$_POST['name']."%'
                                      OR cin LIKE '%".$_POST['name']."%'
									  OR nom LIKE '%".$_POST['name']."%' ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)){
	while ($row=mysqli_fetch_assoc($result)) {
		echo '	<table><tr>
		          <td>'.$row['cin'].'</td>
		          <td>'.$row['nom'].'</td>
		          <td>'.$row['prenom'].'</td>
		          <td>'.$row['email'].'</td>
				  <td>'.$row['Classe'].'</td>
		    	  <td><button><a href="supprimerEtudiant.php".php">Supprimer</a></button></td>
		        </tr></table>';
	}
}
else{
	echo "<tr><td>0 result's found</td></tr>";
}

-->
<?php
include "connexion.php";
$pdoStat = $pdo->prepare("SELECT * FROM etudiant WHERE prenom LIKE '%".$_POST['name']."%'
OR cin LIKE '%".$_POST['name']."%'
OR nom LIKE '%".$_POST['name']."%' ");
$executeIsOk = $pdoStat->execute();
$etudiants= $pdoStat->fetchAll();

if ($etudiants!=[]) {
foreach ($etudiants as $etudiant):
	echo'<table><tr>
		          <td>'.$etudiant['cin'].'</td>
		          <td>'.$etudiant['nom'].'</td>
		          <td>'.$etudiant['prenom'].'</td>
		          <td>'.$etudiant['email'].'</td>
				  <td>'.$etudiant['Classe'].'</td>
		    	  <td><button class="btn btn-danger" ><a class="text-light" href="supprimer.php?cin='.$etudiant['cin'].'">Supprimer</a></button></td>
		        </tr></table>';
endforeach;
}
else{
	echo "<tr><td>0 result's found</td></tr>";
}
?>
