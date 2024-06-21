<?php 
// Inclusion du fichier de connexion à la base de données

include '../components/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Inclusion des feuilles de style -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
    <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-student.php'; ?>

    <div class="center-container">
        <section class="form-container">
            <!-- Formulaire de confirmation -->
            <form class="login" style='margin-top: 13%' action="" method="post">
                <!-- Titre de confirmation -->
                <h3>Question envoyée avec succès!</h3>
                <div class="input-group">
                        <!-- Lien pour retourner à la page d'accueil -->
                        <p class="link"><a href="../home/home-student.php" style="font-weight: bold; " align="center">Revenir Au home</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- Inclusion du script JavaScript -->
    <script src="../js/script.js"></script>
</body>
</html>