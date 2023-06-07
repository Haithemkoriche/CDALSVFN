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
        header("Location: index.php");
        exit();
    }
} else {
    // Rediriger vers la page de liste des groupes si l'ID du groupe n'est pas spécifié dans l'URL
    header("Location: index.php");
    exit();
}
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <div class="row justify-content-between mt-2 mb-2">
        <h2>Groupe <?php echo $intitule; ?></h2>
        </h2>
    </div>
    <p><strong>Date de début :</strong> <?php echo $dateDebut; ?></p>
    <a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
    <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
</div>

<?php include("../footer.html"); ?>