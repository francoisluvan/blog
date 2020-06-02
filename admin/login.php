
<?php

    session_start();
    //Connexion base de données
$link = mysqli_connect("bisonfgadmin.mysql.db", "bisonfgadmin","Tarsi0701", "bisonfgadmin") or die ("Impossible de se connecter: ".mysql_error());
    //Vérification du username et password renseignés par l'utilisateur
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        //real escape string() évite les injections sql
        $username = mysqli_real_escape_string($link, $_POST["username"]);
        $password = mysqli_real_escape_string($link, $_POST["password"]);
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
          $fail = 'mauvais identifiant ou mot de passe';
        }
    }

?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../style/login.css" rel="stylesheet">

    <title>Login</title>
    </head>
  <body>

    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first my-5">
          <img src="http://bisonfactory.com/images/uploads/logobisonfactory.png" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form method="POST">
          <input type="text" id="login" class="fadeIn second" name="username" placeholder="identifiant">
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="mot de passe">
          <input type="submit" class="fadeIn fourth" style="cursor:pointer" value="se connecter">
            <?php if(isset($fail)){
              echo "<div class='alert alert-danger' role='alert'>". $fail. "</div>" ;}
            ?>
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="mailto:francois.luvan@gmail.com">support</a>
        </div>

      </div>
    </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
