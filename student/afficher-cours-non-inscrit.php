<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Initialisation du message

$message = '';
// Démarrage de la session

session_start();
// Vérification de l'envoi du formulaire
if(isset($_POST['submit'])) {
    $question = $_POST['question'];
    $answers = $_POST['answer']; 
    // Vérification de la session de l'étudiant
    if (isset($_SESSION['email_student'])) {
        // Récupération des emails
         $email_sender = $_SESSION['email_student'];
        $student_email = $_SESSION['email_student'];
        $email_receiver =  $_SESSION['mail'];
        // Récupération du cours

        $cours = $_GET['cours'];
                // Requête d'insertion dans la base de données

        $sql = "INSERT INTO questions (question, answer, email_sender, email_receiver, cours) 
                VALUES ('$question', '$answers', '$email_sender', '$email_receiver', '$cours')";
        $result = mysqli_query($con, $sql);
        // Redirection en cas de succès

        if($result) {
            header("Location: question-done.php"); 
            exit();
        } else {
            $message = "<h2 style='color: red;'>Échec de l'envoi de la question!</h2>";
        }
    } else {
        $message = "<h2 style='color: red;'>Session email not set.</h2>";
    }
}
// Récupération du cours depuis l'URL

$cours = $_GET['cours'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Les cours d'Etudiant</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/afficher-cours-student.css">
</head>
<body>
    <!-- Inclusion de l'en-tête -->

    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-student.php'; ?>

    <div class="center-container">
        <section class="form-containers">
            <div class="course">
                <?php
                // Récupération des détails du cours depuis la base de données

                $cours = $_GET['cours'];
                $stmt = $con->prepare("SELECT * FROM cours WHERE titre = ?");
                $stmt->bind_param("s", $cours);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $mots_cle = $row["mots_cles"];
                $description = $row["description"];
                $public_vise = $row["public_vise"];
                $prerequis = $row["prerequis"];
                $nombre_pdf = $row['nombre_pdf'];
                $nombre_link = $row['nombre_link'];
                $nombre_videos = $row['nombre_videos'];

                // Affichage des détails du cours

                echo '<h2 class="add-course-title">'.$cours.'</h2>';
                echo '<h4  style="margin: 40px 0px 10px; "> Prerequis : </h4> <p>'.$prerequis.'</p>';
                
                ?>
                <!-- Affichage de la description du cours -->

                <h4  style="margin: 40px 0px 10px; "> Description du cours : </h4> <?php echo $description ?>
                <!-- Affichage des mots clés -->

                <h4  style="margin: 20px 0px 10px; "> Mot Cles :   </h4> <?php echo $mots_cle ?>  
                    
 






 
    
 
                
            </div>
        </section>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
