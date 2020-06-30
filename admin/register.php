<?php
//Crée un utilisateur. SUPPRIMER CE FICHIER APRES UTILISATION

$link = mysqli_connect("localhost", "root","", "bisonfg") or die ("Impossible de se connecter: ".mysql_error());

    $password = password_hash("jury2020", PASSWORD_DEFAULT);
    $username = "visiteur";
    $email = "francois.luvan@gmail.com";

    mysqli_query($link, "INSERT INTO adminuser(username, password, email) VALUES ('$username', '$password', '$email')");

    echo $username . "admin user a été créé";

    mysqli_close($link);
?>
