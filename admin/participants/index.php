<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Préparer et exécuter la requête pour récupérer la liste des participants avec les informations des clés étrangères
$stmt = $conn->prepare("SELECT participants.*, ateliers.Nom_ate, evenements.Nom_E, groups.Nom_grp FROM participants LEFT JOIN ateliers ON participants.ID_ate_foreign = ateliers.ID_ate LEFT JOIN evenements ON participants.ID_E_foreign = evenements.ID_E LEFT JOIN groups ON participants.ID_grp_foreign = groups.ID_grp");
$stmt->execute();
$result = $stmt->get_result();
$participants = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Liste des participants</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Atelier</th>
                <th>Événement</th>
                <th>Groupe</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participants as $participant) : ?>
                <tr>
                    <td><?php echo $participant["ID_p"]; ?></td>
                    <td><?php echo $participant["Nom_p"]; ?></td>
                    <td><?php echo $participant["prenom_p"]; ?></td>
                    <td><?php echo $participant["Email_p"]; ?></td>
                    <td><?php echo $participant["Nom_ate"]; ?></td>
                    <td><?php echo $participant["Nom_E"]; ?></td>
                    <td><?php echo $participant["Nom_grp"]; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $participant["ID_p"]; ?>">Voir</a> |
                        <a href="modifier.php?id=<?php echo $participant["ID_p"]; ?>">Modifier</a> |
                        <a href="supprimer.php?id=<?php echo $participant["ID_p"]; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
