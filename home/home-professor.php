<?php
// Inclure le fichier de connexion à la base de données
include '../components/connect.php'; ?>

<?php
// Démarrer la session
session_start();
// Vérifier si l'utilisateur est connecté en tant que professeur
if (!isset($_SESSION['logged_in_p']) || $_SESSION['logged_in_p'] !== true) {
        // Rediriger vers la page de connexion pour les professeurs si l'utilisateur n'est pas authentifié

    header('Location: ../professor/login-professor.php'); 
    exit();
    // Arrêter l'exécution du script après la redirection
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/home-professor.css">
    <title>HomePage</title>
    
</head>
<body>
    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-professor.php'; ?><!-- Inclure le header -->
    <!-- Lien pour ajouter un cours -->

    <a href="../professor/ajouter-cours.php" class="ajouter-cours-link">
        <input type="submit" name="submit" value="  Ajouter un Cours +" class="ajouter-cours">
    </a>
        <!-- Lien vers le tableau de bord -->

    <a href="../professor/tableau-bord.php" class="ajouter-cours-link">
        <input type="submit" name="submit" value="  Tableau De Bord " class="tab-bord-cours">
    </a>
    
    <div class="body-cours clearfix">
        <h1 align="center" class="tite"> Mes Cours </h1>
       
       <?php
                   // Récupérer l'email du professeur depuis la session


            $professor_email =  $_SESSION['email_professor'];
                        // Préparer la requête SQL pour récupérer les titres des cours de ce professeur

            $stmt = $con->prepare("SELECT titre FROM cours WHERE email = ?");
            $stmt->bind_param("s", $professor_email);
            $stmt->execute();
            $result = $stmt->get_result();
                        // Vérifier s'il y a des cours retournés par la requête

            if ($result->num_rows > 0) {
                                // Afficher chaque cours dans une boîte

                while ($row = $result->fetch_assoc()) {
                    $titre = $row['titre'];
        ?>
                    <div class="box-cours">
                    <h1 class="nom-du-cours"><?php echo htmlspecialchars($titre); ?></h1>  
                 <!-- Lien pour afficher le contenu du cours avec le titre encodé dans l'URL -->
                    <a href="../professor/afficher-cours.php?cours=<?php echo urlencode($titre); ?>" class="button-contenu">Afficher</a>
                     <!-- Lien pour modifier le cours avec le titre encodé dans l'URL -->
                    <a href="../professor/modifier-cours.php?cours=<?php echo urlencode($titre); ?>" class="button-modifier">Modifier</a>
                    </div>

        <?php
                }
            } else
                // Afficher un message si aucun cours n'est trouvé pour ce professeur
            { echo '<p>No courses found for this professor.</p>'; }
            // Fermer la connexion à la base de données
            $con->close();
        ?>
    </div>

    <script src="../js/script.js"></script>

</body>
</html>