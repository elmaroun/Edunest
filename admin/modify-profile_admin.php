<?php 
include '../components/connect.php';
$uploadDirectory = __DIR__ . '/../photo-profile/';

session_start();
$mail_admin =  $_SESSION['email_admin'];
$stmt = $con->prepare("SELECT nom, prenom, photo_de_profile FROM admin WHERE email = ?");
$stmt->bind_param("s", $mail_admin);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$nom_p = $row['nom'];
$prenom_p = $row['prenom'];
$photo_profile = $row['photo_de_profile'];

if(isset($_POST['submit'])) {
    $new_nom = $_POST['nom'];
    $new_prenom = $_POST['prenom'];
    $new_email = $_POST['email'];
    $_SESSION['email_admin'] = $new_email;

    if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $file_modifier = basename($_FILES["file"]["name"]);
        $targetPath = $uploadDirectory . $file_modifier;
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath);
    } else {
        $file_modifier = $photo_profile; // Keep the existing photo if no file is uploaded
    }

    $stmt = $con->prepare("UPDATE admin SET nom=?, prenom=?, email=?, photo_de_profile=? WHERE email=?");
    $stmt->bind_param("sssss", $new_nom, $new_prenom, $new_email, $file_modifier, $mail_admin);
    $stmt->execute();
    header("Location: profile-admin.php");
}
?>


?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/modify-profile-professor.css">
</head>

<body class="login-page">
    <link rel="stylesheet" href="../css/header.css">
    <?php include 'header-admin.php'; ?>

    <div class="center-container"> 
        <section class="form-container">
            <form class="register" action="" method="post" enctype="multipart/form-data">
                <h3>Modify Your Account</h3>



                <div class="file-input">

                        <div id="pdfContainer" class="course-pdf">
                            <?php
                            $chemin_profile = "../photo-profile/" . $photo_profile;
                            if (file_exists($chemin_profile)) {
                               echo ' <img src="'.$chemin_profile.'" alt="Profile Image" class="center">';
                            } else {
                                echo '<h1> Fichier non trouvé : ' . $chemin_profile . '</h1>';
                            }
                            ?>
                        </div>
                        <div class="display_flex">
                        <label for="file" style="display:block;">Modifier l'image :</label>
                        <input type="file" id="file" name="file" accept=".jpg" class="box_profile" onchange="showFile(this)">
                        </div>

                </div>



                <div class="input-group">
                    <div class="name-fields">
                        <input type="text" name="nom" value=<?php echo $nom_p ;?> required class="box name">
                        <input type="text" name="prenom"  value=<?php echo $prenom_p ;?> required class="box name">
                    </div>
                    <input type="email" name="email" placeholder="Enter your email" value=<?php echo $mail_admin ;?> required class="box">
                    <div class="align-center">
                        <input type="submit" name="submit" value="Appliquer les Modification" class="btn">
                    </div>
                </div>
            </form>
        </section>
    </div>
    <script>
        function showFile(input) {
            var file = input.files[0];
            if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
            var pdfContainer = document.getElementById('pdfContainer');
            pdfContainer.innerHTML = '<img src="' + e.target.result + '" alt="Profile Image" class="center" />';
            }
            reader.readAsDataURL(file);
        }
        }

    </script>
</body>
</html>
