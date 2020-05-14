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

$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
    session_start();

    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $rqt=mysqli_query($link,"SELECT * FROM adminuser WHERE username = '$username'");

        $result = mysqli_fetch_assoc($rqt);
        $isValid = password_verify($password, $result['password']);

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
