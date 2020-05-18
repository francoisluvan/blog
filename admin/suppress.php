<?php

session_start();

if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
  echo "Unauthorized Access.  <a href='login.php'> Connectez-vous.</a>";
  exit;
}

$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());

if(isset($_POST['suppr'])){
  // connexion MYSQL

    mysqli_query($link,"DELETE FROM post WHERE id IN (".implode(',', array_map('intval', $_POST['suppr'])).")");
    if (mysqli_affected_rows($link)>0){
    echo mysqli_affected_rows($link).' ligne(s) effacée(s).';
  }
}
else{
  echo "aucun article sélectionné";
}


?>

        <a href='admin.php'> Retour admin</a>
