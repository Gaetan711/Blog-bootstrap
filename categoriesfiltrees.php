<?php

//Connexion à la base de donnée
require_once 'connexion.php';

//Chargement des dependances Composer
require_once 'vendor/autoload.php';

// Nettoyer la variable id car elle passe par une url, cela évite de se faire manipuler la requette
$id = htmlspecialchars(strip_tags($_GET['id']));

//Passe la requête SQL
$query = $db->prepare('SELECT posts.id, posts.title, posts.content, posts.cover, posts.create_at, posts.category_id, categories.name  AS category FROM posts 
INNER JOIN categories ON categories.id = posts.category_id WHERE categories.id = :id 
ORDER BY posts.create_at DESC');

//Chargement des dépendances 

$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();

$articles = $query->fetchAll();


dump($articles);



?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <link rel="stylesheet" href="CSS/style.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
        <header class="bg-dark text-white py-4">
                        <div class="container">
                            <!--Ligne-->
                            <div class="row">
                                <!--Titre du site - col-lg 12 permet de mettre sur une ligne sur petite ligne - text-start pour mettre le texte à gauche - text-lg-center permet de centrer mon text sur ecrand large-->
                                <div class="col-6 col-lg-12 text-start text-lg-center">
                                    <a href="index.php" class="text-white text-decoration-none h1 logo">Titre du blog</a>
                                </div>

                                <!--Menu Burger -->
                                <div class="col-6 d-block d-lg-none text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list text-white" viewBox="0 0 16 16"><!--On met text-white sur la class du svg pour le mettre en blanc -->
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </div>

                                <!--Navigation d-none -->
                                <div class="col-12 d-none d-lg-block">
                                    
                                    

                                    <nav class="my-3">
                                        <ul class="nav justify-content-center align-intems-center gap-5 py-3">
                                            <li class="nav-item">
                                                <a class="nav-link active text-secondary" aria-current="page" href="index.php">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-secondary" href="article.php">Link</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-secondary" href="categoriesfiltrees.php">Link</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-secondary" href="#">Link</a>
                                            </li>
                                        </ul> 
                                </nav>
                                
                                
                             
                            </div>
        </header>

        <div class="container">
            <div class="row pt-4">

                
                    <?php

                        foreach ($articles as $idCategorie) {
                            $originalDate = "{$idCategorie['create_at']}";
                            //Mettre une date du format angl
                            $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                            $newDate = $DateTime->format('m F Y');
                            
                                $textOrigine = "{$idCategorie['content']}";
                                $textReduit = substr($textOrigine,0,150). ". . .";
                                
                                $textOrigine = "{$idCategorie['content']}";
                                $textReduit = substr($textOrigine,0,150)
                        
                    ?>

                        


                                            <article>
                                                <a href="#" title="Titre de l'article" class="text-dark text-decoration-none"><img src="<?php echo"../img/upload/{$idCategorie['cover']}"?>" alt="article image" class="w-100 rounded">
                                                <h1 class="pt-2"><?php echo"{$idCategorie['title']}.jpg"?></h1></a>
                                                <p class="text-secondary"><?php echo"$newDate" ?></p>
                                                <p class="py-2"><?php echo"{$idCategorie['content']}"?></p>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="#" class="badge bg-dark">Lire la suite</a>
                                                    <a href="categoriesfiltrees.php?id=<?php echo $idCategorie['category_id'] ?>" class="badge bg-dark"><?php echo "{$idCategorie['category']}" ?></a>
                                                </div>
                                            </article>
                                      

                        

                    <?php
                    }
                    ?>
                        </div>

             </div>
        </div>    
</body>
</html>