<?php

// on se connecte à la Base de données Mysql
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
echo 'connexion réussie';


 ?>
