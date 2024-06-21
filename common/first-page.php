<!DOCTYPE html>
<html>
<head>
    <title>Edunest</title>
        <!-- Inclure le font Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <!-- Inclure le fichier CSS  -->
    <link rel="stylesheet" href="../css/first-page.css">
</head>

<body>
    <!-- Inclusion de l'en-tête -->
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../components/header.php'; ?>
    <!-- Conteneur principal -->
    <div class="center-container">
        <!-- Titre -->
        <h2 class="centered-title">Êtes-vous Professeur ou Étudiant ?</h2>
        
        <!-- La section Accueil -->
        <section id="home">
            <div class="container">
            <!--Le choix Professeur -->
                <div class="box" id="professor">
                    <!-- le lien vers la page de connexion du professeur -->
                    <a href="../professor/login-professor.php">
                        <!-- image du Professeur -->
                        <img src="../images/professor.png" alt="Professor">
                        <!-- text indiquant "Professeur" -->
                        <span style="color: black;">Professeur</span>
                    </a>
                </div>
                <!-- choix Étudiant -->
                <div class="box" id="student">
                    <!-- Lien vers la page de connexion de l'étudiant -->
                    <a href="../student/login-student.php">
                        <!-- image de l'Étudiant -->
                        <img   class="margin-top: 40px;"   src="../images/student.png" alt="Student">
                        <!-- just un text qui indiquant "Étudiant" -->
                        <span style="color: black;">Étudiant</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>