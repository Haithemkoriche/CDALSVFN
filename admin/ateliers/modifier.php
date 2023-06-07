<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'atelier est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de l'atelier avec l'ID spécifié
    $sql = "SELECT a.*, f.nom_form FROM ateliers a LEFT JOIN formateurs f ON a.ID_form_foreign = f.ID_form WHERE a.ID_ate = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'atelier existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css"> 
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
        <div class="container">
            <h2>Modifier l'atelier</h2>
            <?php if (@$success) : ?>
        <div class="alert alert-success" role="alert">
            Les données de ateliers a été modifier avec succès.
        </div>
    <?php endif; ?>
<?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
        Une erreur s'est produite lors de la mise à jour du ateliers.
        </div>
    <?php endif; ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="intitule">Intitulé :</label>
                    <input type="text" class="form-control" name="intitule" id="intitule" value="<?php echo $row['intitule_ate']; ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea class="form-control" name="description" id="description"><?php echo $row['description_ate']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image :</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                    <p>Image actuelle :</p>
                    <img src="../../images/<?php echo $row['image_ate']; ?>" width="200" height="200" alt="Image de l'atelier">
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
                            $selected = ($formateur['ID_form'] == $row['ID_form_foreign']) ? 'selected' : '';
                            echo '<option value="' . $formateur['ID_form'] . '" ' . $selected . '>' . $formateur['Nom_form'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
<?php
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les nouvelles données du formulaire
            $newIntitule = $_POST["intitule"];
            $newDescription = $_POST["description"];
            $newFormateur = $_POST["formateur"];

            // Vérifier si un nouveau fichier image a été uploadé
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                $newImage = $_FILES["image"]["name"];
                $newImageTmp = $_FILES["image"]["tmp_name"];
                $newImagePath = "../../images/" . $newImage;

                // Déplacer le nouveau fichier image vers le dossier de destination
                move_uploaded_file($newImageTmp, $newImagePath);

                // Supprimer l'ancienne image associée à l'atelier
                unlink("../../images/" . $row['image_ate']);
            } else {
                // Conserver l'ancienne image si aucun nouveau fichier n'a été uploadé
                $newImage = $row['image_ate'];
            }

            // Mettre à jour les données de l'atelier dans la base de données
            $updateStmt = $conn->prepare("UPDATE ateliers SET intitule_ate = ?, image_ate = ?, description_ate = ?, ID_form_foreign = ? WHERE ID_ate = ?");
            $updateStmt->bind_param("ssssi", $newIntitule, $newImage, $newDescription, $newFormateur, $id);
            $updateStmt->execute();

            // Vérifier si la mise à jour a réussi
            if ($updateStmt->affected_rows > 0) {
                $success = true;
            } else {
                $danger = true;
            }

            // Fermer la connexion à la base de données
            $updateStmt->close();
        }
    } else {
        echo '<p>Aucun atelier trouvé avec cet ID.</p>';
    }

    // Fermer la connexion à la base de données
    $stmt->close();
} else {
    echo '<p>Aucun ID d\'atelier spécifié.</p>';
}

// Fermer la connexion à la base de données
$conn->close();
?>