<?php

session_start();
//Récupère l'id de l'article dans l'url
if(isset($_GET['p'])){
  $id=$_GET['p'];
}
else
{
  echo "article introuvable";
  exit;
}

//connexion base de données
require ('./admin/config.php');
//Récupère le contenu de l'article sélectionné
$rqt=mysqli_query($link,"SELECT post.id, post.soustitre, post.description, post.title, post.FK_adminuser, category.name, post.content, post.duree, date, post.image FROM post INNER JOIN category ON post.FK_category = category.id WHERE post.id = '$id'") or die( mysqli_error($link));
$rqt2=mysqli_query($link,"SELECT post.id, post.soustitre, post.description, post.title, post.FK_adminuser, category.name, post.content, post.duree, date, post.image FROM post INNER JOIN category ON post.FK_category = category.id WHERE post.id = '$id'") or die( mysqli_error($link));

?>




    <!DOCTYPE html>
    <html lang="fr" dir="ltr">
      <head>
            <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168109459-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-168109459-1');
        </script>
        <meta charset="utf-8">
        <title>
        <?php
          for ($i=0;$post2 = mysqli_fetch_array($rqt2);$i++) {
                echo utf8_encode($post2['title']).'
      </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="'.utf8_encode($post2['description']).'">
        <meta property="og:image" content="'.utf8_encode($post2['image']).'">
        <meta name="twitter:image" content="'.utf8_encode($post2['image']).'">
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content=""@BisonFactory" />
        <meta name="twitter:title" content="'.utf8_encode($post2['title']).'" />
        <meta name="twitter:description" content="'.utf8_encode($post2['description']).'" />
        <meta name="twitter:image" content="'.utf8_encode($post2['image']).'" />
      ';}?>


        <link rel="stylesheet" href="./style/bootstrap/bootstrap.min.css">
        <link rel="shortcut icon" href="https://bisonfactory.com/favicon.ico">
        <link href="./style/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="./style/index.css">

      </head>
      <body id="page-top">

        <!-- Menu -->
        <nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg" id="mainNav">
          <a class="navbar-brand js-scroll-trigger" href="index"><img class="img-fluid" src="./images/logoblanc.png" alt="logo bison factory"></a>
          <!-- Menu responsive -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> MENU
          <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto text-uppercase">
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index#services">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index#a-propos">A propos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#page-top">Blog</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="contact">Contact</a>
                </li>
              </ul>
            </div>
        </nav>


        <!-- Header -->
    <?php
      for ($i=0;$post = mysqli_fetch_array($rqt);$i++) {
            echo
        '<header class="masthead d-flex align-items-center" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ),  url('.$post["image"].');  background-repeat: no-repeat;
          background-attachment: scroll;
          background-position: center ;
          background-size: cover; max-height:500px;">
          <div class="container" >
            <div class="intro-text">
              <div class="intro-heading text-uppercase text-left" style="text-decoration:none;overflow-wrap: break-word;">
                  '.utf8_encode($post["title"]).'
              </div>
              <div class="intro-lead-in mt-4" style="padding-bottom:3em">'.utf8_encode($post["soustitre"]).'</div>
              </div>
          </div>
        </header>






        <section class="bg-light page-section" style="padding-top:3em">
          <div class="container">
            <div class="row">
              <div class="header-post">
                  <div class="fade-content"><a class="btn btn-dark" href="blog">Retour aux articles</a></div>
                  <div> publié dans la rubrique '.utf8_encode($post["name"]).', par '.$post["FK_adminuser"].' le '.$post["date"].'</div>
                  <div> Temps de lecture : '.$post["duree"].' min  </div>
              </div>
            </div>
            <div class="row d-flex justify-content-center mx-5">
                <div class=" my-5">
                            <div class="content-post">
                                <div class="content">'.$post["content"].'</div>
                                <div class="fade-content"><a class="btn btn-dark" href="blog">Retour aux articles</a></div>
                           </div>
                        </div>';
                      }
                  ?>
          </div>
        </div>
        </section>



        <!-- Footer -->
        <footer class="footer">
          <div class="container">
            <div class="row align-items-center">
              <div id="logodiv" class="col-md-4">
                <a href="#">
                <img class="img-fluid mb-3" src="./images/logobisonfactory.png" alt="logo bison factory">
                </a>
              </div>
              <div class="col-md-4">
                <ul class="list-inline social-buttons">
                  <li class="list-inline-item">
                    <a href="https://twitter.com/FactoryBison" target="_blank">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.facebook.com/Bison-Factory-113583067056257" target="_blank">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                <a href="https://www.linkedin.com/company/54290265" target="_blank">
                      <i class="fab fa-linkedin-in"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-md-4">
                <ul class="list-inline quicklinks">
                  <li class="list-inline-item">
                  <a href='/admin/login' target="_blank"> se connecter</a>
                  </li>
                  <li class="list-inline-item">
                    <a href="mentions-legales">Mentions légales</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>

      <script src="./js/jquery.js"></script>
      <script src="./js/popper.min.js"></script>
      <script src="./style/bootstrap/bootstrap.min.js"></script>
        <script src="./js/jquery.easing.min.js"></script>
      <script src="./js/monsite.min.js"></script>

      </body>
    </html>
