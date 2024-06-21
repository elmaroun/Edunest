<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';

// Initialisation d'une variable pour les messages
$message = '';

// Chemins de téléchargement des fichiers PDF et vidéos
$uploadDirectory_pdf= __DIR__ . '/../cours/cours-pdf/' ;
$uploadDirectory_video = __DIR__ . '/../cours/cours-video/' ;

// Récupération du titre du cours depuis l'URL
$titre = $_GET['cours'];
$stmt = $con->prepare("SELECT * FROM cours WHERE titre = ?");
$stmt->bind_param("s", $titre);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$nombre_pdf = $row['nombre_pdf'];
$nombre_link = $row['nombre_link'];
$nombre_videos = $row['nombre_videos'];

// Traitement du formulaire d'ajout de ressources
if(isset($_POST['submit'])) {
    // Traitement des fichiers PDF
    $i=0;
    while ($i < $nombre_pdf) {
        $i=$i+1;
        $sous_titre_pdf=$_POST["sous_titre_pdf_$i"];

        $file = $_FILES["pdf_" . $i];
        $nom_pdf = $file["name"];

        $sql = "INSERT INTO pdf (titre, nom_pdf,sous_titre) VALUES (?, ? ,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $titre, $nom_pdf,$sous_titre_pdf);
        $stmt->execute();
        $targetPath = $uploadDirectory_pdf . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $targetPath);

    }
    
    // Traitement des liens
    $j=0;
    while ($j < $nombre_link) {
        $j=$j+1;
        $sous_titre_link=$_POST["sous_titre_link_$j"];
        $link = $_POST["link_$j"];
        $nom_link = $link;

        // Requête SQL pour insérer les données dans la table link
        $sql = "INSERT INTO link (titre, nom_link,sous_titre) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $titre, $nom_link,$sous_titre_link);
        $stmt->execute();
    }
    // Traitement des vidéos
    $k=0;
    while ($k < $nombre_videos) {
        $k=$k+1;
        $sous_titre_video=$_POST["sous_titre_video_$k"];

        $video = $_FILES["video_" . $k];
        $nom_video = $video["name"];

        // Requête SQL pour insérer les données dans la table link
        $sql = "INSERT INTO video (titre, nom_video,sous_titre) VALUES (?, ?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $titre, $nom_video,$sous_titre_video);
        $stmt->execute();
        $targetPath = $uploadDirectory_video . basename($video["name"]);
        move_uploaded_file($video["tmp_name"], $targetPath);

    }

    // Redirection vers la page d'accueil du professeur après l'ajout des ressources
header("Location: ../home/home-professor.php");

}
  
?>

<!DOCTYPE html>
<html >
<head>
    <title>EduNest - Professeur</title>
    <!-- Inclusion de la police de caractères et des styles CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/ajouter-cours.css">
</head>
<body>
    <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-professor.php'; ?>
    <!-- Conteneur principal -->
    <div class="center-container">
        <section class="form-container">
        
            <!-- Formulaire d'ajout de ressources -->
            <form class="register" enctype="multipart/form-data" action="" method="post" >
                <!-- Titre du cours -->
                <?php echo '<h2 class="add-course-title" align="center" style=" color: black;"> Ajouter les ressource du cours ㅤ'.htmlspecialchars($titre). '</h2>';?>
                <!-- Section pour les fichiers PDF -->
                <?php if ($nombre_pdf != 0){ ?>
                <h3> Veuillez saisir les PDF</h3>
                <div class="input-group">
                    <?php
                    $i=0;
                    while ($i < $nombre_pdf) {
                        $i=$i+1; ?>
                        <div class="box_ressource">
                            <input type="text" id="sous_titre_pdf_<?php echo $i; ?>" name="sous_titre_pdf_<?php echo $i; ?>" placeholder="titre/sous titre" style="margin-left:25%;width:45%" class="box">
                            <div class="file-input">
                                <input type="file" id="pdf_<?php echo $i; ?>" name="pdf_<?php echo $i; ?>" accept=".pdf" style="margin-left:25%;width:45%; " class="box">
                            </div> 
                        </div>
                    <?php } }?>

                <!-- Section pour les liens -->
                <?php if ($nombre_link != 0){ ?>

                <h3> Veuillez saisir les link </h3>
                <div class="input-group">
                    <?php
                    $i=0;
                    while ($i < $nombre_link) {
                        $i=$i+1;?>
                            <div class="box_ressource">
                            <input type="text" id="sous_titre_link_<?php echo $i; ?>" name="sous_titre_link_<?php echo $i; ?>" placeholder="titre/sous titre" style="margin-left:25%;width:45%" class="box">
                            <div class="file-input">
                                <input type="text" id="link_<?php echo $i; ?>" name="link_<?php echo $i; ?>" placeholder="Entrez l\'URL du PDF" style="margin-left:25%;width:45%" class="box">
                            </div>
                            </div>

                   <?php }} ?>
                <?php if ($nombre_videos != 0){ ?>

                <h3> Veuillez saisir les vidéos </h3>
                <div class="input-group">
                    <?php
                    $i=0;
                    while ($i < $nombre_videos) {
                        $i=$i+1;?>
                            <div class="box_ressource">
                                <input type="text" id="sous_titre_video_<?php echo $i; ?>" name="sous_titre_video_<?php echo $i; ?>" placeholder="titre/sous titre" style="margin-left:25%;width:45%" class="box">
                                <div class="file-input">
                                    <input type="file" id="video_<?php echo $i; ?>" name="video_<?php echo $i; ?>" accept="video/*"  style="margin-left:25%; width:45%;" class="box">
                                </div>
                            </div>

                    <?php } }?>
                    

                    <!-- Bouton pour soumettre le formulaire -->
                    <div class="align-center">
                    <input type="submit" name="submit" value="Ajouter" class="btn">
                    </div>
                    
                </div>
            </form>
        </section>
    </div>
    <!-- Inclusion du script JavaScript -->
    <script src="../js/script.js"></script>

</body>
</html>


