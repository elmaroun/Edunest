<!DOCTYPE html>
<html>
<head>
    <!-- Titre de la page affichée dans l'onglet du navigateur -->
    <title>EduNest - Professeur</title>
    <!-- Importation de font Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Importation d'une feuille de style pour la mise en forme -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
    <!-- Importation d'une feuille de style pour l'en-tête de la page -->
    <link rel="stylesheet" href="../css/header-home.css">
    <!-- Inclusion du fichier PHP pour l'en-tête de la page -->
    <?php include '../components/header.php';
    ?>

    <div class="center-container">
        <!-- Section contenant le formulaire -->
        <section class="form-container">
             <!-- Formulaire de connexion avec une classe "login" et une marge supérieure de 10% -->
            <form class="login" style='margin-top: 10%' action="" method="post">
                <!-- Titre indiquant que la demande a été envoyée avec succès -->
                <h3 align="center"> La demande est envoyée avec succès!</h3> <br>
                <!-- Message indiquant que le compte sera supprimé dans les 24 heures -->
                <h5 align="center"> Votre compte sera supprimer dès que l`Admin accepte. </h5> <br>
                <div class="input-group">S
                    <!-- Lien pour revenir à la page d'accueil avec une mise en forme personnalisée -->  
                    <p class="link"><a href="../home/home-professor.php" style="font-weight: bold; bottom:40px;position:absolute;" align="center">Revenir Au page home</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- Importation d'un script JavaScript -->
    <script src="../js/script.js"></script>

</body>
</html>
