<?php

// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';

// Récupération de la question depuis l'URL
$question = $_GET['question'];

// Requête pour récupérer la question spécifiée
$query = "SELECT * FROM questions WHERE question = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $question);
$stmt->execute();
$result = $stmt->get_result();

// Initialisation de la variable pour stocker le texte de la question
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $questionText = $row['question'];
} else {
    $questionText = "Question non trouvée";
}

// Traitement du formulaire de réponse lorsque la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de la réponse envoyée via le formulaire
    $response = $_POST['response'];
    // Mise à jour de la réponse dans la base de données
    $updateQuery = 'UPDATE questions SET answer=? WHERE question=?';
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("ss", $response, $question);
    $stmt->execute();

    // Redirection vers une page de confirmation si la mise à jour est réussie
    if ($stmt->affected_rows > 0) {
        header("Location: message-envoyer.php");
        exit();
    } else {
        // Affichage d'une erreur si la mise à jour a échoué
        echo "Erreur : Échec de la mise à jour de la réponse.";
    }
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
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-professor.php'; ?>

    <!-- Conteneur central -->
    <div class="center-container">
        <!-- Section du formulaire de réponse -->
        <section class="form-container">
            <div class="question-form">
                    <!-- Tableau pour afficher la question -->
                    <table align="center">
                        <thead>
                             <tr>
                                 <th id="sender-question" style="color: black;"> La Question</th>
                             </tr>
                        </thead>
                    </table>
                    <!-- Affichage de la question -->
                    <p align="center"><?php echo $question; ?></p>
            </div>
                <br>
            <div align="center" class="response-form">
                <!-- Formulaire pour envoyer la réponse -->
                <h1 align="center" style="color: black;"> La Résponse :</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?question=" . $_GET['question']; ?>">
                        <!-- Champ de saisie de la réponse -->
                        <textarea placeholder="Répondez ici..." class="box_description" name="response"></textarea> <br>
                        <!-- Bouton pour envoyer la réponse -->
                        <button type="submit" class="btn" align="center">Envoyer la réponse</button>
                    </form>

            </div>
        </section>
    </div>
</body>
</html>