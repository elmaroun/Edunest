<!DOCTYPE html>
<html>
<head>
    <title>EduNest - Professeur</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
    <?php  include '../components/connect.php'; ?>
    <link rel="stylesheet" href="../css/header-home.css">
    <!-- Inclusion de l'en-tête de la page -->
    <?php include '../components/header-home-professor.php'; ?>

    <!-- Conteneur central -->
    <div class="center-container">
        <!-- Section du formulaire -->
        <section class="form-container">
            <!-- Formulaire de connexion -->
            <form class="login" style='margin-top: 10%' action="" method="post">
                <!-- Titre du formulaire -->
                <h3>Cours ajouté avec succès</h3>
                <!-- Groupe d'éléments d'interface utilisateur -->
                <div class="input-group">
                    <!-- Liens pour revenir à la page d'accueil ou ajouter un autre cours -->
                        <p class="link"><a href="../home/home-professor.php" style="font-weight: bold; bottom:40px;position:absolute;" align="center">Revenir à la page home</a></p>
                        <p class="link"><a href="ajouter-cours.php" style="font-weight: bold;bottom:40px; right:30px; position:absolute ; "align="center">Ajouter un autre cours</a></p>

                    </div>
                </div>
            </form>
        </section>
    </div>
    <script src="../js/script.js"></script>  <!-- Inclusion du script JavaScript -->
</body>
</html>
