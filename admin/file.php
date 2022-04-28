<?php


 echo '<pre>';
 print_r($_FILES);
 echo '</pre>';


 move_uploaded_file(
     $_FILES['fichier']['tmp_name'],
 "Doss/{$_FILES['fichier1']['name']}"

);