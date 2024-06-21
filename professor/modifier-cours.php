<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';
// Initialisation d'une variable pour stocker les messages à afficher
$message = '';
// Définition des répertoires de téléchargement pour les fichiers PDF et vidéos
$uploadDirectory_pdf = __DIR__ . '/../cours/cours-pdf/';
$uploadDirectory_video = __DIR__ . '/../cours/cours-video/';

// Démarrage de la session PHP
session_start();
// Récupération du titre du cours depuis l'URL
$titre1 = $_GET['cours'];
// Préparation et exécution de la requête SQL pour récupérer les informations du cours
$stmt = $con->prepare("SELECT * FROM cours WHERE titre = ?");
$stmt->bind_param("s", $titre1);
$stmt->execute();
$result1 = $stmt->get_result();
$row = $result1->fetch_assoc();
// Récupération des données du cours
$mots_cle = $row["mots_cles"];
$description = $row["description"];
$public_vise = $row["public_vise"];
$prerequis = $row["prerequis"];
$nombre_pdf = $row['nombre_pdf'];
$nombre_link = $row['nombre_link'];
$nombre_videos = $row['nombre_videos'];

// Traitement du formulaire de modification du cours
if(isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $titre_modifier = $_POST['titre'];
    $description_modifier = $_POST['description'];
    $mot_cle_modifier = $_POST['mot_cle'];
    $pre_requis_modifier = $_POST['prerequis'];
    $public_cible_modifier = $_POST['public_cible'];
    // Mise à jour des données du cours dans la base de données
    $stmt = $con->prepare("UPDATE cours SET description=? ,public_vise=?, mots_cles=?, prerequis=?,titre=? WHERE titre=?");
    $stmt->bind_param("ssssss", $description_modifier, $public_cible_modifier, $mot_cle_modifier, $pre_requis_modifier,$titre_modifier, $titre1);
    $stmt->execute();
    // Suppression des fichiers PDF, vidéos et liens associés au cours
    $stmt1 = $con->prepare("DELETE FROM pdf WHERE titre=?");
    $stmt1->bind_param("s", $titre_modifier);
    $stmt1->execute();
    $stmt2 = $con->prepare("DELETE FROM video WHERE titre=?");
    $stmt2->bind_param("s", $titre_modifier);
    $stmt2->execute();
    $stmt3 = $con->prepare("DELETE FROM link WHERE titre=?");
    $stmt3->bind_param("s", $titre_modifier);
    $stmt3->execute();
    // Redirection vers la page de saisie des fichiers PDF
    header("Location: saisir_les_pdf.php?cours=" . urlencode($titre_modifier));


}
// Suppression du cours
if(isset($_POST['delete'])) {
    $stmt = $con->prepare("DELETE FROM cours where titre =? ");
    $stmt->bind_param("s", $titre1);
    $stmt->execute();
    header("Location: ../home/home-professor.php");
}
?>
<!DOCTYPE html>
<html >
<head>
    <!-- Le meme principe que les autres codes -->
    <title>EduNest - Professeur</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/modifier-cours.css">
</head>
<body>

    <!-- Inclusion du fichier d'en-tête -->
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-professor.php'; ?>

    <div class="center-container">
        <section class="form-container">
            <?php echo $message; ?>
            <!-- Formulaire de modification du cours -->
            <form class="register" enctype="multipart/form-data" action="" method="post" >
                <h1 class="add-course-title" align="center" style=" color: black;"> Modifier un cours</h1>
                <div class="input-group">
                    <div class="name-fields" align="center">
                        <!-- Champ de saisie du titre du cours -->
                        <input type="text" name="titre" value="<?php echo $titre1; ?>" required class="box name">        
                    </div>
                    <div class="question-form" align="center" style="color: black;">
                        <!-- Champ de saisie de la description du cours -->
                        <h4 style="margin-top: 6px;">Description de cours :</h4>
                        <textarea class="box_description" name="description" rows="6"><?php echo $description; ?></textarea>
                    </div>
                    
                    <!-- Sélection du public cible du cours -->
                    <label for="public_cible" style="margin-bottom: 5px; color: black;">Public ciblé :</label>
                    <select id="public" name="public_cible" style="margin-bottom: 22px;">
                        <option value="cp1">2ap1</option>
                        <option value="cp2">2ap2</option>
                        <option value="GI1">GI1</option>
                        <option value="GI2">GI2</option>
                    </select>
                    
                    <!-- Champ de saisie des mots-clés -->
                    <label for="public_cible" style="margin-bottom: 5px; color: black;">Mots clés:</label>
                    <input type="text" name="mot_cle" value="<?php echo $mots_cle; ?>" required class="box">

                     <!-- Boutons de soumission et de suppression du formulaire -->
                    <label for="public_cible" style="margin-bottom: 5px; color: black;">Prérequis :</label>
                    <input type="text" name="prerequis" value="<?php echo $prerequis; ?>" required class="box">


                    
                    <div class="align-center">
                        <input type="submit" name="submit" value="Appliquer les modifications" class="btn">
                    </div>
                    <div class="align-center">
                        <input type="submit" name="delete" value="Supprimer le cours" class="btn">
                    </div>
                    
                </div>
            </form>
        </section>
    </div>

   
    <!-- Importation d'un script JavaScript -->
    <script src="../js/script.js"></script>

</body>
</html>
