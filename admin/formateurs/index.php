<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer tous les formateurs de la base de données
$sql = "SELECT * FROM formateurs";
$result = mysqli_query($conn, $sql);

// Vérifier s'il y a des formateurs
if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nom</th>";
    echo "<th>Prénom</th>";
    echo "<th>Email</th>";
    echo "<th>Téléphone</th>";
    echo "<th>Date de création</th>";
    echo "<th>Date de modification</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID_form'] . "</td>";
        echo "<td>" . $row['Nom_form'] . "</td>";
        echo "<td>" . $row['prenom_form'] . "</td>";
        echo "<td>" . $row['Email_form'] . "</td>";
        echo "<td>" . $row['telephon_form'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "<td>" . $row['updated_at'] . "</td>";
        echo "<td>";
        echo "<a href='voir.php?id=" . $row['ID_form'] . "' class='btn btn-primary btn-sm'>Voir</a> ";
        echo "<a href='modifier.php?id=" . $row['ID_form'] . "' class='btn btn-success btn-sm'>Modifier</a> ";
        echo "<a href='supprimer.php?id=" . $row['ID_form'] . "' class='btn btn-danger btn-sm'>Supprimer</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "Aucun formateur trouvé.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

<?php include("../footer.html"); ?>
