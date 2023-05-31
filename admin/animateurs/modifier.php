<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si un ID d'animateur est spécifié dans l'URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];

        // Préparer et exécuter la requête de mise à jour de l'animateur
        $stmt = $conn->prepare("UPDATE animateurs SET Nom_anim = ?, prenom_anim = ?, Email_anim = ?, telephon_anim = ? WHERE ID_Anim = ?");
        $stmt->bind_param("ssssi", $nom, $prenom, $email, $telephone, $id);
        $stmt->execute();

        // Vérifier si la mise à jour a réussi
        if ($stmt->affected_rows > 0) {
            echo "Animateur mis à jour avec succès!";
        } else {
            echo "Une erreur s'est produite lors de la mise à jour de l'animateur.";
        }

        // Fermer les ressources
        $stmt->close();
        $conn->close();
    }

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
<div class="container">
    <h2>Modifier l'animateur</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $animateur["Nom_anim"]; ?>">
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $animateur["prenom_anim"]; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $animateur["Email_anim"]; ?>">
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $animateur["telephon_anim"]; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
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
