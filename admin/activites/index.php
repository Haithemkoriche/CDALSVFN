<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer la liste des activités depuis la base de données
$sql = "SELECT * FROM `activities` INNER JOIN `ateliers` ON `activities`.`ID_ate_foreign` = `ateliers`.`ID_ate`";
$result = mysqli_query($conn, $sql);
$activites = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container overflow-auto">
    <div class="row justify-content-between mt-2 mb-2">
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Liste des activités</h2>
        <div class="col-4">
            <a href="ajouter.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Ajouter une activité</a>
        </div>
    </div>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Atelier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activites as $activite) : ?>
                <tr>
                    <td><?php echo $activite['titre_act']; ?></td>
                    <td><?php echo $activite['description_act']; ?></td>
                    <td><?php echo $activite['duree_act']; ?></td>
                    <td><?php echo $activite['intitule_ate']; ?></td>
                    <td class="col-2">
                        <a href="voir.php?id=<?php echo $activite["ID_act"]; ?>" class="btn btn-primary btn-sm mt-2 mb-2"><i class="fa-regular fa-eye"></i></a>
                        <a href="modifier.php?id=<?php echo $activite["ID_act"]; ?>" class="btn btn-warning btn-sm mt-2 mb-2"><i class="fa fa-edit"></i></a>
                        <a href="supprimer.php?id=<?php echo $activite["ID_act"]; ?>" class="btn btn-danger btn-sm mt-2 mb-2"><i class="fa fa-trash"></i> </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>