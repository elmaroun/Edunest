<?php
include '../components/connect.php';

session_start();

if (!isset($_SESSION['email_admin'])) {
    header('Location: login-admin.php');
    exit();
}

// Vérifier si le formulaire de suppression a été soumis
if (isset($_POST['delete'])) {
    $email_user = $_POST['email_user'];

    // Suppression d'un utilisateur de la table des professeurs
    $stmt_professors = $con->prepare("DELETE FROM professors WHERE email = ?");
    $stmt_professors->bind_param("s", $email_user);
    $stmt_professors->execute();

    // Suppression d'un utilisateur de la table des étudiants
    $stmt_students = $con->prepare("DELETE FROM students WHERE email = ?");
    $stmt_students->bind_param("s", $email_user);
    $stmt_students->execute();

    // Vérifier si la suppression a réussi dans l'une des tables
    if ($stmt_professors->affected_rows > 0 || $stmt_students->affected_rows > 0) {
        $stmt_delete = $con->prepare("DELETE FROM demandes WHERE email_user = ?");
        $stmt_delete->bind_param("s", $email_user);
        $stmt_delete->execute();
        header('Location: home-admin.php');
        exit();
    } else {
        echo "Erreur lors de la suppression de l'utilisateur.";
    }

    // Fermer les instructions préparées
    $stmt_professors->close();
    $stmt_students->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Afficher Cours</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/header-home.css">
    <link rel="stylesheet" href="home-admin.css">
</head>
<body>
    <?php include 'header-home-admin.php'; ?>

    <div class="center-container">
        <section class="form-containers">
            <div class="title">
                <h1 class="table-bord-title">Tableau De Bord Admin</h1>
            </div>

            <div class="cours">
                <h1 class="nom_cours">Étudiants inscrits sur la plateforme</h1>
                <?php
                                // Récupération et affichage des étudiants
                                // Préparation de la requête SQL
                $stmt = $con->prepare("SELECT nom, prenom, email FROM students");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<h4 class="nombre">* ' . htmlspecialchars($row['prenom']) . ' ' . htmlspecialchars($row['nom']) . ' -> ' . htmlspecialchars($row['email']) . '</h4>';
                    }
                } else {
                    echo '<p>Aucun étudiant inscrit sur la plateforme</p>';
                }
                ?>
            </div>

            <!-- Affichage des professeurs inscrits -->
            <div class="cours">
                <h1 class="nom_cours">Professeurs utilisant la plateforme</h1>
                <?php
                                // Récupération et affichage des professeurs
                                 // Préparation de la requête SQL
                $stmt = $con->prepare("SELECT nom, prenom, email FROM professors");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<h4 class="nombre">* ' . htmlspecialchars($row['prenom']) . ' ' . htmlspecialchars($row['nom']) . ' -> ' . htmlspecialchars($row['email']) . '</h4>';
                    }
                } else {
                    echo '<p>Aucun professeur inscrit sur la plateforme</p>';
                }
                ?>
            </div>
                        <!-- Affichage des cours par professeur -->
        <?php 
             echo '<div class="cours">';
             echo '<h1 class="nom_cours">Cours par professeur</h1>';
             $stmt = $con->prepare("SELECT nom,prenom,email FROM professors ");
                 //$stmt->bind_param("s", $titre);
                 $stmt->execute();
                 $result = $stmt->get_result();
                 if($result->num_rows>0){
                     while ($row = $result->fetch_assoc()){
                              // Récupération des cours de chaque professeur
                         $email_professeur=$row['email'];
                         $nom_professeur =$row['nom'];
                         $prenom_professeur=$row['prenom'];                    
                         echo '<h1 class="nom_cours">'.htmlspecialchars($prenom_professeur).' '.htmlspecialchars($nom_professeur).'</h1>';

                         $stmt = $con->prepare("SELECT titre FROM cours WHERE email=?");
                         $stmt->bind_param("s", $email_professeur);
                         $stmt->execute();
                         $result1 = $stmt->get_result();
                         if($result1->num_rows>0){
                             while($row2 = $result1->fetch_assoc()){
                                 echo '<h4 class="nombre">*  ' . htmlspecialchars($row2['titre']). '</h4>';
 
                            }

                         }else{
                             echo '<p>Ce professeur n\'a aucun cours</p>';
                         }

                     }


                 }
                 else{
                     echo '<p>Aucun professeur n\'est inscrit dans la plateforme</p>';

                 }
             echo '</div>';

            // Affichage des cours par étudiant
             echo '<div class="cours">';
             echo '<h1 class="nom_cours">Cours par Etudiant</h1>';
             $stmt = $con->prepare("SELECT nom,prenom,email FROM students ");
                 //$stmt->bind_param("s", $titre);
                 $stmt->execute();
                 $result = $stmt->get_result();
                 if($result->num_rows>0){
                     while ($row = $result->fetch_assoc()){
                            // Récupération des cours de chaque étudiant
                         $email_student=$row['email'];
                         $nom_student =$row['nom'];
                         $prenom_student=$row['prenom'];                    
                         echo '<h1 class="nom_cours">'.htmlspecialchars($prenom_student).' '.htmlspecialchars($nom_student).'</h1>';

                         $stmt = $con->prepare("SELECT titre FROM cours_students WHERE email=?");
                         $stmt->bind_param("s", $email_student);
                         $stmt->execute();
                         $result1 = $stmt->get_result();
                         if($result1->num_rows>0){
                             while($row2 = $result1->fetch_assoc()){
                                 echo '<h4 class="nombre">*  ' . htmlspecialchars($row2['titre']). '</h4>';
 
                            }

                         }else{
                             echo '<p>Ce Etudiant n\'a aucun cours</p>';
                         }

                     }


                 }
                 else{
                     echo '<p>Aucun Etudiant n\'est inscrit dans la plateforme</p>';

                 }
             echo '</div>';
             

        ?>
                    <!-- Affichage des demandes de suppression -->
            <div class="title">
                <h2 class="table-bord-title">Les demandes :</h2>
            </div>
            <div align="center" class="question-form">
                <table align="center">
                    <thead align="center">
                        <tr>
                            <th id="sender-email" align="center">Prénom</th>
                            <th align="center" id="sender">Nom</th>
                            <th align="center" id="sender-question">Email</th>
                            <th id="sender-action"></th> <!-- Column for delete button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                                // Affichage des demandes de suppression
                        $stmt = $con->prepare("SELECT nom, prenom, email_user FROM demandes");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td align="center">' . htmlspecialchars($row['prenom']) . '</td>';
                            echo '<td align="center">' . htmlspecialchars($row['nom']) . '</td>';
                            echo '<td align="center">' . htmlspecialchars($row['email_user']) . '</td>';
                            echo '<td>';
                            echo '<form method="post" action="">'; // Form submission to the same page
                            echo '<input type="hidden" name="email_user" value="' . htmlspecialchars($row['email_user']) . '">';
                            echo '<button class="btn" type="submit" name="delete" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\')">Supprimer</button>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        }

                        if ($result->num_rows == 0) {
                            echo '<tr><td colspan="4">Aucune demande de suppression</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
