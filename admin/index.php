<?php

//Connexion à la base de donnée
require_once '../connexion.php';

//Chargement des dependances Composer
require_once '../vendor/autoload.php';

//Passe la requête SQL -- On créé une variable '$query' dans lequel on recupere la table 'posts' (je selectionne posts.id....)
$query = $db->query('SELECT posts.id, posts.title, posts.create_at FROM posts ORDER BY create_at DESC');



// Recupere tous les resultat et les stocke dans la variable '$articles'
$articles = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>

    <link rel="stylesheet" href="../CSS/style.css">

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
    <body class= "bg-dark py-4">

        <div class="container bg-dark py-4">
        
                <div class="col-6 col-lg-12 text-start text-lg-center mb-4">
                <a href="#" class="text-white text-decoration-none h1 logo pb-4 text-uppercase">Tableau de bord</a>
                </div>

                <nav class="my-3">
                        <ul class="nav justify-content-center align-intems-center gap-5 py-3">
                            <li class="nav-item">
                                <a class="nav-link active text-secondary" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#">Articles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#">Catégorie</a>
                            </li>
                        </ul> 
                </nav>


    
                <!--Bordure dégradé de couleur de bleu-->
                <div class="gradient"></div>



        <div class="container mt-4 ">
            <div class="mx-auto">
                <table class="table table-dark text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Create_at</th>
                        <th scope="col">Ajouter/Supprimer</th>
                        
                        <div class="d-flex justify-content-end">

                            <a class="btn btn-outline-info text-uppercase font-weight-bold mt-3 mb-3" href="add.php">Ajouter un article</a>
                            
                        </div>
                
                    </tr>
                </thead>
                
                    
                <?php
                
                foreach ($articles as $array) {
                    
                    //Création d'une variable pour mettre la date au format européen
                    $originalDate = "{$array['create_at']}";
                    //Mettre une date du format angl
                    $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                    $newDate = $DateTime->format('m F Y');

               
                ?>
                <tbody> 
                    <!--Ligne classé par ID, Titre, Créé le, 2 Boutons qui ajoute ou supprime-->
                
                    <th scope="row"><?php echo $array['id']?></th>
                    <td><?php echo $array['title']?></td>
                    <td><?php echo $newDate ?></td>
                    <td><button type="button" class="btn btn-dark text-success font-weight-bold">Modifier</button><button type="button" class="btn btn-dark text-danger text-uppercase font-weight-bold">Supprimer</button></td>
                    
                
                   
                
                </tbody>
                <?php
                }
                ?>
                
                </table>

            </div>
        </div>

    </body>
</html>