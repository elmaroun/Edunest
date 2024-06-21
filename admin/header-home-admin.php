<?php
// Démarre une session existante
session_start();
// Vérifie si une demande de déconnexion a été envoyée via POST
if(isset($_POST['logout'])) {
    // Réinitialise toutes les variables de session en les remplaçant par un tableau vide
    $_SESSION = array();
    // Détruit la session en cours, supprimant ainsi toutes les données de session
    session_destroy();
    // Redirige l'utilisateur vers la page de connexion de l'admin
    header("Location: login-admin.php");
    exit;
}
?>

<header class="site-header">
        <div class="header-content">
            <!-- Logo et nom de l'application avec lien vers la page d'accueil de l'administrateur -->
            <a    href="../admin/home-admin.php" style="text-decoration: none;width:8cm; color: inherit; ">
            <img src="../images/logo.png" alt="Logo YourEDU" style="height: 50px; width: 50px; margin-right: 7%; vertical-align: middle;">
            <h1 style="display: inline-block; vertical-align:middle;">EduNest.</h1>   </a>
            <!-- Button de profil" -->
            <input type="submit" name="profile" value="Profil" class="button-modifier-profile" id="profile-btn">
            <!-- l'affichage du profil de l'admin-->
            <?php
            // la récupération de l'e-mail de l'administrateur connecté depuis la session
            $admin_email =  $_SESSION['email_admin'];
            // preparation et exécution de la requête SQL pour récupérer les informations du profil de l'admin
            $stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM admin WHERE email = ?");
            $stmt->bind_param("s", $admin_email);
            $stmt->execute();
            $result = $stmt->get_result();
            // Vérification s'il existe des résultats pour l'admin
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $photo_profile=$row['photo_de_profile'];
                    // Affichage du popup du profil de l'admin
                    echo '<div class="profile-pop-up">
                    <img src="../photo-profile/'.$photo_profile.'" alt="Profile Image">';
                    echo '<h3 style="color: black;">'. $nom .' '. $prenom .' </h3>';
                    echo '<h4 style="color: black; bold: none;">Professeur</h4>'
                    ?>
                    <!-- le lien vers la page de profil de l'admin -->
                    <a href="profile-admin.php" class="btn">Profil</a>
                    <!-- Formulaire de déconnexion de l'administrateur -->
                    <form action="" method="post">
                        <input type="submit" name="logout" value="Se Déconnecter" class="btn_logout">
                    </form>
                <!-- Fermeture du popup du profil de l'administrateur -->
                </div>
<?php
                }

            } else {
            // affichage d'un message d'erreur si aucune information de profil n'est trouvée
                echo '<p>error.</p>'; }
    ?>

        </div>
    </header>