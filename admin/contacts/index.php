<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';
require_once '../../config/action_verification.php';

// Préparer et exécuter la requête de sélection de tous les contacts
$stmt = $conn->prepare("SELECT * FROM contacts");
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
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a>Liste des contacts</h2>
    <?php if (@$delete) : ?>
        <div class="alert alert-success" role="alert">
            Les données de contact a été suuprimer avec succès.
        </div>
    <?php endif; ?>
    <?php if (@$add) : ?>
        <div class="alert alert-success" role="alert">
            Les données de contact a été sauvgarder avec succès.
        </div>
    <?php endif; ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <th scope="row"><?php echo $row["id_contact"]; ?></th>
                    <td><?php echo $row["name_contact"]; ?></td>
                    <td><?php echo $row["email_contact"]; ?></td>
                    <td><?php echo $row["phone_contact"]; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $row["id_contact"]; ?>" class="btn btn-primary btn-sm">Voir</a>
                        <a href="supprimer.php?id=<?php echo $row["id_contact"]; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
