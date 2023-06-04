<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer l'ID de l'activité à afficher
if (isset($_GET['id'])) {
    $id_act = $_GET['id'];

    // Récupérer les informations de l'activité depuis la base de données
    $sql = "SELECT * FROM `activities` INNER JOIN `ateliers` ON `activities`.`ID_ate_foreign` = `ateliers`.`ID_ate` WHERE `ID_act` = $id_act";
    $result = mysqli_query($conn, $sql);
    $activite = mysqli_fetch_assoc($result);
}
?>

<?php include("../layout.php"); ?>
<head>
            <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
        </head>
<div class="container">
<a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
    <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
    <h2>Détails de l'activité</h2>
    <?php if ($activite) : ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $activite['titre_act']; ?></h5>
                <p class="card-text"><?php echo $activite['description_act']; ?></p>
                <p class="card-text">Atelier: <?php echo $activite['intitule_ate']; ?></p>
                <img src="../../images/<?php echo $activite['image_act']; ?>" class="card-img-top" alt="Image de l'activité">
            </div>
        </div>
    <?php else : ?>
        <p>Aucune activité trouvée.</p>
    <?php endif; ?>
</div>

<?php include("../footer.html"); ?>
