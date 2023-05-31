<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Préparer et exécuter la requête pour récupérer tous les événements
$stmt = $conn->prepare("SELECT * FROM evenements");
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include("../layout.php"); ?>
<div class="container">
    <div class="row d-flex justify-content-between mt-2 mb-2">
        <h2>Liste des événements</h2>
        <a href="ajouter.php" class="btn btn-primary">Ajouter un evenement</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Animateur</th>
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
                    <td>
                        <a href="voir.php?id=<?php echo $row["ID_E"]; ?>" class="btn btn-primary btn-sm">Voir</a>
                        <a href="modifier.php?id=<?php echo $row["ID_E"]; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer.php?id=<?php echo $row["ID_E"]; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>