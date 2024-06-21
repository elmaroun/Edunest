<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Démarrage de la session
session_start();
// Initialisation du message

$message = '';
// Vérification de la soumission du formulaire

if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed= hash('sha1', $password);

    // Vérification de l'existence de l'email dans la base de données
    $check_login = "SELECT * FROM students WHERE email = ?";
    $stmt = mysqli_prepare($con, $check_login);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $login_result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($login_result) > 0) {
        // Vérification du mot de passe
        $check_password = "SELECT * FROM students WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($con, $check_password);
        mysqli_stmt_bind_param($stmt, "ss", $email, $hashed);
        mysqli_stmt_execute($stmt);
        $password_result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($password_result) > 0) {
            // Authentification réussie, redirection vers la page d'accueil de l'étudiant
            $_SESSION['logged_in_s'] = true;
            header("Location: ../home/home-student.php");
            $_SESSION['email_student']=$email;
            exit();
        } else {
            // Mot de passe incorrect
            $message = "<h2 style='color: red;'>Mot de passe incorrect !</h2>";
        }
    } else {
        $message = "<h1 style='color: red;'>Compte n'existe pas !</h1>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Liens vers les polices et les icônes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Styles CSS -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>
<body>
    <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header.php'; ?>
    <div class="center-container">
        <section class="form-container">
            <!-- Affichage du message d'erreur -->
            <?php echo $message; ?>
            <form class="login" action="" method="post">
                <h3>Connectez-vous (Étudiant)</h3>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Entrer votre email" required class="box">
                    <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
                    <div class="align-center">
                        <input type="submit" name="submit" value="Se connecter" class="btn">
                        <!-- Lien vers la page d'inscription -->
                        <p class="link">Vous n'avez pas de compte? <a href="register-student.php" style="font-weight: bold;">Inscrivez-vous</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
