<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';
// Vérifier si l'ID du groupe est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du groupe depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête pour supprimer le groupe spécifié
    $stmt = $conn->prepare("DELETE FROM groups WHERE ID_grp = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Rediriger vers la page de liste des groupes après la suppression
    header("Location: table.php");
    exit();
} else {
    // Rediriger vers la page de liste des groupes si l'ID du groupe n'est pas spécifié dans l'URL
    header("Location: index.php");
    exit();
}
