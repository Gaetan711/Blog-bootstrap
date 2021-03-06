<?php
 
// On appel notre base de données (BDD) afin de faire communiquer nos tables dans nos articles. On commence par connecter la page connexion a l'index html, ensuite on charge les dépendances de 'COMPOSER'
// Etape 3 on doit appeler la requête SQL afin que nos tables soit disponible sur notre page index.  On recupere tous les articles dans une variable que l'on creer en l'occurence '$articles'afin de les stocke dans une variable pour pouvoir les utilisés plus facilement



//Connexion à la base de donnée
require_once 'connexion.php';

//Chargement des dependances Composer
require_once 'vendor/autoload.php';

//Passe la requête SQL
$query = $db->query('SELECT posts.id, posts.title, posts.content, posts.cover, posts.create_at, posts.category_id, categories.name AS category FROM posts INNER JOIN categories ON categories.id = posts.category_id ORDER BY posts.create_at DESC');

// Recupere tous les resultat et les stocke dans la variable '$articles'
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
<!--Row pour Ligne-->
<!--Col pour colonne - Une col contient 12 segments pas plus - au dela de 12 la colonne va a la ligne-->
<!--py-4 c'est un paddind de 4 rem-->
<!--text-start sert de mettre a gauche le texte -->
<!--text-end sert de mettre a droite le texte ou image ou svg -->
<!--d-flex align-items-center Permet de centrer un element sur l'axe horizontal-->
<!--col-lg-3 permet de ne mettre que de 3 largeur sur 12 en grand ecran-->
<!--pt-4 sert a mettre un padding top de 4-->


<div class="container">
<div class="row pt-4">
    <!--col-lg-6 pour mettre 2 col par ligne quand l'ecran est large - col-12 pour que sur mobile il n'y ai qu'une seule colonne-->
    <div class="col-12 col-lg-6 mb-4">
        <article>
            <h1 class="pt-2 text-center"><a href="index.php"></a> BLOG</h1>
            <p class="text-secondary text-center">Blog en construction</p>
            <p class="py-2"></p>
            <div class="d-flex align-items-center gap-2">
            </div>
        </article>
    </div>




    <header class="bg-dark text-white py-4">
        <div class="container">
            <!--Ligne-->
            <div class="row">
                <!--Titre du site - col-lg 12 permet de mettre sur une ligne sur petite ligne - text-start pour mettre le texte à gauche - text-lg-center permet de centrer mon text sur ecrand large-->
                <div class="col-6 col-lg-12 text-start text-lg-center">
                    <a href="#" class="text-white text-decoration-none h1 logo">Titre du blog</a>
                </div>

                 <!--Menu Burger -->
                <div class="col-6 d-block d-lg-none text-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list text-white" viewBox="0 0 16 16"><!--On met text-white sur la class du svg pour le mettre en blanc -->
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                      </svg>
                </div>

                  <!--Navigation d-none pour display none - d-lg-block pour display block large permet de faire apparaitre sur grand ecran et non sur les petit-->
                <div class="col-12 d-none d-lg-block">
                    
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
                </div>

                 <!--Caroussel-->
                 <div class="col-12">
                    <!--Création du Ligne dans 1 colonne-->
                    <div class="row d-flex align-items-center">
                        
                        <!--Fleche de gauche d-none pour display none - d-lg-block pour display block large permet de faire apparaitre sur grand ecran et non sur les petit -->
                        <div class="col-lg-3 d-none d-lg-block text-end text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                          </svg></div>
                        <!--image-->
                        <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                            <img src="img/ban.jpg" alt="banniere" class="rounded w-100 imgcarousel">
                        </div>
                        <!--fleche de droite d-none pour display none - d-lg-block pour display block large permet de faire apparaitre sur grand ecran et non sur les petit-->
                        <div class="col-lg-3 d-none d-lg-block text-start text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                          </svg></div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    
    <!-- Dégradé de couleur-->
    <div class="gradient"></div>
    
    
    <main>

    




        <div class="container">
            <div class="row pt-4">
                <!--col-lg-6 pour mettre 2 col par ligne quand l'ecran est large - col-12 pour que sur mobile il n'y ai qu'une seule colonne-->
                
                        <?php
                        foreach ($articles as $index) {

                            $originalDate = "{$index['create_at']}";
                        //Mettre une date du format angl
                        $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                        $newDate = $DateTime->format('m F Y');

                            $textOrigine = "{$index['content']}";
                            $textReduit = substr($textOrigine,0,150). ". . .";
                            
                            $textOrigine = "{$index['content']}";
                            $textReduit = substr($textOrigine,0,150)


                        ?>

                                        <div class="col-12 col-lg-6 mb-4">
                                            <article>
                                                <a href="article.php?id=<?php echo $index['id'] ?>" title="Titre de l'article" class="text-dark text-decoration-none"><img src="<?php echo"../img/upload/{$index['cover']}"?>" alt="article image" class="w-100 rounded">
                                                <h1 class="pt-2"><?php echo"{$index['title']}"?></h1></a>
                                                <p class="text-secondary"><?php echo"$newDate"?></p>
                                                <p class="py-2"><?php echo"{$textReduit}"?></p>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="article.php?id=<?php echo $index['id'] ?>" class="badge bg-dark" >Lire la suite</a>
                                                    <a href="categoriesfiltrees.php?id=<?php echo $index['category_id'] ?>"class ="badge. bg-dark"><?php echo "{$index['category']}"?></a>
                                                </div>
                                            </article>
                                        </div>

                                
                        <?php
                        };
                        ?>
                
    </main>
    <footer class="py-4 bg-dark">
        <div class="container">
            <div class="col text-left">
                <p class="m-0 text-white">&copy; Copiright Blog test 2022</p>
            </div>
        </div>
    </footer>
</body>
</html>


