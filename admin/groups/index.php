<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
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
<div class="container">
    <h2>Liste des groupes</h2>
    <a href="ajouter.php" class="btn btn-primary mb-3">Ajouter un groupe</a>
    <table class="table table-striped">
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
                        <a href="voir.php?id=<?php echo $groupe["ID_grp"]; ?>" class="btn btn-primary btn-sm">Voir</a>
                        <a href="modifier.php?id=<?php echo $groupe["ID_grp"]; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer.php?id=<?php echo $groupe["ID_grp"]; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
