<?php
include "connexion.php";
$pdoStat = $pdo->prepare( 'UPDATE etudiant set nom=:nom, prenom=:prenom, email=:email, adresse=:adresse WHERE cin=:num LIMIT 1');
$pdoStat->bindValue(':num', $_POST['cin'], PDO:: PARAM_INT);
$pdoStat->bindValue(':nom', $_POST['nom'], PDO:: PARAM_STR);
$pdoStat->bindValue(':prenom', $_POST['prenom'], PDO:: PARAM_STR);
$pdoStat->bindValue(':email', $_POST['email'], PDO:: PARAM_STR);
$pdoStat->bindValue(':adresse', $_POST['adresse'], PDO:: PARAM_STR);

$executeIsOK= $pdoStat->execute();
if ($executeIsOK) {
$message = "L'Etudiant a été mis à jour";
header("location:afficherEtudiants.php");
}
else{
$message = "Echec de la mise à jour du etudiant";
}
echo $message;
?>
