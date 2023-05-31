<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'événement est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID de l'événement depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête de suppression de l'événement spécifié
    $stmt = $conn->prepare("DELETE FROM evenements WHERE ID_E = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Rediriger vers la page de liste des événements
header("Location: index.php");
exit();
?>
