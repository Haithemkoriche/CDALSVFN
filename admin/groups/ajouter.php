<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
// Définir les variables
$intitule = "";
$dateDebut = "";
$success = false;

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $intitule = $_POST["intitule"];
    $dateDebut = $_POST["date_debut"];

    // Préparer et exécuter la requête d'insertion des données du groupe
    $stmt = $conn->prepare("INSERT INTO groups (int_grp, date_deb_grp) VALUES (?, ?)");
    $stmt->bind_param("ss", $intitule, $dateDebut);
    $stmt->execute();

    // Vérifier si l'insertion a réussi
    if ($stmt->affected_rows == 1) {
        $success = true;
    }
}
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Ajouter un groupe</h2>
    <?php if ($success) : ?>
        <div class="alert alert-success" role="alert">
            Le groupe a été ajouté avec succès.
        </div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="form-group">
            <label for="intitule">Intitulé :</label>
            <input type="text" class="form-control" id="intitule" name="intitule" value="<?php echo $intitule; ?>">
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début :</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?php echo $dateDebut; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>
