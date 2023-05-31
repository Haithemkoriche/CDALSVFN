<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer la liste des activités depuis la base de données
$sql = "SELECT * FROM `activities` INNER JOIN `ateliers` ON `activities`.`ID_ate_foreign` = `ateliers`.`ID_ate`";
$result = mysqli_query($conn, $sql);
$activites = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Liste des activités</h2>
    <a href="ajouter.php" class="btn btn-primary mb-3">Ajouter une activité</a>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Atelier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activites as $activite) : ?>
                <tr>
                    <td><?php echo $activite['titre_act']; ?></td>
                    <td><?php echo $activite['description_act']; ?></td>
                    <td><?php echo $activite['intitule_ate']; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $activite['ID_act']; ?>" class="btn btn-info btn-sm">Voir</a>
                        <a href="modifier.php?id=<?php echo $activite['ID_act']; ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="supprimer.php?id=<?php echo $activite['ID_act']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
