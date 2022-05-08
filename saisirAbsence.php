<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login1.php");
      exit();
   }else {
     
  if(isset($_REQUEST['module']) && isset($_REQUEST['check'])){
    include("connexion.php");
    $etat=$_REQUEST['etat'];
     $module=$_REQUEST['module'];
     $choix=$_REQUEST['check'];
     foreach($choix as $value){
       $chaine=explode('_',$value);
       $dt = DateTime::createFromFormat('d/m/Y', $chaine[0]);
       $date=$dt->format('Y-m-d');
       $heure=$chaine[1];
       $cin=intval($chaine[2]); 
     }
   }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Modifier Etudiant</title>
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
              <h1 class="display-4">Signaler l'absence pour tout un groupe</h1>
              <p>Pour signaler, annuler ou justifier une absence, choisissez d'abord le groupe, le module puis l'étudiant concerné!</p>
            </div>
          </div>
<?php 
       if(isset($_REQUEST['erreur'])){
         if($_REQUEST['erreur']==-1)
         echo"<script>alert(\"Absence déja inscrit\");</script>";
         else  echo"<script>alert(\"Absence bien inscrit\");</script>";
       }
       ?>
<div class="container">
<form method="get" action="">
<div class="form-group">
  <label for="semaine">Choisir une semaine:</label><br>
  <input id="semaine" type="week" name="debut" size="10" class="datepicker"/>
</div>
  <div class="form-group">
<label for="classe">Choisir un groupe:</label><br>

<label for="classe">Groupe:</label><br>
<select id="classe" name="id"  class="custom-select custom-select-sm custom-select-lg">
                    <?php
                      include("connexion.php");
  $req="SELECT * FROM groupeetudiant";
  $reponse = $pdo->query($req);
  $tab=$reponse->fetchAll();
  if(count($tab)>0){
   foreach($tab as $value){

   

?>

    <option><?php echo $value["groupe"]?></option>
    <?php
   } 

       
   }
   ?>

   </select>
   </div>
   <button type="submit" class="btn btn-primary btn-block">Afficher</button>
  </form>

<?php
  if (isset($_REQUEST["id"])){
    $s=$_REQUEST['debut'];
    
    $id=$_REQUEST["id"];
    $sel=$pdo->prepare("SELECT * FROM etudiant WHERE Classe=? order by nom");
    $sel->execute(array($id));
    $count=$sel->rowcount();
    if($count>0){
        $tab=$sel->fetchAll();
        
      
    

  ?>
<form method="get" action="">
<div class="form-group">
  <label for="module">Choisir un module:</label><br>
  <select id="module" name="module"  class="custom-select custom-select-sm custom-select-lg">
      <option value="Tech. Web">Tech. Web</option>
      <option value="SGBD">SGBD</option>
      <option value="Reseau">Reseau</option>
      <option value="c++">c++</option>
      <option value="Analyse numerique">Analyse numerique</option>
      <option value="Proba">Proba</option>
      <option value="Conception">Conception</option>
      <option value="Algo">Algo</option>
  </select>
  </div>
  <div class="form-group">
  <label for="etat">Choisir :</label><br>
  <select id="etat" name="etat"  class="custom-select custom-select-sm custom-select-lg">
      <option value="1">Justifiée</option>
      <option value="0">Non Justifiée</option>
  </select>
  </div>
<table rules="cols" frame="box">
<tr><th>
    <?php
    include "connexion.php";

    $query = "SELECT COUNT(*) FROM etudiant ";
    
    $statement = $pdo->prepare($query);
    
    $statement->execute();
    $result=$statement->fetch();
    echo $result[0];
    ?>
  </th>

<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Lundi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mardi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mercredi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Jeudi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Vendredi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Samedi</th>
</tr><tr><td>&nbsp;</td>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 1 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 2 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 3 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 4 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 5 days'));?></th>
</tr><tr><td>&nbsp;</td>
<th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th>
</tr>
<tr class="row_3"><td><b>M. WALID SAAD</b></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
</tr>

<tr class="row_3"><td><b>M. WALID SAAD</b></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  <td><input type="checkbox"></td>
  </tr>
</table>
<br>
 <!--Bouton Valider-->
 <button  type="submit" class="btn btn-primary btn-block">Valider</button>
</form>

<?php

}
}


?>
</div>  
</main>

<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>