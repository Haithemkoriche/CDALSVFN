<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si le formulaire d'ajout a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Vérifier si un fichier a été sélectionné pour l'upload
    if ($_FILES['image']['name']) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_error = $_FILES['image']['error'];

        // Vérifier le type du fichier
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_ext = array('jpg', 'jpeg', 'png');

        if (in_array($image_ext, $allowed_ext)) {
            // Déplacer l'image téléchargée vers le dossier des images
            $image_destination = '../../images/' . $image_name;
            move_uploaded_file($image_tmp, $image_destination);
            
            // Insérer la nouvelle activité dans la base de données avec le nom de l'image
            $sql = "INSERT INTO `activities` (`title`, `description`, `image`, `created_at`, `updated_at`) VALUES ('$title', '$description', '$image_name', NOW(), NOW())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("location: ../admin_panel.php");
                exit();
            } else {
                echo 'Erreur lors de l\'ajout de l\'activité: ' . mysqli_error($conn);
            }
        } else {
            echo 'Le type de fichier n\'est pas autorisé. Veuillez choisir une image au format JPG, JPEG ou PNG.';
        }
    } else {
        echo 'Veuillez sélectionner une image.';
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Ajouter une activité</h2>
    <form method="POST" action="ajouter.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>
