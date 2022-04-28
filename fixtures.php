<?php
# When installed via composer
require_once 'vendor/autoload.php';

//connexion a la base de donée
require_once 'connexion.php';

//Création de l'instance de Facker
$faker = Faker\Factory::create('fr_FR');

// Insertion de fausses donnée en BDD

 // On génére 10 noms avec une boucles for
/* for ($i=0; $i < 10 ; $i++) { 
    $query = $db->prepare('INSERT INTO categories (name) VALUES (:name)');
    $query->bindValue(':name', $faker->colorName);
    $query->execute();
}  */

//$db->query('SET FOREIGN_KEY_CHECKS = 0; TRUNCATE posts; SET FOREIGN_KEY_CHECKS =1');

// On génére 10 noms avec une boucles for
/* for ($i=0; $i < 20 ; $i++) { 
    $createdAt = $faker->dateTimeBetween('-5years');

    $query = $db->prepare('INSERT INTO users (last_name, first_name, email, password, role, create_at) VALUES (:last_name, :first_name, :email, :password, :role, :create_at)');
 
$query->bindValue(':last_name', $faker->lastName);
$query->bindValue(':first_name', $faker->firstName);
$query->bindValue(':email', $faker->unique()->email); // permet de générer un mail unique
$query->bindValue(':password', password_hash('secret', PASSWORD_DEFAULT)); // on génére un mot de passe qui s'intitule secret
$query->bindValue(':role', $i === 0 ? 'ROLE_ADMIN' : 'ROLE_USER'); // ici c'est un if Ternaire, tant que ROLE admin est different de 0 alors tu me genere un ROLE_ADMIN et apres tu me generes des ROLE_USER
$query->bindValue(':create_at', $createdAt->format('Y-m-d')); // Création de date par année mois et jour

//On execute les commandes
$query->execute(); 

} */

for ($i=0; $i < 20 ; $i++) { 
    
    $createdAt = $faker->dateTimeBetween('-5years');


    $query = $db->prepare('INSERT INTO posts (user_id, category_id, title, content, cover, create_at) VALUES (:user_id, :category_id, :title, :content, :cover, :create_at)');

$query->bindValue(':user_id', $faker->numberBetween(1, 20));// generer un chiffre entre 1 a 20 -- OU SOLUTION 2 -- $query->bindValue(':user_id', rand(1,20), PDO::PARAM_INT);
$query->bindValue(':category_id', $faker->numberBetween(1, 10)); // generer un chiffre entre 1 a 10
$query->bindValue(':title', $faker->company);
$query->bindValue(':content', $faker->realText(500)); // permet de générer un mail unique
$query->bindValue(':cover', 'minion.jpg'); // on génére un mot de passe qui s'intitule secret
$query->bindValue(':create_at', $createdAt->format('Y-m-d')); // Création de date par année mois et jour

//On execute les commandes
$query->execute(); 
} 