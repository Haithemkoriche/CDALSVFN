<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $description = $_POST["description"];

    // Vérifier si un fichier a été uploadé
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $image_path = "../../images/slide/" . $image; // Spécifiez le chemin d'accès approprié

        // Déplacer le fichier uploadé vers le dossier de destination
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // Gérer l'erreur si aucun fichier n'a été uploadé
        $image = ""; // Spécifiez une valeur par défaut ou un autre comportement souhaité
    }

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO carousels (titre_car, description_car, path_car) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titre, $description, $image);
    $stmt->execute();

    // Vérifier si l'insertion a réussi
    if ($stmt->affected_rows > 0) {
        header("Location: index.php?add=true");
        exit();
    } else {
        $danger=true;
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
}
?>

<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css"> 
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <h2>Ajouter un carousel</h2>
    <?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
            Le carrousel a n'été pas ajouté avec succès.
        </div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" name="titre" id="titre">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>