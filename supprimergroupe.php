<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login1.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Chercher Etudiant</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="ajouterGroupe.php">Ajouter Groupe</a>
                <a class="dropdown-item" href="modifiergroupe.php">Modifier Groupe</a>
                <a class="dropdown-item" href="supprimergroupe.php">Supprimer Groupe</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="chercherEtudiant.php">Chercher Etudiant</a>
                <a class="dropdown-item" href="modifierEtudiant.php">Modifier Etudiant</a>
                <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0" action ="chercherGrp.php" method="post">
      <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe" name="cherchergrp">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="chercherbutt" >Chercher Groupe</button>
    </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Supprimer un groupe</h1>
              
            </div>
            
          </div>
          <div class="container">
    <form method="POST"  action="supprimergroupe.php">
    <label>Nom du groupe à supprimer:</label><br>
    <input type="text" id="classe" name="classe" class="form-control" required pattern="INFO[1-3]{1}-[A-E]{1}"
     title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
     <br>
     <button  type="submit" class="btn btn-primary btn-block" name="envoyer" >Envoyer</button>
    </form>
  </container>
<?php 
include "connexion2.php";

if (isset($_POST["envoyer"]))
{
    $nom=$_POST['classe'];
    $req2="SELECT * from groupeetudiant where groupe='$nom'";
    $res1=mysqli_query($conn,$req2);
    if (mysqli_num_rows($res1)==0){
        echo "<br><h6 >Le groupe n'existe pas</h6><br>";
    }
    else{
        $req="DELETE from groupeetudiant where groupe='$nom'";
   
        $resultat=mysqli_query($conn,$req);
        if ($resultat){
            echo  "<br><h6 >Le groupe est supprimé avec succés </h6><br>";
        }
        else{
            echo "<br><h6 >Un Erreur Est Survenu</h6><br>";
        }
    } 
  
}
if (isset($_POST["envoyer"]))
{
    $nom=$_POST['classe'];
    $req2="SELECT * from etudiant where Classe='$nom'";
    $res1=mysqli_query($conn,$req2);
    if (mysqli_num_rows($res1)==0){
        echo "<br><h6 >Il n'y a pas d'étudiants dans cette Classe déjà</h6>";
    }
    else{
        $req="DELETE from etudiant where Classe='$nom'";
   
        $resultat=mysqli_query($conn,$req);
        if ($resultat){
            echo  "<br><h6 >Les étudiants sont supprimés avec succés </h6><br>";
        }
        else{
            echo "<br><h6 >Un Erreur Est Survenu</h6><br>";
        }
    }
   
    
}

?>
          
  
</main>


<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>

</body>
</html>