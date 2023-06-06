<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $intitule = $_POST["intitule"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $dateDebut = $_POST["date_debut"];
    $dateFin = $_POST["date_fin"];
    $idAnimateur = $_POST["id_animateur"];
    // Récupérer le nom du fichier téléchargé
    $image = $_FILES["image"]["name"];

    // Récupérer le chemin temporaire du fichier
    $tmpFilePath = $_FILES["image"]["tmp_name"];

    // Déplacer le fichier vers un emplacement permanent
    $targetPath = '../../images/'.$image;
    move_uploaded_file($tmpFilePath, $targetPath);

    // Préparer et exécuter la requête d'insertion des données
    $stmt = $conn->prepare("INSERT INTO evenements (intitule_E, description_E, image_E, date_d_E, date_f_E, ID_Anim_foreign) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $intitule, $description, $image, $dateDebut, $dateFin, $idAnimateur);
    $stmt->execute();


    // Rediriger vers la page de liste des événements
    header("Location: index.php");
    exit();
}

// Récupérer les animateurs disponibles
$stmt = $conn->prepare("SELECT ID_Anim, nom_Anim FROM animateurs");
$stmt->execute();
$animateurs = $stmt->get_result();
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Ajouter un événement</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="intitule">Intitulé :</label>
            <input type="text" class="form-control" id="intitule" name="intitule" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début :</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date de fin :</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" required>
        </div>
        <div class="form-group">
            <label for="id_animateur">Animateur :</label>
            <select class="form-control" id="id_animateur" name="id_animateur" required>
                <?php while ($row = $animateurs->fetch_assoc()) : ?>
                    <option value="<?php echo $row["ID_Anim"]; ?>"><?php echo $row["nom_Anim"]; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>