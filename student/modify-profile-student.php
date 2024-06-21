<?php 
// Inclusion du fichier de connexion

include '../components/connect.php';
// Définition du répertoire de téléchargement des photos de profil
$uploadDirectory = __DIR__ . '/../photo-profile/';
// Démarrage de la session
session_start();
// Récupération de l'email de l'étudiant depuis la session
$mail_s =  $_SESSION['email_student'];
// Récupération des informations de l'étudiant depuis la base de données
$stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM students WHERE email = ?");
$stmt->bind_param("s", $mail_s);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$nom_s = $row['nom'];
$prenom_s = $row['prenom'];
$photo_profile = $row['photo_de_profile'];
// Traitement du formulaire de modification du profil
if(isset($_POST['submit'])) {
    $new_nom = $_POST['nom'];
    $new_prenom = $_POST['prenom'];
    $new_email = $_POST['email'];
    $_SESSION['email_student'] = $new_email;
    // Vérification si une nouvelle photo de profil a été téléchargée
    if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $file_modifier = basename($_FILES["file"]["name"]);
        $targetPath = $uploadDirectory . $file_modifier;
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath);
    } else {
        $file_modifier = $photo_profile; // Keep the existing photo if no file is uploaded
    }
    // Mise à jour des informations du profil dans la base de données

    $stmt = $con->prepare("UPDATE students SET nom=?, prenom=?, email=?, photo_de_profile=? WHERE email=?");
    $stmt->bind_param("sssss", $new_nom, $new_prenom, $new_email, $file_modifier, $mail_s);
    $stmt->execute();
    header("Location: profile.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/modify-profile-professor.css">
</head>

<body class="login-page">
    <link rel="stylesheet" href="../css/header-student.css">
    <?php include '../components/header-student.php'; ?>

    <div class="center-container"> 
        <section class="form-container">
            <form class="register" action="" method="post" enctype="multipart/form-data">
                <h3>Modifier votre compte</h3>
                <!-- Affichage de l'image de profil actuelle -->
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
                        <div class="display_flex">
                        <label for="file" style="display:block;">Modifier l'image :</label>
                        <!-- Champ pour sélectionner une nouvelle image -->
                        <input type="file" id="file" name="file" accept=".jpg" class="box_profile" onchange="showFile(this)">
                        </div>

                </div>

                <!-- Champs de modification du nom, prénom et email -->
                <div class="input-group">
                    <div class="name-fields">
                        <input type="text" name="nom" value=<?php echo $nom_s ;?> required class="box name">
                        <input type="text" name="prenom"  value=<?php echo $prenom_s ;?> required class="box name">
                    </div>
                    <input type="email" name="email" placeholder="Enter your email" value=<?php echo $mail_s ;?> required class="box">
                    <div class="align-center">
                        <!-- Bouton pour soumettre les modifications -->
                        <input type="submit" name="submit" value="Appliquer les Modification" class="btn">
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- Script pour afficher l'image sélectionnée avant de la télécharger -->
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
