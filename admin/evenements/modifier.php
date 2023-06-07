<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'événement est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID de l'événement depuis l'URL
    $id = $_GET["id"];
    // Préparer et exécuter la requête pour récupérer les informations de l'événement spécifié
    $stmt = $conn->prepare("SELECT * FROM evenements WHERE ID_E = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'événement existe dans la base de données
    if ($result->num_rows == 1) {
        // Récupérer les informations de l'événement
        $row = $result->fetch_assoc();
        $intitule = $row["intitule_E"];
        $description = $row["description_E"];
        $image = $row["image_E"];
        $dateDebut = $row["date_d_E"];
        $dateFin = $row["date_f_E"];
        $lieu = $row["lieu_E"];
        $idAnimateur = $row["ID_Anim_foreign"];
    } else {
        // Rediriger vers la page de liste des événements si l'événement n'existe pas
        header("Location: index.php");
        exit();
    }
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $intitule = $_POST["intitule"];
        $description = $_POST["description"];
        @$image = $_POST["image"];
        $dateDebut = $_POST["date_debut"];
        $dateFin = $_POST["date_fin"];
        $lieu = $_POST["lieu"];
        $idAnimateur = $_POST["id_animateur"];

        // Vérifier si un nouveau fichier image a été uploadé
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $image = $_FILES["image"]["name"];
            $newImageTmp = $_FILES["image"]["tmp_name"];
            $newImagePath = "../../images/" . $image;

            // Déplacer le nouveau fichier image vers le dossier de destination
            move_uploaded_file($newImageTmp, $newImagePath);
        } else {
            // Conserver l'ancienne image si aucun nouveau fichier n'a été uploadé
            $image = $row['image_E'];
        }

        // Préparer et exécuter la requête de mise à jour des données de l'événement spécifié
        $stmt = $conn->prepare("UPDATE evenements SET intitule_E = ?, description_E = ?, image_E = ?, date_d_E = ?, date_f_E = ?,lieu_E = ?, ID_Anim_foreign = ? WHERE ID_E = ?");
        $stmt->bind_param("ssssssii", $intitule, $description, $image, $dateDebut, $dateFin, $lieu, $idAnimateur, $id);
        $stmt->execute();

        // Vérifier si la mise à jour a réussi
        if ($stmt->affected_rows > 0) {
            $success = true;
        } else {
            $danger = true;
        }
    }



    // Récupérer les animateurs disponibles
    $stmt = $conn->prepare("SELECT ID_Anim, nom_Anim FROM animateurs");
    $stmt->execute();
    $animateurs = $stmt->get_result();
} else {
    // Rediriger vers la page de liste des événements si l'ID de l'événement n'est pas spécifié
    header("Location: index.php");
    exit();
}
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <h2><a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Modifier un événement</h2>
    <?php if (@$success) : ?>
        <div class="alert alert-success" role="alert">
            Les données de evenement a été modifier avec succès.
        </div>
    <?php endif; ?>
    <?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
            Une erreur s'est produite lors de la mise à jour du evenement.
        </div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group mt-2 mb-2">
            <label for="intitule">Intitulé :</label>
            <input type="text" class="form-control" id="intitule" name="intitule" value="<?php echo $intitule; ?>">
        </div>
        <div class="form-group mt-2 mb-2">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
        </div>
        <div class="form-group mt-2 mb-2">
            <label for="image">Image :</label>
            <input type="file" class="form-control" id="image" name="image" value="<?php echo $image; ?>">
        </div>
        <div class="form-group mt-2 mb-2">
            <label for="date_debut">Date de début :</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?php echo $dateDebut; ?>">
        </div>
        <div class="form-group mt-2 mb-2">
            <label for="date_fin">Date de fin :</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?php echo $dateFin; ?>">
        </div>
        <div class="form-group mt-2 mb-2">
            <label for="lieu">Lieu :</label>
            <input type="text" class="form-control" id="lieu" name="lieu" value="<?php echo $lieu; ?>">
        </div>
        <div class="form-group mt-2 mb-2">
            <label for="id_animateur">Animateur :</label>
            <select class="form-control" id="id_animateur" name="id_animateur">
                <?php while ($animateur = $animateurs->fetch_assoc()) : ?>
                    <option value="<?php echo $animateur["ID_Anim"]; ?>" <?php if ($animateur["ID_Anim"] == $idAnimateur) echo "selected"; ?>><?php echo $animateur["nom_Anim"]; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<?php include("../footer.html"); ?>