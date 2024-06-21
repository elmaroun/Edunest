<?php
// Démarrer une session PHP
session_start();
// Vérifier si le formulaire de déconnexion a été soumis
if(isset($_POST['logout'])) {
    $_SESSION = array();
    // Détruire la session actuelle
    session_destroy();
    // Rediriger l'utilisateur vers la première page commune
    header("Location: ../common/first-page.php");
    // l'arrête de l'exécution 
    exit;
}
?>

<header class="site-header">
        <div class="header-content">
            <!-- Lien vers la page d'accueil de l'étudiant avec mise en forme -->
            <a    href="../home/home-student.php" style="text-decoration: none;width:8cm; color: inherit; ">
            <!-- Image du logo -->
            <img src="../images/logo.png" alt="Logo YourEDU" style="height: 50px; width: 50px; margin-right: 7%; vertical-align: middle;">
            <!-- Titre du site -->
            <h1 style="display: inline-block; vertical-align:middle;">EduNest.</h1>   </a>

            <!-- Bouton "Profil" -->
            <input type="submit" name="profile" value="Profil" class="button-modifier-profile" id="profile-btn">

            <?php
            // Récupérer l'email de l'étudiant depuis la session
            $student_email =  $_SESSION['email_student'];
            // Préparer et exécuter une requête pour récupérer les informations de l'étudiant
            $stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM students WHERE email = ?");
            $stmt->bind_param("s", $student_email);
            $stmt->execute();
            $result = $stmt->get_result();
            // Vérifier s'il y a des résultats
            if ($result->num_rows > 0) {
                // Boucler à travers les résultats et afficher les informations de l'étudiant
                while ($row = $result->fetch_assoc()) {
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $photo_profile=$row['photo_de_profile'];
                    // Afficher le profil de l'étudiant avec son image, nom et prénom
                    echo '<div class="profile-pop-up">
                    <img src="../photo-profile/'.$photo_profile.'" alt="Profile Image">';
                    echo '<h3 style="color: black;">'. $nom .' '. $prenom .' </h3>';
                    echo '<h4 style="color: black; bold: none;">Student</h4>'
                    ?>
                    <!-- Lien vers la page de profil de l'étudiant -->
                    <a href="../student/profile.php" class="btn">Profil</a>
                    <!-- Formulaire de déconnexion -->
                    <form action="" method="post">
                        <input type="submit" name="logout" value="Se Déconnercter" class="btn_logout">
                    </form>

                </div>
<?php
                }

            } else {
                // Afficher un message d'erreur si aucune donnée n'est trouvée
                echo '<p>error.</p>'; }
    ?>

        </div>
    </header>