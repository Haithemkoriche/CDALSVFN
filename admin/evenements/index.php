<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';
require_once '../../config/action_verification.php';

// Préparer et exécuter la requête pour récupérer tous les événements
$stmt = $conn->prepare("SELECT * FROM evenements");
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
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a>Liste des événements</h2>
        <div class="col-4">
            <a href="ajouter.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>
                Ajouter un evenement</a>
        </div>
    </div>
    <?php if (@$delete) : ?>
        <div class="alert alert-success" role="alert">
            Les données de evenement a été suuprimer avec succès.
        </div>
    <?php endif; ?>
    <?php if (@$add) : ?>
        <div class="alert alert-success" role="alert">
            Les données de evenement a été sauvgarder avec succès.
        </div>
    <?php endif; ?>
    <table class="table table-striped table-bordered"> 
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Animateur</th>
                <th>Lieu</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row["intitule_E"]; ?></td>
                    <td><?php echo $row["date_d_E"]; ?></td>
                    <td><?php echo $row["date_f_E"]; ?></td>
                    <td>
                        <?php
                        // Récupérer le nom de l'animateur associé à l'événement
                        $stmt = $conn->prepare("SELECT nom_Anim FROM animateurs WHERE ID_Anim = ?");
                        $stmt->bind_param("i", $row["ID_Anim_foreign"]);
                        $stmt->execute();
                        $animateurResult = $stmt->get_result();

                        // Vérifier si l'animateur existe dans la base de données
                        if ($animateurResult->num_rows == 1) {
                            $animateurRow = $animateurResult->fetch_assoc();
                            echo $animateurRow["nom_Anim"];
                        } else {
                            echo "Inconnu";
                        }
                        ?>
                    </td>
                    <td><?php echo $row["lieu_E"];  ?></td>
                    <td class="col-2">
                        <a href="voir.php?id=<?php echo $row["ID_E"]; ?>" class="btn btn-primary btn-sm mt-2 mb-2"><i class="fa-regular fa-eye"></i></a>
                        <a href="modifier.php?id=<?php echo $row["ID_E"]; ?>" class="btn btn-warning btn-sm mt-2 mb-2"><i class="fa fa-edit"></i></a>
                        <a href="supprimer.php?id=<?php echo $row["ID_E"]; ?>" class="btn btn-danger btn-sm mt-2 mb-2"><i class="fa fa-trash"></i> </a>
                    </td> 
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>