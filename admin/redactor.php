

<?php
    // CONNEXION BASE DE DONNEES
    $link = mysqli_connect("localhost", "root","", "blog") or die ("Impossible de se connecter: ".mysql_error());

    session_start();

    if(!isset($_SESSION["isAdmin"]) || (isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"])) {
      echo "Unauthorized Access";
      exit;
    }

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
       //On prend le nom de l'auteur et pas la foreign key id finalement
       $authorId = $_SESSION['authUser'];
       $date=date("Y-m-d H:i:s");

       //Pour donner un id à l'article, on compte le nombre de lignes du tableau contenant les articles et on ajoute 1
       $rqt=mysqli_query($link,"SELECT COUNT(*) FROM post");
       $row = mysqli_fetch_array($rqt);
       $id=$row[0]+1;

       mysqli_query($link,"INSERT INTO post(id, title, content, FK_category, FK_adminuser, date) VALUES ('$id','$title', '$content', '$category', '$authorId', '$date');");
   }


?>




<html>
    <head>
        <meta charset="utf-8">
        <title>Admin Article </title>
    </head>
    <body>
        <h1>Rédaction d'un article : </h1>
        <br/>
        <p> Vous êtes connecté en tant que <?php echo $_SESSION['authUser'] ?> </p>
        <div>
            <div>
                <div>Choisissez la catégorie :</div>
                <div>
                    <select id='listCategories'>
                      <option value="" disabled selected>--Choisir une catégorie--</option>
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
            <div><textarea name='content'></textarea></div>
        </div>
        <div>
        <button id="publish">Publier</button>
        </div>





        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
        <script>
        CKEDITOR.replace('content');

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
                      window.location.reload();
                });


                // PUBLICATION DE L'ARTICLE
                $('#publish').on('click', function(){
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
                });

        </script>
    </body>
</html>