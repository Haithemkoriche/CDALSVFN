<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du carousel est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du carousel depuis l'URL
    $id = $_GET["id"];

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

        // Préparer et exécuter la requête de mise à jour
        $stmt = $conn->prepare("UPDATE carousels SET titre_car = ?, description_car = ?, path_car = ? WHERE ID_carousel = ?");
        $stmt->bind_param("sssi", $titre, $description, $image, $id);
        $stmt->execute();

        // Vérifier si la mise à jour a réussi
        if ($stmt->affected_rows > 0) {
            $success=true;
        } else {
            $danger=true;
        }

    }

    // Préparer et exécuter la requête de sélection du carousel spécifié
    $stmt = $conn->prepare("SELECT * FROM carousels WHERE ID_carousel = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    // Vérifier s'il y a un résultat
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $titre = $row["titre_car"];
        $description = $row["description_car"];
        $image = $row["path_car"];
        ?>

        <?php include("../layout.php"); ?>
        <head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css"> 
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
        <div class="container">
        <h2><a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Modifier le carousel</h2>
            <?php if (@$success) : ?>
        <div class="alert alert-success" role="alert">
            Les données de carrousel a été modifier avec succès.
        </div>
    <?php endif; ?>
<?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
        Une erreur s'est produite lors de la mise à jour du carrousel.
        </div>
    <?php endif; ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group mt-2 mb-2">
                    <label class="form-label" for="titre">Titre :</label>
                    <input type="text" class="form-control" name="titre" id="titre" value="<?php echo $titre; ?>">
                </div>
                <div class="form-group mt-2 mb-2">
                    <label class="form-label" for="description">Description :</label>
                    <textarea class="form-control" name="description" id="description"><?php echo $description; ?></textarea>
                </div>
                <div class="form-group mt-2 mb-2">
                    <label class="form-label" for="image">Image :</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>

        <?php include("../footer.html");

    } else {
        echo "Aucun carousel trouvé avec cet ID.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID du carousel non spécifié.";
}
?>
