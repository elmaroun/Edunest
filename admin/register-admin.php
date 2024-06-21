<?php 
// Inclure le fichier de connexion à la base de données
include '../components/connect.php';

// Initialisation du message d'erreur ou de succès
$message = '';

// Vérifier si le formulaire d'inscription a été soumis
if(isset($_POST['submit'])) {

    // Récupérer les données saisies par l'utilisateur
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed= hash('sha1', $password);
    // Définir une photo de profil par défaut
    $photo_profile = 'profile-admin.jpg';

    // Vérifier si l'email existe déjà dans la base de données
    $check_query = "SELECT * FROM admin WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    // si l'email existe déjà, afficher un message d'erreur
    if(mysqli_num_rows($check_result) > 0) {
        $message = "<h1 style='color: red;'>Email already exists!</h1>";
    } else {
        // sinon, on insere les données dans la base de données
        $sql = "INSERT INTO admin (nom, prenom, email, password,photo_de_profile) VALUES ('$nom', '$prenom', '$email', '$hashed','$photo_profile')";
        $result = mysqli_query($con, $sql);

        // si l'insertion est réussie, rediriger vers la page de confirmation
        if($result) {
            header("Location: register-admin-done.php");
            exit();
        } else {
            // Sinon, afficher un message d'erreur
            $message = "<h2 style='color: red;'>Failed to register!</h2>";
        }
    }
}

?>

<html>
<head>
    <title>Edunest - admin</title>
    <!-- Inclure la police Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <!-- Inclure les icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Inclure le fichier CSS pour le formulaire d'inscription -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body class="login-page">
    <!-- Inclure le fichier du header -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header.php';?>

    <div class="center-container"> 
        <section class="form-container">
            <!-- Afficher le message d'erreur ou de succès -->
            <?php echo $message; ?>
            <!-- Formulaire d'inscription pour l'administrateur -->
            <form class="register" action="" method="post" enctype="multipart/form-data">
                <h3>Créez votre compte  (Admin)</h3>
                <div class="input-group">
                    <div class="name-fields">
                        <!-- Champs pour saisir le prénom et le nom -->
                        <input type="text" name="prenom" placeholder="Prénom" required class="box name">
                        <input type="text" name="nom" placeholder="Nom" required class="box name">
                    </div>
                    <!-- Champ pour saisir l'email -->
                    <input type="email" name="email" placeholder="Entrer votre email" required class="box">
                    <!-- Champ pour saisir le mot de passe -->
                    <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
                    <div class="align-center">
                        <!-- Bouton de soumission du formulaire -->
                        <input type="submit" name="submit" value="S'INSCRIRE" class="btn" >
                        <!-- Lien pour rediriger vers la page de connexion -->
                        <p class="link">Vous avez déja un compte? <a href="login-admin.php" style="font-weight: bold;">Connectez-vous</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>