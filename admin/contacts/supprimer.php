<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du contact est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du contact depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête de suppression du contact spécifié
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id_contact = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Rediriger vers la page de liste des contacts
    header("Location: index.php?delete=true");
    exit();
} else {
    echo "ID du contact non spécifié.";
}
?>
