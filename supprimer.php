<!--

 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
include("connexion.php");
if (isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];
    $sql="delete from etudiant where cin=$id";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        echo " deleted succefully";
        
    }else{
        die(mysqli_error($con));
    }
}
}

-->
<?php
include "connexion.php";
$pdoStat = $pdo->prepare( 'DELETE from etudiant WHERE cin=:num LIMIT 1');
$pdoStat->bindValue(':num', $_GET['cin'], PDO:: PARAM_INT);

$executeIsOK= $pdoStat->execute();
if ($executeIsOK) {
$message = "L'Etudiant a été supprimé";
header("location:afficherEtudiants.php");
}
else{
$message = "Echec de la suppression du etudiant";
}
echo $message;
?>
