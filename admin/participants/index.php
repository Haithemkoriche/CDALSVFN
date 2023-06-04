<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Préparer et exécuter la requête pour récupérer la liste des participants avec les informations des clés étrangères
$stmt = $conn->prepare("SELECT participants.*, activities.titre_act, groups.int_grp FROM participants LEFT JOIN activities ON participants.ID_act_foreign = activities.ID_act LEFT JOIN groups ON participants.ID_grp_foreign = groups.ID_grp");
$stmt->execute();
$result = $stmt->get_result();
$participants = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
</head>
<div class="container overflow-auto">
    <div class="row d-flex justify-content-between mt-2 mb-2">
        <h2>Liste des participants</h2>
        <a href="ajouter.php" class="btn btn-primary mb-3">Ajouter un participant</a>
    </div>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>telephone</th>
                <th>Activité</th>
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
                    <td><?php echo $participant["telephon_p"]; ?></td>
                    <td><?php echo $participant["titre_act"]; ?></td>
                    <td><?php echo $participant["int_grp"]; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $participant["ID_p"]; ?>" class="btn btn-primary btn-sm">Voir</a>
                        <a href="modifier.php?id=<?php echo $participant["ID_p"]; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer.php?id=<?php echo $participant["ID_p"]; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>