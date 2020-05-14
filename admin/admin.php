<?php
$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
session_start();

if ($_SESSION['isAdmin']) {
        echo "Bienvenue admin " . $_SESSION['authUser'];
    }else {
        echo "Vous n'êtes pas autorisé à vous connecter";
    }


    $rqt=mysqli_query($link,"SELECT id, title, FK_adminuser, FK_category, date FROM post") or die( mysqli_error($link));
?>

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
                            </tr>";
                    }
                  ?>
            </table>
        </div>
        <div>
            <a href="redactor.php">Créer un nouvel article</a>
        </div>
