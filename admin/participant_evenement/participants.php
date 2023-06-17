<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
require_once '../../config/action_verification.php';

// Récupérer l'ID de l'événement depuis la requête GET
$evenement_id = $_GET['evenement_id'];

// Préparer et exécuter la requête pour récupérer tous les participants de l'événement
$result = $conn->query("SELECT id_p_e, nom_p_e, prenom_p_e, email_p_e, telephone_p_e, adresse_p_e FROM participant_evenement WHERE evenement_id = $evenement_id");

// Vérifier si des participants existent dans la base de données
if ($result->num_rows > 0) {
    $participants = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $participants = [];
}
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>

<div class="container overflow-auto">
    <div class="row justify-content-between mt-2 mb-2">
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Liste des participants</h2>
        <div class="col-4">
            <a href="ajouter_participant.php?evenement_id=<?php echo $evenement_id; ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Ajouter un participant</a>
        </div>
    </div>
    <?php if (@$add) : ?>
    <div class="alert alert-success" role="alert">
      Le participant a été ajouté avec succès.
    </div>
  <?php endif; ?>
  <?php if (@$delete) : ?>
        <div class="alert alert-success" role="alert">
            Les données de participant a été suuprimer avec succès.
        </div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participants as $participant) : ?>
                <tr>
                    <td><?php echo $participant["id_p_e"]; ?></td>
                    <td><?php echo $participant["nom_p_e"]; ?></td>
                    <td><?php echo $participant["prenom_p_e"]; ?></td>
                    <td><?php echo $participant["email_p_e"]; ?></td>
                    <td><?php echo $participant["telephone_p_e"]; ?></td>
                    <td><?php echo $participant["adresse_p_e"]; ?></td>
                    <td>
                        <a href="modifier_participant.php?id=<?php echo $participant["id_p_e"]; ?>&evenement_id=<?php echo $evenement_id; ?>  " class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="supprimer_participant.php?id=<?php echo $participant["id_p_e"]; ?>&evenement_id=<?php echo $evenement_id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
