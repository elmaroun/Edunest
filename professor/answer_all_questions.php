<?php
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';

// Démarrage de la session
session_start();

// Vérification de l'existence de la session de l'enseignant
if (!isset($_SESSION['email_professor'])) {

    // Redirection vers la page de connexion si l'enseignant n'est pas connecté
    header("Location: login.php"); 
    exit();
}

// Vérification de la spécification du cours dans l'URL
if (!isset($_GET['cours'])) {
    // Affichage d'une erreur si le cours n'est pas spécifié
    echo "Erreur : Cours non spécifié.";
    exit();
}

// Récupération du nom du cours depuis l'URL
$cours = $_GET['cours'];

// Requête pour récupérer les questions associées au cours spécifié
$query = "SELECT question FROM questions WHERE cours = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $cours);
$stmt->execute();
$result = $stmt->get_result();

// Initialisation d'un tableau pour stocker les questions
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row['question'];
}

// Traitement du formulaire de réponse lorsque la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = $_POST['response']; 
    foreach ($questions as $question) {
        $updateQuery = "UPDATE questions SET answer = ? WHERE question = ?";
        $stmt = $con->prepare($updateQuery);
        $stmt->bind_param("ss", $response, $question);
        $stmt->execute();
    }
    // Redirection vers une page de confirmation d'envoi de réponse
    header("Location: message-envoyer.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>EduNest - Professeur</title>
    <!-- Chargement des polices Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <!-- Chargement des icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Inclusion de la feuille de style CSS pour la page de réponse aux questions -->
    <link rel="stylesheet" href="../css/repondre-question.css">
</head>
<body>
    <!-- Inclusion de l'en-tête de la page -->
    <?php include '../components/header.php'; ?>

    <!-- Conteneur central -->
    <div class="center-container">

        <!-- Section du formulaire de réponse -->
        <section class="form-container">
            <div class="question-form">

                <!-- Titre de la section -->
                <h2 align="center"> Répondre à toutes les questions pour le cours : <?php echo $cours; ?></h2>
                <?php if (empty($questions)) : ?>

                    <!-- Affichage si aucune question n'est disponible pour le cours -->
                    <p align="center">Il n'y a pas de questions pour ce cours.</p>
                    <!-- Lien pour retourner au cours -->
                    <a href= ../professor/afficher-cours.php?cours=<?php echo urlencode($cours); ?>"><i class="fas fa-arrow-left"></i> Retour au cours</a>
                <?php else : ?>
                    <!-- Formulaire de réponse aux questions -->
                    <div align="center" class="response-form">
                        <form method="post">
                            <!-- Champ de saisie de la réponse -->
                            <textarea placeholder="Répondez ici..." class="box_description" name="response"></textarea> <br>
                            <!-- Bouton d'envoi de la réponse -->
                            <input type="submit" name="submit" value="Envoyer la réponse" class="btn">
                        </form> 
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</body>
</html>
