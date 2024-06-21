<?php
// Démarrer la session
include '../components/connect.php'; // Inclusion du script de connexion à la base de données
?>
<!DOCTYPE html>
<html>
<head>
    <title>EduNest - Professeur</title>
        <!-- Liens vers les polices et icônes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/tableau-bord.css">
</head>
<body>

    <link rel="stylesheet" href="../css/header-home.css">
    <?php include '../components/header-home-professor.php'; ?>

    <div class="center-container">
        <section class="form-containers">
            <div class="title">
                <h1 class="table-bord-title">Tableau De Bord</h1>
            </div>
            <?php
            $email=$_SESSION['email_professor']; // Récupération de l'email du professeur depuis la session
             // Sélection des titres des cours enseignés par le professeur connecté
            $stmt = $con->prepare("SELECT titre FROM cours WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                //boocle cours par cours
                while ($row = $result->fetch_assoc()){
                    $titre=$row['titre'];
                    echo '<div class="cours">';
                    echo '<h1 class="nom_cours">'.htmlspecialchars($titre).'</h1>';
                    //tout les suivant ce cours
                    $stmt = $con->prepare("SELECT titre, email FROM cours_students WHERE titre = ?");
                    $stmt->bind_param("s", $titre);
                    $stmt->execute();
                    $result1 = $stmt->get_result();
                    if($result1->num_rows>0){

                        echo ' <h4 class="titre"> - Nombre des étudiants suivant ce cours :ㅤㅤㅤ'.htmlspecialchars($result1->num_rows).'</h4>';
                        echo ' <h4 class="titre"> - Les étudiants suivant ce cours : </h4>';
                        //boocle etudiant par etudiant
                        while ($row1 = $result1->fetch_assoc()){
                           $mail1=$row1['email'];
                         // Récupération du nom et du prénom de l'étudiant à partir de son email
                           $stmt = $con->prepare("SELECT nom, prenom FROM students WHERE email = ?");
                           $stmt->bind_param("s", $mail1);
                           $stmt->execute();
                           $result2 = $stmt->get_result();
                           while($row3 = $result2->fetch_assoc()){
                               // Affichage du nom, prénom et email de l'étudiant
                            echo '<h4 class="nombre">*  ' . htmlspecialchars($row3['nom']).' '.htmlspecialchars($row3['prenom']) . ' -> '. htmlspecialchars($mail1) . '</h4>';

                           }

                        }

                    
                    }else {
                                // Aucun étudiant inscrit à ce cours
                        echo '<p>Aucun étudiant ne suive ce cours.</p>';
                    }
                    echo '</div>';// Fin de la section du cours
                }

            }else {
                                // Aucun cours trouvé pour ce professeur
                echo '<p>Pas de cours pour ce Professeur.</p>';
            }
            ?>

                
        </section>
    </div>

    <script src="../js/script.js"></script>

</body>
</html>