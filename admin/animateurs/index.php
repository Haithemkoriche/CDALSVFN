<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Préparer et exécuter la requête de sélection des animateurs
$stmt = $conn->prepare("SELECT * FROM animateurs");
$stmt->execute();
$result = $stmt->get_result();

?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Liste des animateurs</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($animateur = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $animateur["ID_Anim"]; ?></td>
                    <td><?php echo $animateur["Nom_anim"]; ?></td>
                    <td><?php echo $animateur["prenom_anim"]; ?></td>
                    <td><?php echo $animateur["Email_anim"]; ?></td>
                    <td><?php echo $animateur["telephon_anim"]; ?></td>
                    <td>
                        <a href="voir.php?id=<?php echo $animateur["ID_Anim"]; ?>">Voir</a>
                        <a href="modifier.php?id=<?php echo $animateur["ID_Anim"]; ?>">Modifier</a>
                        <a href="supprimer.php?id=<?php echo $animateur["ID_Anim"]; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>
