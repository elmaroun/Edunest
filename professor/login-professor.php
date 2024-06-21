<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';

// Démarrage de la session PHP
session_start();
// Initialisation d'une variable pour stocker les messages à afficher
$message = '';

// Vérification si le formulaire a été soumis
if(isset($_POST['submit'])) {
    // Récupération de l'email et password soumis dans le formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed= hash('sha1', $password);


    // Vérification si le mot de passe imcorrect:
    $check_login = "SELECT * FROM professors WHERE email = '$email'";
    $login_result = mysqli_query($con, $check_login);

    // Si l'email existe
    if(mysqli_num_rows($login_result) > 0) {
        // Vérification si le mot de passe est correct pour cet email
        $check_password = "SELECT * FROM professors WHERE password = '$hashed' AND email = '$email'";
        $password_result = mysqli_query($con, $check_password);
        // Si le mot de passe est correct
        if(mysqli_num_rows($password_result) > 0) {
           // Définition de la variable de session pour indiquer la connexion
            $_SESSION['logged_in_p']=true;
            // Stockage de l'email dans la variable de session
            $_SESSION['email_professor'] = $email;
            // Redirection vers la page d'accueil du professeur
            header("Location: ../home/home-professor.php");
            exit();

            // Affichage des messages selon les cas
        } else {
            $message = "<h2 style='color: red;'>Mot de passe incorrect!</h2>";
        }
    } 
    else {
        $message = "<h1 style='color: red;'>Email n'existe pas !</h1>";
    }
}

?>
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
    <link rel="stylesheet" href="../css/header.css">
    <!-- Inclusion du fichier PHP pour l'en-tête de la page -->
    <?php include '../components/header.php';?>

    <div class="center-container">
        <section class="form-container">
        <!-- Affichage du message d'erreur-->
        <?php echo $message; ?>
            <!-- Formulaire de connexion -->
            <form class="login" action="" method="post">
                <h3>Connectez-vous (Professeur)</h3>
                <div class="input-group">
                    <!-- Champs pour l'email et le mot de passe -->
                    <input type="email" name="email" placeholder="Entrer votre email" required class="box">
                    <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
                    
                    <div class="align-center">
                        <!-- Bouton de soumission du formulaire et lien vers la page d'inscription -->
                        <input type="submit" name="submit" value="Se connecter" class="btn">
                        <p class="link">Vous n'avez pas de compte?<a href="register-professor.php" style="font-weight: bold;">Inscrivez-vous</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>