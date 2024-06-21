<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';

// Initialisation du message
$message = '';

// Vérification si le formulaire d'inscription a été soumis
if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed= hash('sha1', $password);

    // Définition de l'image de profil par défaut
    $photo_profile = 'profile-student.jpg';

    // Vérification si l'email existe déjà dans la base de données
    $check_query = "SELECT * FROM students WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // Message d'erreur si l'email existe déjà
        $message = "<h1 style='color: red;'>Email already exists!</h1>";
    } else {
        // Insertion des données dans la base de données si l'email n'existe pas déjà
        $sql = "INSERT INTO students (nom, prenom, email, password,photo_de_profile) VALUES ('$nom', '$prenom', '$email', '$hashed','$photo_profile')";
        $result = mysqli_query($con, $sql);

        if($result) {
            // Redirection vers la page de confirmation d'inscription en cas de succès
            header("Location: register-student-done.php");
            exit();
        } else {
            // Message d'erreur si l'inscription a échoué
            $message = "<h2 style='color: red;'>Failed to register!</h2>";
        }
    }
}

?>

<html>
<head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- CSS local -->
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
            <!-- Formulaire d'inscription -->
            <form class="register" action="" method="post" enctype="multipart/form-data">
            <!-- Titre -->
            <h3>Créez votre compte (étudiant)</h3>
                <!-- Champs pour le nom et prénom -->
                <div class="input-group">
                    <div class="name-fields">
                        <input type="text" name="prenom" placeholder="Prénom" required class="box name">
                        <input type="text" name="nom" placeholder="Nom" required class="box name">
                    </div>
                    <!-- Champ pour l'email -->
                    <input type="email" name="email" placeholder="Entrer votre email" required class="box">
                    <!-- Champ pour le mot de passe -->
                    <input type="password" name="password" placeholder="Entrer votre mot de passe" required class="box">
                    <div class="align-center">
                        <!-- Bouton de soumission du formulaire -->
                        <input type="submit" name="submit" value="S'INSCRIRE" class="btn" >
                                <!-- Lien vers la page de connexion -->
                        <p class="link">Vous avez déja un compte?<a href="login-student.php" style="font-weight: bold;">Connectez-vous</a></p>
                    </div>
                </div>
            </form>
            
        </section>
    </div>

</body>
</html>
