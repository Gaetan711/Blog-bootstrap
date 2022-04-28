<?php

require_once '../connexion.php';
require_once '../vendor/autoload.php';

/**
 * Sélection de toutes les catégories en BDD
 */
$query = $db->query('SELECT * FROM categories ORDER BY name');
$articles = $query->fetchAll();

/**
 * Déclaration de variables à NULL
 * Elles serviront à remplir le formulaire des données soumises
 * par l'utilisateur
 */
$title = null;
$content = null;
$category = null;
$error = null;

/**
 * Si la superglobale $_POST n'est pas vide, alors j'effectue
 * les vérifications nécessaires et l'insertion en BDD
 */
if (!empty($_POST)) {
    // Nettoyage des données
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $content = htmlspecialchars(strip_tags($_POST['content']));
    $category = htmlspecialchars(strip_tags($_POST['category']));

    // Vérifie que mes champs soient bien remplis
    if (
        !empty($title) 
        && !empty($content) 
        && !empty($category) 
        && !empty($_FILES['fichier1']) 
        && $_FILES['fichier1']['error'] === 0
    ) {

        // Upload l'image sur le serveur
        require_once 'fonctions.php';
        $upload = uploadPicture($_FILES['fichier1'], '../img/upload', 1);

        // Si la variable "$upload" ne contient la clé "error", 
        // alors on peut effectuer l'insertion en BDD
        if (empty($upload['error'])) {
            $fileName = $upload['filename'];

            $query = $db->prepare('INSERT INTO posts (user_id, category_id, title, content, cover, create_at) VALUES (1, :category_id, :title, :content, :cover, NOW())');
            $query->bindValue(':category_id', $category, PDO::PARAM_INT);
            $query->bindValue(':title', $title);
            $query->bindValue(':content', $content);
            $query->bindValue(':cover', $fileName);
            $query->execute();

            // Redirection vers la page d'accueil de l'administration
            header('Location: index.php?successAdd=1');
        }
        else {
            // Sinon, on transfère l'erreur à la variable "$error" pour l'afficher
            // au dessus du formulaire
            $error = $upload['error'];
        }
    }
    else {
        $error = 'Tous les champs sont obligatoires';
    }
}

?>


<!DOCTYPE html>
<html lang="fr">
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
                <a href="#" class="text-white text-decoration-none h1 logo pb-4 text-uppercase">Ajouter un Article</a>
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


    
                <!--Bordure dégradé de couleur-->
                <div class="gradient"></div>

        </div>


        <div class="container bg-dark py-4">

            <!--Formulaire d'envoi d'article -->

            <!--Afficher l'erreur dans le formulaire en cas ne non respects des conditions de remplissage -->
            <?php if($error !== null): ?>

            <div class="alert alert-danger text-center">

            <?php echo $error; ?>
            </div>

            <?php 
            
            endif; 
            
            ?>

            <form action="add.php" method="post" enctype="multipart/form-data">
                // INSCRIPTION DU TITRE DE L'ARTICLE
                    <div class="form-group mt-4 text-white">
                        <label for="title exampleFormControlInput1 text-whithe">Titre de l'article</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="What is Lorem Ipsum?" value="<?php echo $title; ?>">
                    </div>


               
                    <div class="form-group mt-4 text-white">
                        <label for="exampleFormControlSelect1">Séléctionner une categorie</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="category">
                        
                        <?php

                foreach ($articles as $choiceCategory) {
                
                        ?>
                        // on integre une "value" pour y inserer l'id de la categorie et apres on y met le nom de la categorie
                        <option value="<?php echo $choiceCategory['id']; ?>" <?php echo ($category !== null && $choiceCategory == $choiceCategory['id']) ? 'selected': null; ?>>
                                        <?php echo $choiceCategory['name']; ?>
                                    </option>
                        
                        <?php
                        }
                        ?>
                        </select>
                    </div>


                    <div class="form-group mt-4">
                        <label for="exampleFormControlTextarea1">Saisir un le texte de votre article</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="10"  placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry." ><?php echo $content; ?></textarea>
                    </div>


                    <!--Bouton d'envoi a revoir par la suite-->

                    <div class="justify-content-center mt-4 mb-4">

                                        
                        <div class="btn btn-outline-info text-uppercase font-weight-bold mt-4 mb-3 " action="file.php" method="post" >

                            <input type="file" name="fichier1">

                        </div>

                        <div class=" secondText alert alert-primary col-4" role="alert">
                        
                        Votre image doit-être au format .webp inferieur a 1 Mo
                        
                        </div>
                        
                        

                    </div>
                    


                    <div class="d-flex justify-content-around">

                            <button type="submit" class="btn btn-outline-info text-uppercase font-weight-bold mt-3 mb-3">Ajouter l'article</button>
                            <button type="button" class="btn btn-outline-info text-uppercase font-weight-bold mt-3 mb-3">Mettre dans les brouillons</button>
                            <button type="button" class="btn btn-outline-info text-uppercase font-weight-bold mt-3 mb-3">Programmer la publication</button>
                        </div>

            </form>
                  
                    


                        


        </div>

    </body>
</html>