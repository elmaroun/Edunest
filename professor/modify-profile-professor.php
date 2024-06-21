<?php
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Définition du répertoire de téléchargement pour les photos de profil
$uploadDirectory = __DIR__ . '/../photo-profile/';

// Démarrage de la session PHP
session_start();

// Récupération de l'email du professeur à partir de la session
$mail_p =  $_SESSION['email_professor'];
$stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM professors WHERE email = ?");
$stmt->bind_param("s", $mail_p);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$nom_p = $row['nom'];
$prenom_p = $row['prenom'];
$photo_profile = $row['photo_de_profile'];

// Traitement du formulaire de modification du profil
if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $new_nom = $_POST['nom'];
    $new_prenom = $_POST['prenom'];
    $new_email = $_POST['email'];
    $_SESSION['email_professor'] = $new_email;

    // Vérification si un fichier a été uploadé pour la photo de profil
    if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $file_modifier = basename($_FILES["file"]["name"]);
        $targetPath = $uploadDirectory . $file_modifier;
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath);
    } else {
        // Conserve la photo de profil existante si aucun fichier n'est uploadé
        $file_modifier = $photo_profile; 
    }

    // Mise à jour des informations du professeur dans la base de données
    $stmt = $con->prepare("UPDATE professors SET nom=?, prenom=?, email=?, photo_de_profile=? WHERE email=?");
    $stmt->bind_param("sssss", $new_nom, $new_prenom, $new_email, $file_modifier, $mail_p);
    $stmt->execute();
    // Redirection vers la page de profil
    header("Location: profile.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <!--Le meme que les autres codes -->
    <title>EduNest - Professeur</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/modify-profile-professor.css">
</head>

<body class="login-page">
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header-professor.php'; ?>

    <div class="center-container"> 
        <section class="form-container">
            <form class="register" action="" method="post" enctype="multipart/form-data">
                <h3>Modifier votre compte</h3>

                <!-- Affichage de la photo de profil actuelle -->
                <div class="file-input">

                        <div id="pdfContainer" class="course-pdf">
                            <?php
                            $chemin_profile = "../photo-profile/" . $photo_profile;
                            if (file_exists($chemin_profile)) {
                               echo ' <img src="'.$chemin_profile.'" alt="Profile Image" class="center">';
                            } else {
                                echo '<h1> Fichier non trouvé : ' . $chemin_profile . '</h1>';
                            }
                            ?>
                        </div>
                        <!-- Bouton pour sélectionner un nouveau fichier de photo de profil -->
                        <div class="display_flex">
                        <label for="file" style="display:block;">Modifier l'image :</label>
                        <input type="file" id="file" name="file" accept=".jpg" class="box_profile" onchange="showFile(this)">
                        </div>

                </div>

                <!-- Champ de saisie pour le nom et le prénom -->
                <div class="input-group">
                    <div class="name-fields">
                        <input type="text" name="nom" value=<?php echo $nom_p ;?> required class="box name">
                        <input type="text" name="prenom"  value=<?php echo $prenom_p ;?> required class="box name">
                    </div>
                    <!-- Champ de saisie pour l'adresse e-mail -->
                    <input type="email" name="email" placeholder="Entrer votre email" value=<?php echo $mail_p ;?> required class="box">
                    <!-- Bouton pour appliquer les modifications -->
                    <div class="align-center">
                        <input type="submit" name="submit" value="Appliquer les Modification" class="btn">
                    </div>
                </div>
            </form>
        </section>
    </div>
        <!-- Script JavaScript pour afficher l'image sélectionnée -->
    <script>
        function showFile(input) {
            var file = input.files[0];
            if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
            var pdfContainer = document.getElementById('pdfContainer');
            pdfContainer.innerHTML = '<img src="' + e.target.result + '" alt="Profile Image" class="center" />';
            }
            reader.readAsDataURL(file);
        }
        }

    </script>
</body>
</html>
