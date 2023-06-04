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
        <div class="row d-flex justify-content-between mt-2 mb-2">
            <h2>Liste des carousels</h2>
            <a href="ajouter.php" class="btn btn-primary p-2">Ajouter un carousels</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>action</th>
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
                    echo '<td>';
                    echo '<a href="voir.php?id=' . $row['ID_carousel'] . '" class="btn btn-primary btn-sm">Voir</a> ';
                    echo '<a href="modifier.php?id=' . $row['ID_carousel'] . '" class="btn btn-success btn-sm">Modifier</a> ';
                    echo '<a href="supprimer.php?id=' . $row['ID_carousel'] . '" class="btn btn-danger btn-sm">Supprimer</a>';
                    echo '</td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php include("../footer.html");
} else {
    header('location: ajouter.php');
    exit();
}

// Fermer les ressources
$stmt->close();
$conn->close();
?>