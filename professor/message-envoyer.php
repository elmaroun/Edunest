<!DOCTYPE html>
<html>
<head>
    <!-- Titre de la page affichée dans l'onglet du navigateur -->
    <title>EduNest - Professeur</title>
    <!-- Importation d'une police Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Importation d'une feuille de style pour la mise en forme -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
    <!-- Importation d'une feuille de style pour l'en-tête de la page -->
    <link rel="stylesheet" href="../css/header-home.css">
    <!-- Inclusion du fichier d'en-tête -->
    <?php include '../components/header.php';
    ?>

    <div class="center-container">
        <!-- Section contenant le formulaire -->
        <section class="form-container">
            <!-- Formulaire de connexion avec une classe "login" et une marge supérieure de 10% -->
            <form class="login" style='margin-top: 10%' action="" method="post">
                <!-- Titre indiquant que la réponse a été envoyée -->
                <h3> La réponse est envoyée </h3>
                 <!-- Groupe d'éléments d'entrée -->
                <div class="input-group">
                        <!-- Lien de retour à la page d'accueil -->
                        <p class="link"><a href="../home/home-professor.php" style="font-weight: bold; bottom:40px;position:absolute;" align="center">Revenir Au page home</a></p>
                       <!-- Lien pour ajouter un autre cours -->
                        <p class="link"><a href="ajouter-cours.php" style="font-weight: bold;bottom:40px; right:30px; position:absolute ; "align="center">ajouter un autre cours</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- Importation d'un script JavaScript -->
    <script src="../js/script.js"></script>

</body>
</html>
