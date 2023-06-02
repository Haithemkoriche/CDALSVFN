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
    
    if ($formateur) {
        echo "<h2>Formateur #" . $formateur["ID_form"] . "</h2>";
        echo "<p>Nom: " . $formateur["Nom_form"] . "</p>";
        echo "<p>Prénom: " . $formateur["prenom_form"] . "</p>";
        echo "<p>Email: " . $formateur["Email_form"] . "</p>";
        echo "<p>Téléphone: " . $formateur["telephon_form"] . "</p>";
        echo "<p>Date de création: " . $formateur["created_at"] . "</p>";
        echo "<p>Date de modification: " . $formateur["updated_at"] . "</p>";
    } else {
        echo "Formateur non trouvé.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID du formateur non spécifié.";
}
?>
    <a href="index.php" class="btn btn-primary">Retour</a>

<?php include("../footer.html"); ?>
