<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si un ID de formateur est passé en paramètre
if (isset($_GET['id'])) {
    $formateurId = $_GET['id'];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];

        // Préparer et exécuter la requête de mise à jour
        $stmt = $conn->prepare("UPDATE formateurs SET Nom_form = ?, prenom_form = ?, Email_form = ?, telephon_form = ? WHERE ID_form = ?");
        $stmt->bind_param("ssssi", $nom, $prenom, $email, $telephone, $formateurId);
        $stmt->execute();

        // Vérifier si la mise à jour a réussi
        if ($stmt->affected_rows > 0) {
            $success=true;
        } else {
            $danger=true;
        }

        // Fermer les ressources
        $stmt->close();
    }

    // Récupérer les informations du formateur à partir de la base de données
    $stmt = $conn->prepare("SELECT * FROM formateurs WHERE ID_form = ?");
    $stmt->bind_param("i", $formateurId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si le formateur existe
    if ($result->num_rows == 1) {
        $formateur = $result->fetch_assoc();
?>

<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head> 
<div class="container">
<h2><a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Modifier le formateur</h2>
<?php if (@$success) : ?>
        <div class="alert alert-success" role="alert">
            Les données de Formateur a été modifier avec succès.
        </div>
    <?php endif; ?>
<?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
        Une erreur s'est produite lors de la mise à jour du formateur.
        </div>
    <?php endif; ?>
    <form method="POST" action="modifier.php?id=<?php echo $formateurId; ?>">
        <div class="form-group mt-2">
            <label for="nom">Nom:</label>
            <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $formateur['Nom_form']; ?>">
        </div>
        <div class="form-group mt-2">
            <label for="prenom">Prénom:</label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $formateur['prenom_form']; ?>">
        </div>
        <div class="form-group mt-2">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $formateur['Email_form']; ?>">
        </div>
        <div class="form-group mt-2">
            <label for="telephone">Téléphone:</label>
            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $formateur['telephon_form']; ?>">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Modifier</button>
    </form>
</div>
 
<?php
    } else {
        echo "Formateur non trouvé.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID de formateur non spécifié.";
}
?>

<?php include("../footer.html"); ?>
