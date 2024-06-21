<?php 
// Inclusion du fichier de connexion à la base de données
include '../components/connect.php';

// Initialisation du message
$message = '';
// Définition du répertoire de téléchargement
$uploadDirectory = __DIR__ . '/../cours/' ;

// Vérification si le formulaire a été soumis
if(isset($_POST['submit'])) {
    
    // Récupération des données du formulaire
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $mot_cle = $_POST['mot_cle'];
        $pre_requis = $_POST['prerequis'];
        $public_cible = $_POST['public_cible'];
        $nombre_pdf=$_POST['nombre-pdf'];
        $nombre_link=$_POST['nombre-link'];
        $nombre_videos=$_POST['nombre-videos'];

        // Démarrage de la session
        session_start();
        // Requête d'insertion des données dans la table "cours"
        $sql = "INSERT INTO cours (titre, description ,mots_cles,public_vise,prerequis,email,nombre_pdf,nombre_link,nombre_videos) VALUES ('$titre','$description', '$mot_cle','$public_cible','$pre_requis','{$_SESSION['email_professor']}','$nombre_pdf','$nombre_link','$nombre_videos')";
        // Exécution de la requête
        $result = mysqli_query($con, $sql);
            // Redirection vers la page de saisie des PDF avec le titre du cours encodé dans l'URL
        header("Location: saisir_les_pdf.php?cours=" . urlencode($titre));

        
  
}

?>

<!DOCTYPE html>
<html >
<head>
    <title>EduNest - Professeur</title>
    <!-- Chargement des polices Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <!-- Chargement des icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Inclusion de la feuille de style CSS pour la page d'ajout de cours -->
    <link rel="stylesheet" href="../css/ajouter-cours.css">
</head>
<body>

    <!-- Inclusion de l'en-tête de la page -->
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-professor.php'; ?>

    <!-- Conteneur central -->
    <div class="center-container">
        <!-- Section du formulaire -->
        <section class="form-container">
        <!-- Affichage du message -->
        <?php echo $message; ?>

            <!-- Formulaire d'ajout de cours -->
            <form class="register" enctype="multipart/form-data" action="" method="post" >
                <!-- Titre du formulaire -->
                <h1 class="add-course-title" align="center" style=" color: black;"> Ajouter un cours</h1>

                <!-- Groupe d'éléments d'interface utilisateur -->
                <div class="input-group">

                    <!-- Champ de saisie du nom du cours -->
                    <div class="name-fields" align="center"x>
                        <input type="text" name="titre" placeholder="Nom de cours" required class="box name">          
                    </div>

                    <!-- Champ de saisie de la description du cours -->
                    <div class="question-form" align="center" style="color: black;">
                        <h4 style="margin-top: 6px;" >Description de cours :</h4>
                        <textarea placeholder="Description ..." class="box_description" name="description" rows="6" ></textarea>
                    </div>

                    <!-- Sélection du public cible -->
                    <label for="public_cible" style="margin-bottom: 5px; color: black;" >Choisi le public ciblé :</label>
                        <select id="public" name ="public_cible"style="margin-bottom: 22px;">
                            <option value="cp1">2ap1</option>
                            <option value="cp2">2ap2</option>
                            <option value="GI1">GI1</option>
                            <option value="GI2">GI2</option>
                        </select>

                    <!-- Champ de saisie des mots clés du cours et prerequis -->
                    <input type="text" name="mot_cle" placeholder="Mots cles de cours" required class="box">
                    <input type="text" name="prerequis" placeholder="Prerequis (Example: HTML,CSS..)" required class="box">

                    <!-- Sélection du nombre de fichiers PDF -->
                    <h3 style="margin-bottom: 5px; color: black;" >Choisi le nombre de ressources que vous voulez inclure</h3>

                    <label for="public_cible" style="margin-bottom: 5px; color: black; margin-right:auto;margin-left:auto;margin-top:0.5cm" >PDF </label>
                        <select id="public" name ="nombre-pdf"style="margin-bottom: 22px;">
                            <option value="0pdf">0</option>
                            <option value="1pdf">1</option>
                            <option value="2pdf">2</option>
                            <option value="3pdf">3</option>
                            <option value="4pdf">4</option>
                        </select>

                        <!-- Sélection du nombre de liens -->
                        <label for="public_cible" style="margin-bottom: 5px; color: black; margin-right:auto;margin-left:auto;" >Link </label>
                        <select id="public" name ="nombre-link"style="margin-bottom: 22px;">
                            <option value="0link">0</option>
                            <option value="1link">1</option>
                            <option value="2link">2</option>
                            <option value="3link">3</option>
                            <option value="4link">4</option>
                        </select>

                        <!-- Sélection du nombre de vidéos -->
                        <label for="public_cible" style="margin-bottom: 5px; color: black; margin-right:auto;margin-left:auto;" >Videos </label>
                        <select id="public" name ="nombre-videos"style="margin-bottom: 22px;">
                            <option value="0video">0</option>
                            <option value="1video">1</option>
                            <option value="2video">2</option>
                            <option value="3video">3</option>
                            <option value="4video">4</option>
                        </select>
                    
                    <!-- Bouton de soumission du formulaire -->
                    <div class="align-center">
                    <input type="submit" name="submit" value="Ajouter" class="btn">
                    </div>
                    
                </div>
            </form>
        </section>
    </div>

    <script src="../js/script.js"></script>  <!-- Inclusion du script JavaScript -->

</body>
</html>


