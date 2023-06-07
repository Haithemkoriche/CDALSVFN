<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $intitule = $_POST["intitule"];
    $description = $_POST["description"];
    $formateur = $_POST["formateur"];

    // Vérifier si un fichier a été uploadé
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $image_path = "../../images/" . $image; // Spécifiez le chemin d'accès approprié

        // Déplacer le fichier uploadé vers le dossier de destination
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // Gérer l'erreur si aucun fichier n'a été uploadé
        $image = "default.jpg"; // Spécifiez une image par défaut ou un autre comportement souhaité
    }

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO ateliers (intitule_ate, image_ate, description_ate, ID_form_foreign) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $intitule, $image, $description, $formateur);
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
    <h2>Ajouter un atelier</h2>
    <?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
            Le atelier a n'été pas ajouté avec succès.
        </div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="intitule">Intitulé :</label>
            <input type="text" class="form-control" name="intitule" id="intitule">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="formateur">Formateur :</label>
            <select class="form-control" name="formateur" id="formateur">
                <?php

                // Récupérer tous les formateurs de la base de données
                $formateursSql = "SELECT * FROM formateurs";
                $formateursResult = mysqli_query($conn, $formateursSql);

                // Afficher les options du select avec les formateurs
                while ($formateur = mysqli_fetch_assoc($formateursResult)) {
                    echo '<option value="' . $formateur['ID_form'] . '">' . $formateur['Nom_form'] . '</option>';
                }

                // Fermer la ressource
                mysqli_free_result($formateursResult);
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>