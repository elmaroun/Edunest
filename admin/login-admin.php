<?php 
// L'inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Démarrage de session
session_start();

// Message qui sera affiché en cas d'erreur de connexion
$message = '';

// Vérifier si le formulaire de connexion a été soumis
if(isset($_POST['submit'])) {
// Récupérer l'email et le mot de passe saisis par l'utilisateur
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed= hash('sha1', $password);

    // Vérification si le mot de passe imcorrect:
    $check_login = "SELECT * FROM admin WHERE email = '$email'";
    $login_result = mysqli_query($con, $check_login);
    
    // Si l'email existe
    if(mysqli_num_rows($login_result) > 0) {
        // verification si le mot de passe est correct
        $check_password = "SELECT * FROM admin WHERE password = '$hashed' AND email = '$email'";
        $password_result = mysqli_query($con, $check_password);
        // si le mot de passe est correct
        if(mysqli_num_rows($password_result) > 0) {
        // stocker l'email de l'administrateur dans la session
            $_SESSION['email_admin'] = $email;
           
            // rediriger vers la page d'accueil de l'administrateur
            header("Location: home-admin.php");
            exit();
        // Afficher des messages selons les cas
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
    <title>Login</title>
        <!-- Inclure le font Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Inclure le fichier CSS pour le formulaire de connexion -->
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body>
   
    <!-- Inclure le fichier du header -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header.php';?>

    <div class="center-container">
        <section class="form-container">
        <!-- Afficher le message d'erreur -->
        <?php echo $message; ?>
            <!-- Formulaire de connexion -->
            <form class="login" action="" method="post">
                <h3>Connectez-vous (Admin)</h3>
                <div class="input-group">
                    <!-- Le champ pour saisir l'email -->
                    <input type="email" name="email" placeholder="Entrer votre email" required class="box">
                    <!-- Le champ pour saisir le mot de passe -->
                    <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
                    <div class="align-center">
                    <!-- button de soumission du formulaire -->
                    <input type="submit" name="submit" value="Se connecter" class="btn">
                    <!-- le lien vers la page d'inscription -->
                    <p class="link">Vous n'avez pas de compte? <a href="register-admin.php" style="font-weight: bold;">Inscrivez-vous</a></p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>