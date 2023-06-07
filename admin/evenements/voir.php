<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'événement est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID de l'événement depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête pour récupérer les informations de l'événement spécifié
    $stmt = $conn->prepare("SELECT * FROM evenements WHERE ID_E = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'événement existe dans la base de données
    if ($result->num_rows == 1) {
        // Récupérer les informations de l'événement
        $row = $result->fetch_assoc();
        $intitule = $row["intitule_E"];
        $description = $row["description_E"];
        $image = $row["image_E"];
        $dateDebut = $row["date_d_E"];
        $dateFin = $row["date_f_E"];
        $lieu = $row["lieu_E"];
        $idAnimateur = $row["ID_Anim_foreign"];
    } else {
        // Rediriger vers la page de liste des événements si l'événement n'existe pas
        header("Location: index.php");
        exit();
    }
} else {
    // Rediriger vers la page de liste des événements si l'ID de l'événement n'est pas spécifié
    header("Location: index.php");
    exit();
}

// Récupérer le nom de l'animateur associé à l'événement
$stmt = $conn->prepare("SELECT nom_Anim FROM animateurs WHERE ID_Anim = ?");
$stmt->bind_param("i", $idAnimateur);
$stmt->execute();
$animateurResult = $stmt->get_result();

// Vérifier si l'animateur existe dans la base de données
if ($animateurResult->num_rows == 1) {
    $animateurRow = $animateurResult->fetch_assoc();
    $nomAnimateur = $animateurRow["nom_Anim"];
} else {
    $nomAnimateur = "Inconnu";
}
?>

<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
</head>
<div class="container">
    <h2>Détails de l'événement</h2>
    <a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
    <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
    <table class="table">
        <tbody>
            <tr>
                <th>Intitulé :</th>
                <td><?php echo $intitule; ?></td>
            </tr>
            <tr>
                <th>Description :</th>
                <td><?php echo $description; ?></td>
            </tr>
            <tr>
                <th>Image :</th>
                <td><img src="../../images/<?php echo $image; ?>" alt="Image de l'événement" width="200"></td>
            </tr>
            <tr>
                <th>Date de début :</th>
                <td><?php echo $dateDebut; ?></td>
            </tr>
            <tr>
                <th>Date de fin :</th>
                <td><?php echo $dateFin; ?></td>
            </tr>
            <tr>
                <th>Lieu :</th>
                <td><?php echo $lieu; ?></td>
            </tr>
            <tr>
                <th>Animateur :</th>
                <td><?php echo $nomAnimateur; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>