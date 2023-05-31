<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du participant est passé en paramètre d'URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Préparer et exécuter la requête pour supprimer le participant
    $stmt = $conn->prepare("DELETE FROM participants WHERE ID_p = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Rediriger vers la page de liste des participants après la suppression
    header("Location: index.php");
    exit();
} else {
    echo "ID du participant non spécifié.";
    exit();
}
?>
