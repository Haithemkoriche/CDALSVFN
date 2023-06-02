<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
// Vérifier si l'ID du groupe est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du groupe depuis l'URL
    $id = $_GET["id"];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $intitule = $_POST["intitule"];
        $dateDebut = $_POST["date_debut"];

        // Préparer et exécuter la requête de mise à jour du groupe spécifié
        $stmt = $conn->prepare("UPDATE groups SET int_grp = ?, date_deb_grp = ? WHERE ID_grp = ?");
        $stmt->bind_param("ssi", $intitule, $dateDebut, $id);
        $stmt->execute();

        // Rediriger vers la page de visualisation du groupe après la mise à jour
        header("Location: voir.php?id=".$id);
        exit();
    }

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
<div class="container">
    <h2>Modifier le groupe <?php echo $intitule; ?></h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id; ?>" method="POST">
        <div class="form-group">
            <label for="intitule">Intitulé :</label>
            <input type="text" class="form-control" id="intitule" name="intitule" value="<?php echo $intitule; ?>">
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début :</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?php echo $dateDebut; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

<?php include("../footer.html"); ?>
