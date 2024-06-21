<!DOCTYPE html>
<html>
<head>
    <title>EduNest - Professeur</title>
    <!-- Inclusion du font de caractères et des styles CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
     <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header.php';?>

    <!-- Conteneur principal -->
    <div class="center-container">
        <section class="form-container">
            <!-- Formulaire de confirmation de création de compte -->
            <form class="login" style='margin-top: 13%' action="" method="post">
                <!-- Titre de confirmation -->
                <h3>Compte Crée Avec Succès</h3>
                <!-- Groupe d'éléments pour le lien de retour à la page de connexion -->
                <div class="input-group">
                        <p class="link"><a href="login-professor.php" style="font-weight: bold; " align="center">Revenir Au page de connexion</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
