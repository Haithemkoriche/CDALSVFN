<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si un ID d'animateur est spécifié dans l'URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Préparer et exécuter la requête de sélection de l'animateur
    $stmt = $conn->prepare("SELECT * FROM animateurs WHERE ID_Anim = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier s'il y a un résultat
    if ($result->num_rows > 0) {
        $animateur = $result->fetch_assoc();
?>

<?php include("../layout.php"); ?>
<head>
            <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
        </head>
<div class="container">
    <h2>Détails de l'animateur</h2>
    <a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
    <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
    <table class="table">
        <tbody>
            <tr>
                <th>Nom</th>
                <td><?php echo $animateur["Nom_anim"]; ?></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td><?php echo $animateur["prenom_anim"]; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $animateur["Email_anim"]; ?></td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td><?php echo $animateur["telephon_anim"]; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>

<?php
    } else {
        echo "Aucun animateur trouvé.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID d'animateur non spécifié.";
}
?>
