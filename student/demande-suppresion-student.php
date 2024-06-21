<!DOCTYPE html>
<html>
<head>
    <title>Reponse envoyee!</title>
    <!-- Liens vers les polices et les icônes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Styles CSS -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
    <!-- Inclusion de l'en-tête -->

    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header.php';
    ?>

    <div class="center-container">
        <section class="form-container">
            <form class="login" style='margin-top: 10%' action="" method="post">
                <!-- Message de confirmation -->
                <h3 align="center"> La demande est envoyée avec succès!</h3> <br>
                <h5 align="center"> Votre compte sera supprimer dès que l'admin accepte </h5> <br>
                <div class="input-group">
                        <!-- Lien pour revenir à la page d'accueil -->
                        <p class="link"><a href="../home/home-student.php" style="font-weight: bold; bottom:40px;position:absolute;" align="center">Revenir Au page home</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- Script JavaScript -->
    <script src="../js/script.js"></script>

</body>
</html>
