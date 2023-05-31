<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
// Vérifier si l'ID du groupe est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du groupe depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête pour récupérer les informations du groupe spécifié
    $stmt = $conn->prepare("SELECT * FROM groups WHERE ID_grp = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si le groupe existe dans la base de données
    if ($result->num_rows == 1) {
        // Récupérer les informations du groupe
        $row = $result->fetch_assoc();
        $intitule = $row["int_grp"];
        $dateDebut = $row["date_deb_grp"];
    } else {
        // Rediriger vers la page de liste des groupes si le groupe n'existe pas
        header("Location: table.php");
        exit();
    }
} else {
    // Rediriger vers la page de liste des groupes si l'ID du groupe n'est pas spécifié dans l'URL
    header("Location: table.php");
    exit();
}
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Groupe <?php echo $intitule; ?></h2>
    <p><strong>Date de début :</strong> <?php echo $dateDebut; ?></p>
    <a href="table.php" class="btn btn-primary">Retour</a>
</div>

<?php include("../footer.html"); ?>
