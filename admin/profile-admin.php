<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Initialisation du message
$message = '';
// Démarrage de la session
session_start();
// Récupération de l'email de l'administrateur depuis la session
$mail_admin =  $_SESSION['email_admin'];
// Préparation de la requête pour récupérer les informations de l'administrateur
$stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM admin WHERE email = ?");
$stmt->bind_param("s", $mail_admin);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
// Récupération des informations de l'administrateur

$nom_p = $row['nom'];
$prenom_p = $row['prenom'];
$photo_profile=$row['photo_de_profile'];
?>

<!DOCTYPE html>
<html >
<head>
    <title>Ajouter Cours</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
        <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include 'header-admin.php'; ?>

    <div class="center-container">
                <!-- Contenu de la page -->
        <section class="form-container">
                        <!-- Affichage de la photo de profil de l'administrateur -->
            <img src="../photo-profile/<?php echo $photo_profile; ?>" style="width:6cm;height:6cm; margin-top:1cm;border-radius:50%;">
                        <!-- Affichage du nom et prénom de l'administrateur -->
            <?php echo '<h1 class="nom-utilisateur " style="margin-bottom:5px;">'.$nom_p.'  '.$prenom_p.'</h1>'?>
                        <!-- Affichage de l'email de l'administrateur -->
            <?php echo '<h1 class="nom-utilisateur" style="margin-top : 5px ; padding-top:1px;">'.$mail_admin. '</h1>'?>
                        <!-- Lien pour modifier le profil -->
            <a href="modify-profile_admin.php" class="btn">Modifier Profile</a>
                        <!-- Formulaire pour supprimer le profil -->


        </section>
    </div>
<!-- It ends here -->


</body>
</html>


