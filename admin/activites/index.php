<?php include("../layout.php"); ?>
    <div class="container">
      <div class="row d-flex justify-content-between mt-2 mb-2">
        <h2>Liste des activités</h2>
      <a href="ajouter.php" class="btn btn-primary">ajouter activité</a>  
      </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Date de création</th>
                    <th>Date de modification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de configuration de la base de données
                require_once '../../config/bdd.php';

                // Récupérer toutes les activités de la base de données
                $sql = "SELECT `ID_act`, `title`, `description`, `image`, `created_at`, `updated_at` FROM `activities`";
                $result = mysqli_query($conn, $sql);

                // Vérifier s'il y a des activités
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['ID_act'] . '</td>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';
                        echo '<td><img src="../../images/' . $row['image'] . '" width="50" height="50"></td>';
                        echo '<td>' . $row['created_at'] . '</td>';
                        echo '<td>' . $row['updated_at'] . '</td>';
                        echo '<td>';
                        echo '<a href="voir.php?id=' . $row['ID_act'] . '" class="btn btn-primary btn-sm">Voir</a> ';
                        echo '<a href="modifier.php?id=' . $row['ID_act'] . '" class="btn btn-success btn-sm">Modifier</a> ';
                        echo '<a href="supprimer.php?id=' . $row['ID_act'] . '" class="btn btn-danger btn-sm">Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">Aucune activité trouvée.</td></tr>';
                }

                // Fermer la connexion à la base de données
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
<?php include("../footer.html");?>