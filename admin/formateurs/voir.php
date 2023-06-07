<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du formateur est passé en paramètre
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Récupérer les données du formateur à partir de l'ID
    $stmt = $conn->prepare("SELECT * FROM formateurs WHERE ID_form = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $formateur = $result->fetch_assoc();

    // Vérifier si le formateur existe

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID du formateur non spécifié.";
}
?>

<?php include("../layout.php"); ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <div class="row justify-content-between mt-2 mb-2">
        <h2 class="col-4"> Formateur </h2>
        <div class="col-4">
            <a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
            <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
        </div>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Nom</th>
                <td><?php echo $formateur["Nom_form"]; ?></td>
            </tr>

            <tr>
                <th>Prénom</th>
                <td><?php echo $formateur["prenom_form"]; ?></td>
            </tr>
            <tr>
                <th> Email</th>
                <td> <?php echo $formateur["Email_form"]; ?></td>
            </tr>
            <tr>
                <th> Téléphone</th>
                <td> <?php echo $formateur["telephon_form"]; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include("../footer.html"); ?>