<?php

//Connexion à la base de donnée
require_once 'connexion.php';

//Chargement des dependances Composer
require_once 'vendor/autoload.php';

// Nettoyer la variable id car elle passe par une url, cela évite de se faire manipuler la requette
$id = htmlspecialchars(strip_tags($_GET['id']));

//Passe la requête SQL
$query = $db->prepare('SELECT posts.id, posts.title, posts.content, posts.cover, posts.create_at,  posts.category_id, categories.name  AS category, users.last_name, users.first_name FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id =posts.user_id WHERE posts.id = :id ORDER BY posts.create_at DESC');


//Chargement des dépendances 

$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();

// Ensuite on récupere l'élément fetch (car on appel que l'id et pas plusieurs infos, sinon on utiliserait fetchAll)

$article = $query->fetch();


dump($article);
//PAGE INTROUVABLE ERREUR 404

if (!$article) {
    header('Location: 404.php');

}
 


/* if (isset($_GET $index['id','cover'])) {
    echo $_GET['prenom'];
} */

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
            <div class="col-6 col-lg-12 text-start text-lg-center">
                <a href="#" class="text-white text-decoration-none h1 logo">Article</a>
            </div>

            <div class="col-12 d-none d-lg-block">
                <nav class="my-3">
                    <ul class="nav justify-content-center align-intems-center gap-5 py-3">
                        <li class="nav-item">
                            <a class="nav-link active text-secondary" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Link</a>
                        </li>
                    </ul> 
            </nav>
            </div>
        </div>
    </header>
    <div class="gradient"></div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                     $originalDate = "{$article['create_at']}";
                     //Mettre une date du format anglais à fr
                     $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                     $newDate = $DateTime->format('m F Y');
                    ?>
                    <h1 class="text-center pt-4"><?php echo"{$article['title']}"?></h1>
                </div>
                    <div class="row">
                        

                        <div class="col-6 text-end pt-2"><p class="text-secondary"></p></div>
                        <div class="col-6 text-start pt-2 mb-3"><?php echo"$newDate"?>
                        <a href="categoriesfiltrees.php?id=<?php echo $article['id'] ?>" class="badge bg-dark"><?php echo"{$article['category']}"?></a>
                            <a href="#" class="badge bg-dark "></a></div>
                    </div>
                        <div class="col-12 text-center">
                            <img src=<?php echo"img/upload/{$article['cover']}"?> alt="article picture" class="rounded w-50">
                        </div>
                            <div class="col-3"></div>
                            
                            <div class="col-6"><p class="fw-bold pt-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima consequuntur laudantium pariatur sequi obcaecati ab hic 
                                corrupti aliquid inventore placeat delectus expedita alias ipsa at illum laboriosam, ipsum eum atque!</p>
                            </div>
                            
                            <div class="col-3">
                                
                            </div>
                                
                                <div class="col-3">

                                
                                </div>
                                
                                <div class="col-6 "><p class="text-align"><?php echo"{$article['content']}"?></p>
                                <p><?php echo"Auteur de l'article : {$article['last_name']}"?></p>
                                </div>

                                <?php

                                ?> 

                                <div class="col-3">

                                </div >
                                    <div class="container m-0">
                                        <section class=" pt-5">
                                            <div  class="bg-secondary bg-opacity-50 pt-4">
                                                <div class="row">
                                                    <div class="col-2">
                                                    </div>

                                                    <div class="col-8">
                                                        <h2 class="fw-bold text-start">Comments</h2>
                                                    </div>

                                                    <div class="col-2">
                                                    </div>
                                                </div>

                                                <div class="row pt-4">

                                                    <div class="col-4">
                                                        <p class="fw-bold text-center offset-3">Jonh Doe</p>
                                                    </div>

                                                    <div class="col-4">
                                                        
                                                    </div>
                                                    
                                                    <div class="col-4">
                                                        <p class=" fw-bold text-start">january 1, 2021</p>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-2">
                                                    </div>

                                                    <div class="col-8">
                                                        <p class="text-secondary text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis numquam dolores rerum magni beatae saepe libero quidem minima nostrum eaque sequi recusandae eum veritatis labore inventore ab asperiores sapiente, adipisci aliquam laudantium dolorem sunt vitae quis animi. Voluptates asperiores aliquid molestias saepe reiciendis cupiditate blanditiis similique nemo ipsum amet temporibus deserunt, adipisci, consequuntur consectetur natus suscipit velit nobis necessitatibus vel nulla ratione laborum dolorum, a commodi! Incidunt delectus autem esse veniam officiis ullam, sed libero aspernatur deleniti laboriosam qui quaerat quae excepturi id voluptatem fugiat tempore, assumenda reprehenderit dignissimos? Totam hic dolores quam doloremque ipsam, quisquam minus culpa vero eveniet!</p>
                                                    </div>

                                                    <div class="col-2">
                                                    </div>
                                                </div>

                                                <div class="row pt-4">

                                                    <div class="col-4">
                                                        <p class="fw-bold text-center offset-3">Jonh Doe</p>
                                                    </div>

                                                    <div class="col-4">
                                                        
                                                    </div>
                                                    
                                                    <div class="col-4">
                                                        <p class=" fw-bold text-start">january 1, 2021</p>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-2">
                                                    </div>

                                                    <div class="col-8">
                                                        <p class="text-secondary text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis numquam dolores rerum magni beatae saepe libero quidem minima nostrum eaque sequi recusandae eum veritatis labore inventore ab asperiores sapiente, adipisci aliquam laudantium dolorem sunt vitae quis animi. Voluptates asperiores aliquid molestias saepe reiciendis cupiditate blanditiis similique nemo ipsum amet temporibus deserunt, adipisci, consequuntur consectetur natus suscipit velit nobis necessitatibus vel nulla ratione laborum dolorum, a commodi! Incidunt delectus autem esse veniam officiis ullam, sed libero aspernatur deleniti laboriosam qui quaerat quae excepturi id voluptatem fugiat tempore, assumenda reprehenderit dignissimos? Totam hic dolores quam doloremque ipsam, quisquam minus culpa vero eveniet!</p>
                                                    </div>

                                                    <div class="col-2">
                                                    </div>
                                                </div>

                                                <div class="row pt-4">

                                                    <div class="col-4">
                                                        <p class="fw-bold text-center offset-3">Jonh Doe</p>
                                                    </div>

                                                    <div class="col-4">
                                                        
                                                    </div>
                                                    
                                                    <div class="col-4">
                                                        <p class=" fw-bold text-start">january 1, 2021</p>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-2">
                                                    </div>

                                                    <div class="col-8">
                                                        <p class="text-secondary text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis numquam dolores rerum magni beatae saepe libero quidem minima nostrum eaque sequi recusandae eum veritatis labore inventore ab asperiores sapiente, adipisci aliquam laudantium dolorem sunt vitae quis animi. Voluptates asperiores aliquid molestias saepe reiciendis cupiditate blanditiis similique nemo ipsum amet temporibus deserunt, adipisci, consequuntur consectetur natus suscipit velit nobis necessitatibus vel nulla ratione laborum dolorum, a commodi! Incidunt delectus autem esse veniam officiis ullam, sed libero aspernatur deleniti laboriosam qui quaerat quae excepturi id voluptatem fugiat tempore, assumenda reprehenderit dignissimos? Totam hic dolores quam doloremque ipsam, quisquam minus culpa vero eveniet!</p>
                                                    </div>

                                                    <div class="col-2">
                                                    </div>
                                                </div>

                                                <div class="row pt-4">

                                                    <div class="col-4">
                                                        <p class="fw-bold text-center offset-3">Jonh Doe</p>
                                                    </div>

                                                    <div class="col-4">
                                                        
                                                    </div>
                                                    
                                                    <div class="col-4">
                                                        <p class=" fw-bold text-start">january 1, 2021</p>
                                                    </div>
                                                </div>

                                                <div class="row pb-5">

                                                    <div class="col-2">
                                                    </div>

                                                    <div class="col-8">
                                                        <p class="text-secondary text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis numquam dolores rerum magni beatae saepe libero quidem minima nostrum eaque sequi recusandae eum veritatis labore inventore ab asperiores sapiente, adipisci aliquam laudantium dolorem sunt vitae quis animi. Voluptates asperiores aliquid molestias saepe reiciendis cupiditate blanditiis similique nemo ipsum amet temporibus deserunt, adipisci, consequuntur consectetur natus suscipit velit nobis necessitatibus vel nulla ratione laborum dolorum, a commodi! Incidunt delectus autem esse veniam officiis ullam, sed libero aspernatur deleniti laboriosam qui quaerat quae excepturi id voluptatem fugiat tempore, assumenda reprehenderit dignissimos? Totam hic dolores quam doloremque ipsam, quisquam minus culpa vero eveniet!</p>
                                                    </div>

                                                    <div class="col-2">
                                                    </div>
                                                </div>

                                                <div class="row pb-5">
                                                    <div class="col-2">
                                                    </div>

                                                    <div class="col-8 pb-5">
                                                        <h2 class="fw-bold text-start">Ajoutez un Commentaire</h2>
                                                    </div>

                                                    <div class="col-2">
                                                    </div>

                                                    <div class="container d-flex align-items-center"></div>
                                                    <div class="mb-3 align-intems-center">
                                                        <label for="name" class="form-label name offset-2">Nom</label>
                                                        <input type="name" class=" label form-control border-0 border-bottom w-50 bg-secondary bg-opacity-10" id="name" placeholder="Votre Nom">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label offset-2">Email address</label>
                                                        <input type="email" class=" form-control border-0 border-bottom w-50 bg-secondary bg-opacity-10 " id="email" placeholder="name@example.com">
                                                    </div>
                                                   
                                                    <div>
                                                    <button type="button" class="btn btn-dark btn-lg w-100">Envoyer</button>
                                                    </div>
                                                </div>

                                            

                                        </div>

                                    </section>
                                    </div>
            </div>
        </div>

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