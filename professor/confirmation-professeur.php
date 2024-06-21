<?php

// Démarrage de la session PHP
session_start();

// Vérification si le bouton "Confirmer" a été soumis
if(isset($_POST['confirm'])) {
    
    // Inclusion du fichier de connexion à la base de données
    include '../components/connect.php';

    // Récupération de l'email de l'utilisateur connecté à partir de la session
    $email_user = $_SESSION['email_professor'];

    // Requête pour récupérer le nom et le prénom du professeur à partir de son email
    $stmt = $con->prepare("SELECT nom, prenom FROM professors WHERE email = ?");
    $stmt->bind_param("s", $email_user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si les données du professeur sont trouvées, insertion de la demande de suppression dans la base de données
    if ($row = $result->fetch_assoc()) {
        $nom_user = $row['nom'];
        $prenom_user = $row['prenom'];

        // Requête pour insérer la demande de suppression dans la table des demandes
        $stmt = $con->prepare("INSERT INTO demandes (nom, prenom, email_user) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nom_user, $prenom_user, $email_user);
        $stmt->execute();

        // Redirection vers la page de confirmation de la demande de suppression
        header("Location: demande-suppresion-professeur.php");
        exit();
    } else {
        // Affichage d'une erreur si les données du professeur ne sont pas trouvées
        echo "Erreur : Données du professeur non trouvées.";
    }
    // Si le bouton "Annuler" est soumis, redirection vers la page d'accueil du professeur
} elseif(isset($_POST['cancel'])) {
    header("Location: ../home/home-professor.php");
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>EduNest - Professeur</title>
        <!-- Chargement du font Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <!-- Inclusion de la feuille de style CSS pour la page de confirmation de suppression -->
    <link rel="stylesheet" href="../css/repondre-question.css">
    
</head>
<body>
    <!-- Conteneur central -->
    <div class="center-container">
        <!-- Section du formulaire de confirmation -->
        <section class="form-container">
            <!-- Titre de la page -->
            <h2 align="center" >Confirmez-vous la suppression de votre profil ?</h2>
            <!-- Formulaire avec deux boutons : "Oui" pour confirmer et "Non" pour annuler -->
            <form action="" method="post">
                <div align="center" class="btn-group"> 
                    <!-- Bouton pour confirmer la suppression -->
                    <input type="submit" name="confirm" value="Oui" class="btn">
                    <!-- Bouton pour annuler la suppression -->
                    <input type="submit" name="cancel" value="Non" class="btn">
                </div>
            </form>
        </section>
    </div>
</body>
</html>
