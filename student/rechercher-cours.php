<?php
// Vérification de la session utilisateur

session_start();
// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['logged_in_s']) || $_SESSION['logged_in_s'] !== true) {
    header('Location: ../student/login-student.php'); 
    exit();
}
// Inclusion du fichier de connexion à la base de données

include '../components/connect.php'; 
// Fonction pour inscrire un étudiant à un cours
function inscrire($email, $titre) {
    global $con;  // Utilisation de la connexion à la base de données dans la portée globale
    $stmt = $con->prepare("INSERT INTO cours_students (email, titre) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $titre);
    $stmt->execute();
}

if (isset($_POST['inscrire']) && isset($_POST['titre'])) {
    inscrire($_SESSION['email_student'], $_POST['titre']);  // Call the function with the session email and posted titre
    header("Location: ../home/home-student.php");  // Feedback message
} 

 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- CSS local -->
    <link rel="stylesheet" href="../css/home-student.css">
    <title>HomePage</title>
</head>
<body>
    <!-- Inclure le fichier du header -->
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-student.php';
    $search_Cours = urldecode($_GET['search']); ; 
     $student_email =  $_SESSION['email_student']; 
     ?>

    <div class="body-cours clearfix" style=" margin-top: 3cm; ">
    <?php echo ' <h1 align="center" class="tite"> Resultat pour "'.htmlspecialchars($search_Cours).'"</h1>'; ?>
    <?php 
    // Recherche des cours correspondants à la recherche de l'étudiant
    $searchValue = "%" . $search_Cours . "%"; 

    $stmt = $con->prepare("
        SELECT c.titre, p.nom, p.prenom
        FROM cours c
        JOIN professors p ON c.email = p.email
        WHERE c.titre LIKE ? 
        AND c.titre NOT IN (
            SELECT cs.titre 
            FROM cours_students cs
            WHERE cs.email = ? 
        )
    ");
    
    $stmt->bind_param("ss", $searchValue, $student_email);
    $stmt->execute();
    $result = $stmt->get_result();

    

    if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="box-cours">';
          echo '<form method="post">';
          echo '<h1 class="nom-du-cours">'. htmlspecialchars($row['titre']) .'</h1>';
          echo '<input type="hidden" name="titre" value="'. htmlspecialchars($row['titre']) .'">';
          echo '<a href="../student/afficher-cours-non-inscrit.php?cours='. urlencode($row['titre']) .'" class="button-contenu">Afficher</a>';
          echo '<h3 class="mot-cle">Professeur : '. htmlspecialchars($row['prenom'] . ' ' . $row['nom']) .'</h3>';
          echo '<input type="submit" name="inscrire" value="Inscrire" class="button-modifier">';
          echo '</form>';
          echo '</div>';
        }

    } else {
        echo '<p>Aucun cours trouvé .</p>';
    }
    ?>
</div>
<!-- Inclure le fichier JavaScript -->
<script src="../js/script.js"></script>

</body>
</html>