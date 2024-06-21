<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Initialisation du message
$message = '';
// Démarrage de la session
session_start();
// Vérification de l'envoi du formulaire
if(isset($_POST['poser_question'])) {
    // Récupération de la question et du cours depuis le formulaire
    $question = $_POST['question'];
    $cours = $_GET['cours'];
    // Vérification de la session de l'étudiant
    if (isset($_SESSION['email_student'])) {
        // Récupération des emails
        $email_sender = $_SESSION['email_student'];
        $student_email = $_SESSION['email_student'];
        // Récupération de l'email du destinataire à partir du cours
        $stmt1 = $con->prepare(" 
        SELECT email FROM cours  WHERE titre = ?
        
    ");
    $stmt1->bind_param("s", $cours);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $row1 = $result1->fetch_assoc();
    $email_receiver =  $row1['email'];
    // Insertion de la question dans la base de données
    $sql = "INSERT INTO questions (question, email_sender, email_receiver, cours) 
                VALUES ('$question',  '$email_sender', '$email_receiver', '$cours')";
    $result = mysqli_query($con, $sql);
    if(!$result) {
            $message = "<h2 style='color: red;'>Échec de l'envoi de la question!</h2>";
        }
    } else {
        $message = "<h2 style='color: red;'>Session email not set.</h2>";
    }
}
// Récupération du cours depuis l'URL
$cours = $_GET['cours'];
$email_sender = $_SESSION['email_student'];
// Récupération des questions posées par l'étudiant pour ce cours
$query = "SELECT question, answer FROM questions WHERE email_sender = ? AND cours = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ss", $email_sender, $cours);
$stmt->execute();
$result = $stmt->get_result();
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Récupération des annonces pour ce cours
$announcementsQuery = "SELECT announcement FROM announcements WHERE cours = ?";
$stmt = $con->prepare($announcementsQuery);
$stmt->bind_param("s", $cours);
$stmt->execute();
$result = $stmt->get_result();
$announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                echo '<h4  style="margin: 40px 0px 10px; "> Prérequis : </h4> <p>'.$prerequis.'</p>';
                ?>
                <!-- Affichage de la description du cours -->
                <h4  style="margin: 40px 0px 10px; "> Description du cours : </h4> <?php echo $description ?>
                <!-- Affichage des mots clés -->
                <h4  style="margin: 20px 0px 10px; "> Mot Clés :   </h4> <?php echo $mots_cle ?>                   
                    <?php
                // Récupération et affichage des PDF associés au cours
                $query = "SELECT * FROM pdf WHERE titre = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $cours);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $nom_pdf = $row["nom_pdf"];
                    $sous_titre=$row["sous_titre"]; ?>  
                    <div class="course-pdf">
                    <?php echo '<h2>'.htmlspecialchars($sous_titre).'</h2>';?>
                        <iframe src="../cours/cours-pdf/<?php echo $nom_pdf; ?>" width="100%" height="500px"></iframe>
                        <div class="course-pdf-download">
                        <a href="../cours/cours-pdf/<?php echo $nom_pdf; ?>" class="btn" target="_blank">Télécharger le cours PDF</a>
                    </div>
                    </div>
                    
                <?php } ?>
                <?php
                // Récupération et affichage des vidéos associées au cours
                $query = "SELECT * FROM video WHERE titre = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $cours);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $nom_video = $row["nom_video"];
                    $sous_titre=$row["sous_titre"]; ?>
                    <div class="course-pdf">
                    <?php echo '<h2>'.htmlspecialchars($sous_titre).'</h2>';?>
                    <video controls width="100%" height="400px">
                        <source src="../cours/cours-video/<?php echo $nom_video; ?>" type="video/mp4">
                    </video>
                    <div class="course-video-download">
                        <a href="../cours/cours-video/<?php echo $nom_video; ?>" class="btn" target="_blank">Télécharger la vidéo</a>
                    </div>
                    </div>
<?php } ?>
<?php
// Récupération et affichage des link
$query = "SELECT * FROM link WHERE titre = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $cours);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $nom_link = $row["nom_link"];
    $sous_titre=$row["sous_titre"]; ?>


<div class="course-pdf">
    <?php echo '<h2>'.htmlspecialchars($sous_titre).'</h2>';?>
    <a href="<?php echo $nom_link; ?>" target="_blank" ><?php echo $nom_link; ?></a>
</div>

<?php } ?>
 
    
                <div class="question-form">
                    <h4 style="margin: 40px 0px 10px;">Besoin d'aide ? Posez vos questions au professeur :</h4>
                    <form action="" method="post">
                        <textarea class="box_description" name="question" placeholder="Posez votre question ici" rows="10"></textarea> <br>
                        <input type="submit" name="poser_question" value="Envoyer la question" class="btn">
                    </form>
                    <?php if (!empty($questions)): ?>
                    <h4  style="margin: 40px 0px 5px; ">Le tableau des questions :</h4>
                        <div class="question-form">
                            <table align="center">
                                <thead>
                                     <tr>
                                         <th id="sender-question">Question</th>
                                         <th id="reply">Réponse</th>
                                     </tr>
                                </thead>
                                <tbody>
                                 <?php
                                 foreach ($questions as $qa) {
                                     echo '<tr>';
                                     echo '<td> <br>' . $qa['question'] . '</td>  ' ;
                                     echo '<td> <br>' . $qa['answer'] . '</td>  ' ;
                                     echo '</tr> <br>';
                                 }
                                 ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>Aucune question n'a été posée pour le moment.</p>
                    <?php endif; ?> 
                </div>

                <h4 style="margin: 40px 0px 10px;">Annonces du cours :</h4>
                <?php
                foreach ($announcements as $announcement) {
                    echo '<div class="announcement-box">' . $announcement['announcement'] . '</div> <br>';
                }
                ?>
                <?php if (empty($announcements)): ?>
                    <p>Aucune annonce n'a été ajoutée pour le moment.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
