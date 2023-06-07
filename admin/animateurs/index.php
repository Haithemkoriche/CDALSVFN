<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';
require_once '../../config/action_verification.php';

// Préparer et exécuter la requête de sélection des animateurs
$stmt = $conn->prepare("SELECT * FROM animateurs");
$stmt->execute();
$result = $stmt->get_result();

?>

<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css"> 
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container overflow-auto">
    <div class="row justify-content-between mt-2 mb-2">
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a>Liste des animateurs</h2>
        <div class="col-4">
            <a href="ajouter.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Ajouter un animateur</a>
    </div>
    </div>
    <?php if (@$delete) : ?>
        <div class="alert alert-success" role="alert">
            Les données de animateur a été suuprimer avec succès.
        </div>
    <?php endif; ?>
    <?php if (@$add) : ?>
        <div class="alert alert-success" role="alert">
            Les données de animateur a été sauvgarder avec succès.
        </div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($animateur = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $animateur["ID_Anim"]; ?></td>
                    <td><?php echo $animateur["Nom_anim"]; ?></td>
                    <td><?php echo $animateur["prenom_anim"]; ?></td>
                    <td><?php echo $animateur["Email_anim"]; ?></td>
                    <td><?php echo $animateur["telephon_anim"]; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $animateur["ID_Anim"]; ?>" class="btn btn-primary btn-sm">Voir</a>
                        <a href="modifier.php?id=<?php echo $animateur["ID_Anim"]; ?>" class="btn btn-success btn-sm">Modifier</a>
                        <a href="supprimer.php?id=<?php echo $animateur["ID_Anim"]; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>