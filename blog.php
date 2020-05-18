<?php


$link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());
session_start();


$rqt=mysqli_query($link,"SELECT post.id, post.title, post.FK_adminuser, category.name, post.content, date FROM post INNER JOIN category ON post.FK_category = category.id ") or die( mysqli_error($link));

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
  <a href='/admin/admin.php'> se connecter</a>
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
                            echo
                            "<div class='wrap-post'>
                                <div class='header-post'>
                                    <div class='title-post'>".$post["title"]."
                                        <div class='info-post'>".$post["name"].", par ".$post["FK_adminuser"]." le ".$post["date"]."</div>
                                    </div>
                                </div>
                                <div class='content-post'>
                                    <div class='content'>".$post["content"]."</div>
                                    <div class='fade-content'><a href='article.php?p=".$post["id"]."'>Lire la suite</a></div>
                               </div>
                            </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      </body>
      </html>
