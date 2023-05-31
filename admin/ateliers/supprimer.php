<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'atelier est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de l'atelier avec l'ID spécifié
    $sql = "SELECT image_ate FROM ateliers WHERE ID_ate = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'atelier existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image = $row['image_ate'];

        // Supprimer l'atelier de la base de données
        $deleteStmt = $conn->prepare("DELETE FROM ateliers WHERE ID_ate = ?");
        $deleteStmt->bind_param("i", $id);
        $deleteStmt->execute();

        // Vérifier si la suppression a réussi
        if ($deleteStmt->affected_rows > 0) {
            // Supprimer le fichier image associé
            unlink("../../images/" . $image);
            header("location: index.php");
        exit();
        } else {
            echo "<p>Une erreur s'est produite lors de la suppression de l'atelier.</p>";
        }

        // Fermer la connexion à la base de données
        $deleteStmt->close();
    } else {
        echo '<p>Aucun atelier trouvé avec cet ID.</p>';
    }

    // Fermer la connexion à la base de données
    $stmt->close();
} else {
    echo '<p>Aucun ID d\'atelier spécifié.</p>';
}

// Fermer la connexion à la base de données
$conn->close();
?>
