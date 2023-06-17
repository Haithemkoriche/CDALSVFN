<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du participant est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du participant depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête pour supprimer le participant spécifié
    $stmt = $conn->prepare("DELETE FROM participant_evenement WHERE id_p_e = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Rediriger vers la page de liste des participants après la suppression
    header("Location: participants.php?evenement_id=".$_GET['evenement_id']."&delete=true");
    exit();
} else {
    // Rediriger vers la page de liste des participants si l'ID du participant n'est pas spécifié dans l'URL
    header("Location: participants.php?evenement_id=".$_GET['evenement_id']."");
    exit();
}
?>
