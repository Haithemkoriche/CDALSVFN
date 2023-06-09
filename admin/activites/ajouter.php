<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si le formulaire d'ajout a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre_act = $_POST['titre_act'];
    $description_act = $_POST['description_act'];
    $id_atelier = $_POST["id_atelier"];

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
            $sql = "INSERT INTO `activities` (`titre_act`, `description_act`, `image_act`, `ID_ate_foreign`) VALUES ('$titre_act', '$description_act', '$image_name', '$id_atelier')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: index.php?add=true");
                exit();
            } else {
                $danger = true;
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

// Récupérer la liste des ateliers depuis la base de données
$sql_ateliers = "SELECT * FROM `ateliers`";
$result_ateliers = mysqli_query($conn, $sql_ateliers);
$ateliers = mysqli_fetch_all($result_ateliers, MYSQLI_ASSOC);
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <h2><a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Ajouter une activité</h2>
    <?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
            L'activité a n'été pas ajouté avec succès.
        </div>
    <?php endif; ?>
    <form method="POST" action="ajouter.php" enctype="multipart/form-data">
        <div class="form-group mt-2">
            <label for="titre_act">Titre:</label>
            <input type="text" class="form-control" name="titre_act" id="titre_act">
        </div>
        <div class="form-group mt-2">
            <label for="description_act">Description:</label>
            <textarea class="form-control" name="description_act" id="description_act"></textarea>
        </div>
        <div class="form-group mt-2">
            <label for="duree_act">La durée:</label>
            <input class="form-control" name="duree_act" id="duree_act"></input>
        </div>
        <div cduree_actlass="form-group mt-2">
            <label for="id_atelier">Atelier :</label>
            <select class="form-control" id="id_atelier" name="id_atelier" required>
                <?php foreach ($ateliers as $atelier) : ?>
                    <option value="<?php echo $atelier["ID_ate"]; ?>"><?php echo $atelier["intitule_ate"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>