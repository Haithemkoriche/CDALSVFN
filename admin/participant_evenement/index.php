<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
require_once '../../config/action_verification.php';

// Préparer et exécuter la requête pour récupérer tous les événements
$result = $conn->query("SELECT ID_E, intitule_E, date_d_E, lieu_E FROM evenements");

// Vérifier si des événements existent dans la base de données
if ($result->num_rows > 0) {
    $evenements = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $evenements = [];
}
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>

<div class="container overflow-auto">
    <div class="row justify-content-between mt-2 mb-2">
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Liste des événements</h2>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Événement</th>
                <th>Date d'événement</th>
                <th>Lieu</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evenements as $evenement) : ?>
                <tr>
                    <td><?php echo $evenement["ID_E"]; ?></td>
                    <td><?php echo $evenement["intitule_E"]; ?></td>
                    <td><?php echo $evenement["date_d_E"]; ?></td>
                    <td><?php echo $evenement["lieu_E"]; ?></td>
                    <td><a href="participants.php?evenement_id=<?php echo $evenement["ID_E"]; ?>">Voir les participants</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
