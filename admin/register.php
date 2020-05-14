<?php
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());

    $password = password_hash("francois", PASSWORD_DEFAULT);
    $username = "francois";
    $email = "francois.luvan@gmail.com";

    mysqli_query($link, "INSERT INTO adminuser(username, password, email) VALUES ('$username', '$password', '$email')");

    echo $username . "admin user a été créé";

    mysqli_close($link);
?>
