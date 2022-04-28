
<?php
//Teste de var_dumper()

// Chargement de l'autoloader de composer
require_once 'vendor/autoload.php';

$array = [
    'id'=> 1,
    'prenom' => 'Gaetan'
];

dump($array);
