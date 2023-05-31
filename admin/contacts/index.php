<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Préparer et exécuter la requête de sélection de tous les contacts
$stmt = $conn->prepare("SELECT * FROM contacts");
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Liste des contacts</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <th scope="row"><?php echo $row["id_contact"]; ?></th>
                    <td><?php echo $row["name_contact"]; ?></td>
                    <td><?php echo $row["email_contact"]; ?></td>
                    <td><?php echo $row["phone_contact"]; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $row["id_contact"]; ?>" class="btn btn-primary btn-sm">Voir</a>
                        <a href="supprimer.php?id=<?php echo $row["id_contact"]; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
