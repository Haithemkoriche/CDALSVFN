<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer l'ID de l'activité à modifier
if (isset($_GET['id'])) {
    $id_act = $_GET['id'];

    // Récupérer les informations de l'activité depuis la base de données
    $sql = "SELECT * FROM `activities` INNER JOIN `ateliers` ON `activities`.`ID_ate_foreign` = `ateliers`.`ID_ate` WHERE `ID_act` = $id_act";
    $result = mysqli_query($conn, $sql);
    $activite = mysqli_fetch_assoc($result);
}

// Récupérer la liste des ateliers
$sql_ateliers = "SELECT * FROM `ateliers`";
$result_ateliers = mysqli_query($conn, $sql_ateliers);
$ateliers = mysqli_fetch_all($result_ateliers, MYSQLI_ASSOC);

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre_act = $_POST['titre_act'];
    $description_act = $_POST['description_act'];
    $id_atelier = $_POST["id_atelier"];

    // Mettre à jour les informations de l'activité dans la base de données
    $sql = "UPDATE `activities` SET `titre_act` = '$titre_act', `description_act` = '$description_act', `ID_ate_foreign` = '$id_atelier' WHERE `ID_act` = $id_act";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: voir.php?id=$id_act");
        exit();
    } else {
        echo 'Erreur lors de la modification de l\'activité: ' . mysqli_error($conn);
    }
}
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Modifier une activité</h2>
    <form method="POST" action="modifier.php?id=<?php echo $id_act; ?>">
        <div class="form-group">
            <label for="titre_act">Titre:</label>
            <input type="text" class="form-control" name="titre_act" id="titre_act" value="<?php echo $activite['titre_act']; ?>">
        </div>
        <div class="form-group">
            <label for="description_act">Description:</label>
            <textarea class="form-control" name="description_act" id="description_act"><?php echo $activite['description_act']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="id_atelier">Atelier :</label>
            <select class="form-control" id="id_atelier" name="id_atelier" required>
                <?php foreach ($ateliers as $atelier) : ?>
                    <option value="<?php echo $atelier["ID_ate"]; ?>" <?php if ($atelier["ID_ate"] == $activite["ID_ate_foreign"]) echo "selected"; ?>><?php echo $atelier["intitule_ate"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<?php include("../footer.html"); ?>
