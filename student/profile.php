<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Initialisation de la variable de message
$message = '';
// Démarrage de la session

session_start();
$mail_s =  $_SESSION['email_student'];
// Préparation et exécution de la requête pour récupérer les informations de l'utilisateur connecté
$stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM students WHERE email = ?");
$stmt->bind_param("s", $mail_s);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$nom_s = $row['nom'];
$prenom_s = $row['prenom'];
$photo_profile=$row['photo_de_profile'];
// Préparation et exécution de la requête pour récupérer les informations de l'utilisateur connecté
if(isset($_POST['supprimer'])) {
     // Redirection vers la page de confirmation de suppression
    header("Location: confirmation-page-student.php");
    exit();
}
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
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header-student.php'; ?>

    <div class="center-container">
        <section class="form-container">
            <!-- Affichage de l'image de profil -->
            <img src="../photo-profile/<?php echo $photo_profile; ?>" style="width:6cm;height:6cm; margin-top:1cm;border-radius:50%;">
            <!-- Affichage du nom et du prénom de l'utilisateur-->
            <?php echo '<h1 class="nom-utilisateur " style="margin-bottom:5px;">'.$nom_s.'  '.$prenom_s.'</h1>'?>
            <!--Affichage de l'email de l'utilisateur-->
            <?php echo '<h1 class="nom-utilisateur" style="margin-top : 5px ; padding-top:1px;">'.$mail_s. '</h1>'?>
            <!-- Bouton pour modifier le profil -->
            <a href="modify-profile-student.php" class="btn">Modifier Profile</a>
            <!-- Formulaire pour supprimer le profil -->
            <form action="" method="post">
                    <input type="submit" name="supprimer" value="Supprimer Profile"  class="btn1">
            </form>

        </section>
    </div>
<!-- It ends here -->


</body>
</html>


