<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- CSS local -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
    <!-- Inclure le fichier du header -->
    <link rel="stylesheet" href="../css/header.css">
    // Inclure le fichier du header
    <?php include '../components/header.php';
        // Afficher un message de succès
            echo "data inserted successfully";
    ?>

    <div class="center-container">
        <section class="form-container">
            <!-- Formulaire de confirmation de compte créé avec succès -->
            <form class="login" style='margin-top: 13%' action="" method="post">
                <!-- Titre -->
                <h3>Compte Cree Avec Succès</h3>
                <div class="input-group">
                    <!-- Lien pour revenir à la page de connexion -->
                        <p class="link"><a href="login-student.php" style="font-weight: bold; " align="center">Revenir Au page de connexion</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
