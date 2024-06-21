<?php

// Démarrage de la session

session_start();
// Vérification de l'envoi du formulaire de confirmation

if(isset($_POST['confirm'])) {
    // Inclusion du fichier de connexion à la base de données   
    include '../components/connect.php';
    // Récupération de l'email de l'utilisateur
    $email_user = $_SESSION['email_student'];
    // Récupération du nom et prénom de l'utilisateur
    $stmt = $con->prepare("SELECT nom, prenom FROM students WHERE email = ?");
    $stmt->bind_param("s", $email_user);
    $stmt->execute();
    $result = $stmt->get_result();
    // Insertion de la demande de suppression dans la base de données
    if ($row = $result->fetch_assoc()) {
        $nom_user = $row['nom'];
        $prenom_user = $row['prenom'];

        $stmt = $con->prepare("INSERT INTO demandes (nom, prenom, email_user) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nom_user, $prenom_user, $email_user);
        $stmt->execute();
        // Redirection vers la page de confirmation de la demande
        header("Location: demande-suppresion-student.php");
        exit();
    } else {
        echo "Error: Professor data not found.";
    }
} elseif(isset($_POST['cancel'])) {
    // Annulation de la demande et redirection vers la page d'accueil de l'étudiant
    header("Location: ../home/home-student.php");
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de suppression</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/repondre-question.css">
    
</head>
<body>
<link rel="stylesheet" href="../css/header.css">
<?php include '../components/header-student.php'; ?>

    <div class="center-container" style="margin-top:220px;">
        <section class="form-container">
            <h2 align="center"> Confirmez-vous la suppression de votre profil ?</h2>
            <form action="" method="post">
                <div align="center" class="btn-group"> 
                    <input type="submit" name="confirm" value="Oui" class="btn">
                    <input type="submit" name="cancel" value="Non" class="btn">
                </div>
            </form>
        </section>
    </div>
</body>
</html>
