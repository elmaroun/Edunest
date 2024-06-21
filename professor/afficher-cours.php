<?php 
include '../components/connect.php'; // Inclusion du fichier de connexion à la base de données
?>

<!DOCTYPE html>
<html>
<head>
    <title>EduNest - Professeur</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet"> <!-- Importation des polices de caractères -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> <!-- Importation de Font Awesome -->
    <link rel="stylesheet" href="../css/afficher-cours-professor.css"> 
</head>
<body>
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-professor.php'; ?>

    <!-- Début du corps de la page -->
    <div align="center" class="center-container">
        <section align="center" class="form-containers">
            <div class="course" align="center">
                <?php
                $titre = $_GET['cours'];;
                
                $stmt = $con->prepare("SELECT * FROM cours WHERE titre = ?");
                $stmt->bind_param("s", $titre);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $mots_cles=$row["mots_cles"];
                $description=$row["description"];

                // Récupération des autres détails du cours
                $public_vise=$row["public_vise"];
                $prerequis=$row["prerequis"];
                $nombre_pdf = $row['nombre_pdf'];
                $nombre_link = $row['nombre_link'];
                $nombre_videos = $row['nombre_videos'];

                // Affichage du titre du cours
                echo '<h2 class="add-course-title">'.$titre.'</h2>';
                // Affichage des mots clés du cours
                echo '<h4  style="margin: 40px 0px 10px; "> Prérequis : </h4> <p>'.$prerequis.'</p>';
                ?>
                <!-- Affichage de la description du cours -->
                <h4  style="margin: 20px 0px 10px; "> Description du cours : </h4> <?php echo $description ?>
                <!-- Affichage des mots clés du cours -->
                <h4  style="margin: 20px 0px 10px; "> Mot Clés :   </h4> <?php echo $mots_cles ?> 

                <!-- Affichage des PDF associés au cours -->
                <?php
                $query = "SELECT * FROM pdf WHERE titre = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $titre);
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

                <!-- Affichage des vidéos associées au cours -->
                <?php
                $query = "SELECT * FROM video WHERE titre = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $titre);
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

                <!-- Affichage des liens associés au cours -->
                <?php
                $query = "SELECT * FROM link WHERE titre = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $titre);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $nom_link = $row["nom_link"];
                    $sous_titre=$row["sous_titre"]; ?>


                    <div class="course-pdf">
                        <?php echo '<h2>'.htmlspecialchars($sous_titre).'</h2>';?>
                        <a href="<?php echo $nom_link; ?>" target="_blank"><?php echo $nom_link; ?></a>
                    </div>

                <?php } ?>

                <!-- Formulaire pour les questions des étudiants -->
                <div class="question-form">
                    <h4  style="margin: 38px 0px 50px; ">Le tableau des questions :</h4>
                    <table align="center">
                        <thead>
                             <tr>
                                 <th id="sender">Etudiant</th>
                                 <th id="sender-email" align="center">Email</th>
                                 <th id="sender-question">Question</th>
                                 <th id="sender"></th>
                             </tr>
                        </thead>
                        <tbody>
                         <?php

                            $query = "SELECT q.email_sender, q.question, q.answer, s.nom, s.prenom
                            FROM questions q
                            INNER JOIN students s ON q.email_sender = s.email
                            WHERE q.cours = ?";

                            $stmt = $con->prepare($query);
                            $stmt->bind_param("s", $titre);
                            $stmt->execute();
                            $result = $stmt->get_result();
                                     
                            while ($row = $result->fetch_assoc()) {
                            echo '<tr> <br>';
                            echo '<td> <br>' . $row['nom'] . ' ' . $row['prenom'] . '</td>  '; 
                            echo '<td> <br>' . $row['email_sender'] . '</td>';
                            echo '<td> <br>' . $row['question'] . '</td>';
                            if ($row['answer'] == NULL) {
                                echo '<td> <br> <a href="answer_page.php?question=' . $row['question'] . '&cours=' . urlencode($titre) . '" class="btn">Répondre</a></td>';
                                echo '</tr>';
                            } else { echo '<td> <br> ✔ </td>'; }

                        }
                            ?>
                        </tbody>
                    </table>

                <!-- Lien pour répondre à toutes les questions -->    
                <a href="answer_all_questions.php?cours=<?php echo urlencode($titre); ?>" class="btn">Répondre à toutes les questions</a>
 
                <!-- Formulaire pour ajouter une annonce -->
                <h4 style="margin: 40px 0px 10px;"> Ajouter une annonce pour les étudiants :</h4>
                <form action="" method="post">
                     <textarea class="box_description" name="announcement_text" placeholder="Entrez votre annonce ici..." rows="5"></textarea><br>
                        <input type="submit" name="add_announcement" value="Ajouter l'annonce" class="btn">
                </form>

                <!-- Traitement pour l'ajout d'une annonce -->
                <?php
                    if (isset($_POST['add_announcement'])) {
                         $announcement_text = $_POST['announcement_text'];
                        $insertQuery = "INSERT INTO announcements (cours, announcement) VALUES (?, ?)";
                        $stmt = $con->prepare($insertQuery);
                        $stmt->bind_param("ss", $titre, $announcement_text);
                        $stmt->execute();
                    }

                ?>

                <h4 style="margin-top: 40px;"> Mes annonces :</h4> <br>
                <?php
                    $announcementsQuery = "SELECT announcement FROM announcements WHERE cours = ?";
                    $stmt = $con->prepare($announcementsQuery);
                    $stmt->bind_param("s", $titre);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="announcement-box">' . $row['announcement'] . '</div> <br>';
                         }
                    } else {
                         echo "<p>Aucune annonce n'a été ajouté pour le moment.</p>";
                    }
                ?>
                </div>
            </div>
        </section>
    </div>
    <script src="../js/script.js"></script> <!-- Inclusion du fichier JavaScript -->
</body>
</html>