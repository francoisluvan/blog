<?php

session_start();

//Vérification des droits de connexion
if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
  echo "Vous devez vous connecter.  <a href='login.php'> Connexion.</a>";
  exit;
}
//Connexion à la base de données
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());

//Suppression des articles sélectionnés
if(isset($_POST['suppr'])){
    mysqli_query($link,"DELETE FROM post WHERE id IN (".implode(',', array_map('intval', $_POST['suppr'])).")");
    if (mysqli_affected_rows($link)>0){
    echo mysqli_affected_rows($link).' ligne(s) effacée(s).';
  }
}
else{
  echo "aucun article sélectionné";
}


?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Suppression d'article(s)</title>
  </head>
  <body>
    <a href='admin.php'> Retour admin</a>
  </body>
</html>
