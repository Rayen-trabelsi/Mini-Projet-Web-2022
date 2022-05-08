<?php

// Create connection
$conn = mysqli_connect("localhost", "root", "", "gestion_etudiant");
$sql = "SELECT * FROM etudiant WHERE prenom LIKE '%".$_POST['name']."%'
                                      OR cin LIKE '%".$_POST['name']."%'
									  OR nom LIKE '%".$_POST['name']."%' ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
	while ($row=mysqli_fetch_assoc($result)) {
		echo "	<tr>
		          <td>".$row['cin']."</td>
		          <td>".$row['nom']."</td>
		          <td>".$row['prenom']."</td>
		          <td>".$row['email']."</td>
				  <td>".$row['Classe']."</td>
				
		        </tr>";
	}
}
else{
	echo "<tr><td>0 result's found</td></tr>";
}

?>