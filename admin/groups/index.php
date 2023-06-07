<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
require_once '../../config/action_verification.php';

// Préparer et exécuter la requête pour récupérer tous les groupes
$result = $conn->query("SELECT * FROM groups");

// Vérifier si des groupes existent dans la base de données
if ($result->num_rows > 0) {
    $groupes = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $groupes = [];
}
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container overflow-auto">
    <div class="row justify-content-between mt-2 mb-2">
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Liste des groupes</h2>
        <div class="col-4">
            <a href="ajouter.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Ajouter un groupe</a>
        </div>
    </div>
    <?php if (@$delete) : ?>
        <div class="alert alert-success" role="alert">
            Les données de group a été suuprimer avec succès.
        </div>
    <?php endif; ?>
    <?php if (@$add) : ?>
        <div class="alert alert-success" role="alert">
            Les données de group a été sauvgarder avec succès.
        </div>
    <?php endif; ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Intitulé</th>
                <th>Date de début</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupes as $groupe) : ?>
                <tr>
                    <td><?php echo $groupe["ID_grp"]; ?></td>
                    <td><?php echo $groupe["int_grp"]; ?></td>
                    <td><?php echo $groupe["date_deb_grp"]; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $groupe["ID_grp"]; ?>" class="btn btn-primary btn-sm"><i class="fa-regular fa-eye"></i></a>
                        <a href="modifier.php?id=<?php echo $groupe["ID_grp"]; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="supprimer.php?id=<?php echo $groupe["ID_grp"]; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>