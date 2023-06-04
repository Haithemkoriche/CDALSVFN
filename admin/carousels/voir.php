<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Préparer et exécuter la requête de sélection des carousels
$stmt = $conn->prepare("SELECT * FROM carousels");
$stmt->execute();
$result = $stmt->get_result();

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    ?>

    <?php include("../layout.php"); ?>
    <head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
</head>
    <div class="container">
        <h2>Liste des carousels</h2>
        <a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
    <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Afficher les résultats dans un tableau
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID_carousel"] . "</td>";
                    echo "<td>" . $row["titre_car"] . "</td>";
                    echo "<td>" . $row["description_car"] . "</td>";
                    echo "<td><img src='../../images/slide/" . $row["path_car"] . "' width='100'></td>";
                    echo "<td>";
                    echo "<a href='modifier.php?id=" . $row["ID_carousel"] . "' class='btn btn-primary'>Modifier</a>";
                    echo "<a href='supprimer.php?id=" . $row["ID_carousel"] . "' class='btn btn-danger'>Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include("../footer.html");

} else {
    echo "Aucun carousel trouvé.";
}

// Fermer les ressources
$stmt->close();
$conn->close();
?>
