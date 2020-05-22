

<?php

    session_start();

    if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
      echo "Veuillez vous connecter.  <a href='login.php'> Connexion</a>";
      exit;
    }

    // CONNEXION BASE DE DONNEES
    $link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());

    // AJOUT DE CATEGORIES
    if (isset($_POST["name"])) {
         $name=$_POST["name"];
        mysqli_query($link,"INSERT INTO category(name) VALUES ('$name');");
    }

    $rqt=mysqli_query($link,"SELECT * FROM category");

     if (isset($_POST["name"])){
         echo json_encode($categories);
         return;
     }


     //AJOUT D'UN ARTICLE
     if (isset($_POST["title"]) && isset($_POST["post"])) {
       $title=$_POST['title'];
       $content=$_POST['post'];
       $category=$_POST['category'];
       $authorId = $_SESSION['authUser'];
       $date=date("Y-m-d H:i:s");

       //Pour donner un id à l'article, on compte le nombre de lignes du tableau contenant les articles et on ajoute 1
       $rqt=mysqli_query($link,"SELECT COUNT(*) FROM post");
       $row = mysqli_fetch_array($rqt);
       $id=$row[0]+1;
       //Requête d'ajout de l'article dans la base de données
       mysqli_query($link,"INSERT INTO post(id, title, content, FK_category, FK_adminuser, date) VALUES ('$id','$title', '$content', '$category', '$authorId', '$date');");
   }


?>




<html>
    <head>
        <meta charset="utf-8">
        <title>Admin Article </title>
    </head>
    <body>
        <a href='../blog.php'> Voir le blog</a>
        <br />
        <a href='admin.php'> Retour admin</a>
        <h1>Rédaction d'un article : </h1>
        <br/>
        <p> Vous êtes connecté en tant que <?php echo $_SESSION['authUser'] ?> </p>
        <div>
            <div>
                <div>Choisissez la catégorie :</div>
                <div id="choixcategory">
                  <select id='listCategories'>
                    <option value='0' disabled selected>--Choisir une catégorie--</option>
                      <?php
                      for ($i=0;$categories=mysqli_fetch_assoc($rqt);$i++){
                        echo "<option value='".$categories['id']."'>".$categories['name']."</option>";
                      }
                      ?>
                  </select>
                </div>
                <div>
                    Ajouter une nouvelle catégorie :
                    <button id="addCategory">Créer une nouvelle catégorie</button>
               </div>
               <div>
                   Titre de l'article :
                   <input type='text' id="postTitle"></input>
              </div>
            </div>
          <div><textarea id='content' name='content' style='display:none'></textarea></div>
        </div>
        <div>
        <button id="publish" onclick="stop()">Publier</button>
        </div>


        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
        //Remplace le textarea par l'éditeur de texte ckeditor 4
        CKEDITOR.replace( 'content' );

            // AJOUT DE CATEGORIES
            $('#addCategory').on('click', function(){
              var newName = prompt("Entrez le nom de votre catégorie :");
              $.ajax({
                        method: "POST",
                        data: {
                            "name": newName
                        },
                        dataType: "json",
                        success:
                        function(categories){
                        var categoriesHtml;
                        for (category of categories){
                             categoriesHtml += "<option value='" + category['id'] + "' selected>" + category['name'] +  "</option>";
                        }
                          $('#listCategories').html(categoriesHtml);

                        }
                      });
                      //Recharge uniquement le menu déroulant des catégories pour ajouter la catégorie sans refresh la page
                      $('#choixcategory').load('http://blog/admin/redactor.php #listCategories');
                });





                // PUBLICATION DE L'ARTICLE
                $('#publish').on('click', function(){
                  if($('#postTitle').val() == '' || $("#listCategories option:selected").val() == 0){
                    alert("Renseignez le titre et choisissez une catégorie")
                  }
                  else{
                    $.ajax({
                        method: "POST",
                        data: {
                          "post": CKEDITOR.instances.content.getData(),
                          "title": $("#postTitle").val(),
                           "category" : $("#listCategories").val()
                        },
                        success: function(){
                           window.location.href = "admin.php";
                        }
                    })
                  }

                });


                //Fonction warning si on quitte la page sans sauvegarder
                var unsaved = true;

                function showWindow(){
                    if(unsaved){
                        return "Voulez-vous vraiment quitter cette page? Les modifications non sauvegardées seront perdues";
                    }
                }

                $('#publish').click(function(){
                    unsaved = null;
                });

                window.onbeforeunload = showWindow;


        </script>
    </body>
</html>
