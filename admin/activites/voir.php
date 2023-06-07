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
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <h2>Détails de l'activité</h2>
<a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id_act; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
    <a href="supprimer.php?id=<?php echo $id_act; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
    <?php if ($activite) : ?>
        <table class="table">
        <tbody>
            <tr>
                <th>Intitulé de l'activité :</th>
                <td><?php echo $activite['titre_act']; ?></td>
            </tr>
            <tr>
                <th>Description de l'activité :</th>
                <td><?php echo $activite['description_act']; ?></td>
            </tr>
            <tr>
                <th>Image :</th>
                <td><img src="../../images/<?php echo $activite['image_act']; ?>" alt="Image de l'activité" width="200"></td>
            </tr>
            <tr>
                <th>Durée de l'activité :</th>
                <td><?php echo $activite['duree_act']; ?></td>
            </tr>
            <tr>
                <th>Atelier: </th>
                <td><?php echo $activite['intitule_ate']; ?></td>
            </tr>
        </tbody>
    </table>
    <?php else : ?>
        <p>Aucune activité trouvée.</p>
    <?php endif; ?>
</div>

<?php include("../footer.html"); ?>
