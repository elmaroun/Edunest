<!DOCTYPE html>
<html>
<head>
    <title>Login admin</title>
    <!-- Inclure la police Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <!-- Inclure les icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Inclure le fichier CSS pour le formulaire de connexion -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
    <!-- Inclure le fichier du header -->
    <link rel="stylesheet" href="../css/header.css">
    <?php 
    // Inclure le fichier du header
    include '../components/header.php';
    // Afficher un message de confirmation de l'insertion des données
    echo "donner entree avec succès"; 
    ?>

    <div class="center-container">
        <section class="form-container">
            <!-- Formulaire de confirmation de création de compte -->
            <form class="login" style='margin-top: 13%' action="" method="post">
                <h3>Compte Cree Avec Succès</h3>
                <div class="input-group">
                    <!-- Lien pour revenir à la page de connexion -->
                    <p class="link"><a href="login-admin.php" style="font-weight: bold; " align="center">Revenir Au page de connexion</a></p>
                </div>
            </form>
        </section>
    </div>
</body>
</html>