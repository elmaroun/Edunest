<?php
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Initialisation d'une variable pour les messages
$message = '';

// Démarrage de la session PHP
session_start();

// Récupération de l'email du professeur à partir de la session
$mail_p =  $_SESSION['email_professor'];

// Récupération des informations du professeur à partir de la base de données
$stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM professors WHERE email = ?");
$stmt->bind_param("s", $mail_p);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Extraction des informations récupérées
$nom_p = $row['nom'];
$prenom_p = $row['prenom'];
$photo_profile=$row['photo_de_profile'];

// Traitement de la demande de suppression de profil
if(isset($_POST['supprimer'])) {
    // Redirection vers la page de confirmation de suppression
    header("Location: confirmation-professeur.php");
    exit();
}
?>

<!DOCTYPE html>
<html >
<head>
    <title>EduNest - Professeur</title>
    <!-- Inclusion du font et des styles CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header-professor.php'; ?>

    <!-- Conteneur principal -->
    <div class="center-container">
        <section class="form-container">
            <!-- Affichage de la photo de profil -->
            <img src="../photo-profile/<?php echo $photo_profile; ?>" style="width:6cm;height:6cm; margin-top:1cm;border-radius:50%;">
            <!-- Affichage du nom et prénom de l'utilisateur -->
            <?php echo '<h1 class="nom-utilisateur " style="margin-bottom:5px;">'.$nom_p.'  '.$prenom_p.'</h1>'?>
            <!-- Affichage de l'adresse e-mail de l'utilisateur -->
            <?php echo '<h1 class="nom-utilisateur" style="margin-top : 5px ; padding-top:1px;">'.$mail_p. '</h1>'?>
            <!-- Bouton pour modifier le profil -->
            <a href="modify-profile-professor.php" class="btn">Modifier Profile</a>
            <!-- Formulaire pour supprimer le profil -->
            <form action="" method="post">
                    <input type="submit" name="supprimer" value="Supprimer Profile"  class="btn1">
            </form>

        </section>
    </div>

</body>
</html>


