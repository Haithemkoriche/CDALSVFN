<?php include("../layout.php"); ?>
<div class="container">
    <div class="row d-flex justify-content-between mt-2 mb-2">
        <h2>Liste des ateliers</h2>
        <a href="ajouter.php" class="btn btn-primary">Ajouter un atelier</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Intitulé</th>
                <th>Description</th>
                <th>Image</th>
                <th>Date de création</th>
                <th>Date de modification</th>
                <th>Formateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Inclure le fichier de configuration de la base de données
            require_once '../../config/bdd.php';

            // Récupérer tous les ateliers de la base de données avec les informations du formateur associé
            $sql = "SELECT a.*, f.nom_form FROM ateliers a LEFT JOIN formateurs f ON a.ID_form_foreign = f.ID_form";
            $result = mysqli_query($conn, $sql);

            // Vérifier s'il y a des ateliers
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['ID_ate'] . '</td>';
                    echo '<td>' . $row['intitule_ate'] . '</td>';
                    echo '<td>' . $row['description_ate'] . '</td>';
                    echo '<td><img src="../../images/' . $row['image_ate'] . '" width="50" height="50"></td>';
                    echo '<td>' . $row['created_at'] . '</td>';
                    echo '<td>' . $row['updated_at'] . '</td>';
                    echo '<td>' . $row['nom_form'] . '</td>';
                    echo '<td>';
                    echo '<a href="voir.php?id=' . $row['ID_ate'] . '" class="btn btn-primary btn-sm">Voir</a> ';
                    echo '<a href="modifier.php?id=' . $row['ID_ate'] . '" class="btn btn-success btn-sm">Modifier</a> ';
                    echo '<a href="supprimer.php?id=' . $row['ID_ate'] . '" class="btn btn-danger btn-sm">Supprimer</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="8">Aucun atelier trouvé.</td></tr>';
            }

            // Fermer la connexion à la base de données
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
<?php include("../footer.html"); ?>
