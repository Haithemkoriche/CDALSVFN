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
    $duree_act = $_POST['duree_act'];
    $id_atelier = $_POST["id_atelier"];

    // Mettre à jour les informations de l'activité dans la base de données
    $sql = "UPDATE `activities` SET `titre_act` = '$titre_act', `description_act` = '$description_act',`duree_act`= '$duree_act', `ID_ate_foreign` = '$id_atelier' WHERE `ID_act` = $id_act";
    $result = mysqli_query($conn, $sql);

    // Vérifier si la mise à jour a réussi
    if ($result) {
        $success = true;
    } else {
        $danger = true;
    }
}
?>

<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css"> 
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <h2><a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Modifier une activité</h2>
    <?php if (@$success) : ?>
        <div class="alert alert-success" role="alert">
            Les données de l'activité a été modifier avec succès.
        </div>
    <?php endif; ?>
<?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
        Une erreur s'est produite lors de la mise à jour du l'activité.
        </div>
    <?php endif; ?>
    <form method="POST" action="modifier.php?id=<?php echo $id_act; ?>">
        <div class="form-group">
            <label class="form-label" for="titre_act">Titre:</label>
            <input type="text" class="form-control" name="titre_act" id="titre_act" value="<?php echo $activite['titre_act']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="description_act">Description:</label>
            <textarea class="form-control" name="description_act" id="description_act"><?php echo $activite['description_act']; ?></textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="duree_act">La Durée:</label>
            <input class="form-control" name="duree_act" id="duree_act" value="<?php echo $activite['duree_act']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="id_atelier">Atelier :</label>
            <select class="form-control" id="id_atelier" name="id_atelier" required>
                <?php foreach ($ateliers as $atelier) : ?>
                    <option value="<?php echo $atelier["ID_ate"]; ?>" <?php if ($atelier["ID_ate"] == $activite["ID_ate_foreign"]) echo "selected"; ?>><?php echo $atelier["intitule_ate"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Modifier</button>
    </form>
</div>

<?php include("../footer.html"); ?>