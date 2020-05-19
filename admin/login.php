<form  method="POST">
  <div>
      <h2>Login</h2>
  </div>
  <div>
    <input id="username" type="text" name="username" placeholder="Username">
  </div>
  <div>
    <input id="password" type="password" name="password" placeholder="Password">
  </div>
  <div>
    <input type="submit" value="Submit">
  </div>
</form>



<?php

    session_start();
    //Connexion base de données
    $link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
    //Vérification du username et password renseignés par l'utilisateur
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        //Récupère le password de la base de données en fonction du username renseigné
        $rqt=mysqli_query($link,"SELECT * FROM adminuser WHERE username = '$username'");
        //Lit le résultat de la requête dans un tableau
        $result = mysqli_fetch_assoc($rqt);
        //fonction qui vérifie le mot de passe
        $isValid = password_verify($password, $result['password']);
        //Si ok, renvoie l'autorisation dans la valeur 'isAdmin'
        if ($isValid) {
            $_SESSION['isAdmin'] = true;
            $_SESSION['authUser'] = $username;
            $_SESSION['id'] = $result[1];
            header('Location: admin.php');
        }
        else if(!$isValid){
          echo 'mauvais identifiant ou mot de passe';
        }
    }
    
?>
