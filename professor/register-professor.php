<?php
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';

// Initialisation d'une variable pour les messages
$message = '';

// Traitement du formulaire d'inscription
if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed= hash('sha1', $password);

    // Image de profil par défaut
    $photo_profile = 'profile-professor.jpg';

    // Vérification si l'email existe déjà dans la base de données
    $check_query = "SELECT * FROM professors WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // Message d'erreur si l'email existe déjà
        $message = "<h1 style='color: red;'>Email already exists!</h1>";
    } else {
        // Insertion des données dans la base de données si l'email n'existe pas déjà
        $sql = "INSERT INTO professors (nom, prenom, email, password,photo_de_profile) VALUES ('$nom', '$prenom', '$email', '$hashed','$photo_profile')";

        $result = mysqli_query($con, $sql);

        if($result) {
            // Redirection vers la page de confirmation d'inscription en cas de succès
            header("Location: register-professor-done.php");
            exit();
        } else {
            // Message d'erreur en cas d'échec de l'inscription
            $message = "<h2 style='color: red;'>Failed to register!</h2>";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Inclusion de la police de caractères et des styles CSS -->
    <title>EduNest - Professeur</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login-register.css">
</head>

<body class="login-page">
    <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header.php';?>

    <!-- Conteneur principal -->
    <div class="center-container"> 
        <section class="form-container">
            <!-- Affichage du message d'erreur ou de confirmation -->
            <?php echo $message; ?>
            <!-- Formulaire d'inscription -->
            <form class="register" action="" method="post" enctype="multipart/form-data">
                <h3>Créez votre compte (Prefesseur)</h3>
                <!-- Groupe d'éléments pour les champs de nom, prénom, email et mot de passe -->
                <div class="input-group">
                    <div class="name-fields">
                        <input type="text" name="prenom" placeholder="Nom" required class="box name">
                        <input type="text" name="nom" placeholder="Prénom" required class="box name">
                    </div>
                    <input type="email" name="email" placeholder="Entrer votre email" required class="box">
                    <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
                    <!-- Bouton pour soumettre le formulaire -->
                    <div class="align-center">
                        <input type="submit" name="submit" value="S'INSCRIRE" class="btn" >
                        <!-- Lien pour rediriger vers la page de connexion -->
                        <p class="link">Vous avez déja un compte? <a href="login-professor.php" style="font-weight: bold;">Login now</a></p>
                    </div>
                </div>
            </form>
            
        </section>
    </div>

</body>
</html>