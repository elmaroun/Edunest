<?php
// On etablir une connexion à la base de données MySQL
$con = new mysqli('localhost:3308','root','','EduNest');
// La vérification si la connexion a échoué
if(!$con){
        // Affichage d'un message d'erreur et arrêter l'exécution du script
    die(mysqli_error($con));
}
?>
