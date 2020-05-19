<?php

session_start();

//Vérification de connexion
if (isset($_SESSION['isAdmin'])) {
        echo "Bienvenue admin " . $_SESSION['authUser'];
    }else {
        echo "Vous n'êtes pas autorisé à vous connecter. <br /> <a href='/admin/login.php'> se connecter</a>";
        return;
    }

//Récupère les articles dans la base de données
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
$rqt=mysqli_query($link,"SELECT id, title, FK_adminuser, FK_category, date FROM post") or die( mysqli_error($link));

?>



<div>
  <a href="deconnexion.php">Déconnexion</a>
  <br />
  <a href='../blog.php'> Voir le blog</a>
  </div>

<div>
  <table>
      <table style="width:100%">
        <tr class="table-first-line">
          <th>Auteur</th>
          <th>Titre</th>
          <th>Catégorie</th>
          <th>Date</th>
        </tr>
        <?php
          for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
              echo "<tr>
                      <td>".$post["FK_adminuser"]."</td>
                      <td>".$post["title"]."</td>
                      <td>".$post["FK_category"]."</td>
                      <td>".$post["date"]."</td>
                      <td><form action='suppress.php' method='post'><input type='checkbox' name='suppr[]' value=".$post['id']." /></td>
                      <td><a href='update.php?id=".$post['id']."'>Modifier</a></td>
                  </tr>";
          }
          echo"<tr><td></td><td></td><td></td><td></td><td><input type='submit' value='Supprimer' /></th><tr></table></form>"
        ?>
    </table>
  </div>
  
<div>
    <a href="redactor.php">Créer un nouvel article</a>
</div>
