<?php

/**
 * Connexion a la base de données
 */


 // Localisation de la base de données
 const DB_HOST = 'localhost';


//Nom de l'Utlisateur
const DB_USER = 'root';

//Mot de passe
const DB_PASS ='';

//Nom de la base de données
const DB_NAME='blog';

//PHP Data Objects
$db = new PDO('mysql:host='. DB_HOST . ';dbname='. DB_NAME, DB_USER, DB_PASS, 
    [ 
    // GESTION DES ERREURS
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,

    //GESTION DU JEU DE CARACTERES
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

    //CHOIX DES RETOURS DES RESULTATS
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

    ]


);

