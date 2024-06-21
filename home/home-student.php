<?php
session_start();
if (!isset($_SESSION['logged_in_s']) || $_SESSION['logged_in_s'] !== true) {
    header('Location: ../student/login-student.php'); 
    exit();
}

include '../components/connect.php'; 

function inscrire($email, $titre) {
    global $con;  // Use the database connection from the global scope
    $stmt = $con->prepare("INSERT INTO cours_students (email, titre) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $titre);
    $stmt->execute();
}



if (isset($_POST['inscrire']) && isset($_POST['titre'])) {
    inscrire($_SESSION['email_student'], $_POST['titre']);  // Call the function with the session email and posted titre
    header("Location: home-student.php");  // Feedback message
} 
if(isset($_POST['search'])) {

    $searchValue = $_POST['search'];
    header('Location: ../student/rechercher-cours.php?search=' . urlencode($searchValue)); 
} 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/home-student.css">
    <title>Edunest - Etudiant</title>
</head>
<body>
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-student.php'; ?>

    <form action="" method="post">
            <input type="text" name="search" placeholder="Rechercher un cours à s'inscrire" class="rechercher-cours" maxlength="50">
    </form>
    <div class="body-cours clearfix">
    <h1 align="center" class="tite">Mes Cours</h1>
    <?php
    $student_email =  $_SESSION['email_student'];  // Dynamically set based on logged-in user
    
    // Prepare the SQL query to fetch course title and professor details
    $stmt = $con->prepare("
        SELECT cs.titre, p.nom, p.prenom
        FROM cours_students cs
        JOIN cours c ON cs.titre = c.titre
        JOIN professors p ON c.email = p.email
        WHERE cs.email = ?


        
    ");
    $stmt->bind_param("s", $student_email);
    $stmt->execute();
    $result = $stmt->get_result();
  //  $i=0;

    if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
         //   if ($i >= 5) break;
          //  $i++;
            echo '<div class="box-cours">';
            echo '<h1 class="nom-du-cours">'. htmlspecialchars($row['titre']) .'</h1>';
            echo '<a href="../student/afficher-cours.php?cours='. urlencode($row['titre']) .'" class="button-contenu">Afficher</a>';
            echo '<h3 class="mot-cle">Professeur : '. htmlspecialchars($row['prenom'] . ' ' . $row['nom']) .'</h3>';
            //echo '<a href="../cours/'. htmlspecialchars($row['nom_pdf']) .'" class="button-modifier">Télécharger</a>';
            echo '</div>';
        }
    } else {
        echo '<p>No courses found for this student.</p>';
    }
    ?>
</div>


    <div class="body-cours clearfix">
    <h1 align="center" class="tite">Cours à inscrire</h1>
    <?php
    // Assuming the student's email is stored in the session
    $student_email = $_SESSION['email_student'];

    // Modify the SQL query to exclude courses the student is enrolled in
    $sql = "SELECT c.titre, p.nom, p.prenom 
            FROM cours c 
            JOIN professors p ON c.email = p.email
            LEFT JOIN cours_students cs ON cs.titre = c.titre AND cs.email = ?
            WHERE cs.email IS NULL";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $student_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
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
        echo '<p>Aucun cours disponible pour l\'inscription.</p>';
    }

    $con->close();
    ?>
    </div>

    <script src="../js/script.js"></script>

</body>
</html>