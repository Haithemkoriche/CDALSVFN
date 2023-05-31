<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'événement est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID de l'événement depuis l'URL
    $id = $_GET["id"];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $intitule = $_POST["intitule"];
        $description = $_POST["description"];
        $image = $_POST["image"];
        $dateDebut = $_POST["date_debut"];
        $dateFin = $_POST["date_fin"];
        $idAnimateur = $_POST["id_animateur"];

        // Préparer et exécuter la requête de mise à jour des données de l'événement spécifié
        $stmt = $conn->prepare("UPDATE evenements SET intitule_E = ?, description_E = ?, image_E = ?, date_d_E = ?, date_f_E = ?, ID_Anim_foreign = ? WHERE ID_E = ?");
        $stmt->bind_param("sssssii", $intitule, $description, $image, $dateDebut, $dateFin, $idAnimateur, $id);
        $stmt->execute();

        // Rediriger vers la page de liste des événements
        header("Location: table.php");
        exit();
    }

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
        $idAnimateur = $row["ID_Anim_foreign"];
    } else {
        // Rediriger vers la page de liste des événements si l'événement n'existe pas
        header("Location: table.php");
        exit();
    }

    // Récupérer les animateurs disponibles
    $stmt = $conn->prepare("SELECT ID_Anim, nom_Anim FROM animateurs");
    $stmt->execute();
    $animateurs = $stmt->get_result();
} else {
    // Rediriger vers la page de liste des événements si l'ID de l'événement n'est pas spécifié
    header("Location: table.php");
    exit();
}
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Modifier un événement</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?>" method="POST">
        <div class="form-group">
            <label for="intitule">Intitulé :</label>
            <input type="text" class="form-control" id="intitule" name="intitule" value="<?php echo $intitule; ?>">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>">
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début :</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?php echo $dateDebut; ?>">
        </div>
        <div class="form-group">
            <label for="date_fin">Date de fin :</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?php echo $dateFin; ?>">
        </div>
        <div class="form-group">
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