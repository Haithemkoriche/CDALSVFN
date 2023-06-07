<?php include("../layout.php"); ?>
<?php require_once '../../config/action_verification.php'; ?>

<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container overflow-auto">
    <div class="row justify-content-between mt-2 mb-2">
        <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Liste des ateliers</h2>
        <div class="col-4">
            <a href="ajouter.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>  Ajouter un atelier</a>
        </div>
    </div>
    <?php if (@$delete) : ?>
        <div class="alert alert-success" role="alert">
            Les données de atelier a été suuprimer avec succès.
        </div>
    <?php endif; ?>
    <?php if (@$add) : ?>
        <div class="alert alert-success" role="alert">
            Les données de atelier a été sauvgarder avec succès.
        </div>
    <?php endif; ?>
    <?php if (@$edit) : ?>
        <div class="alert alert-success" role="alert">
            Les données de atelier a été modifier avec succès.
        </div>
    <?php endif; ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Intitulé</th>
                <th>Description</th>
                <th>Image</th>
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
                    echo '<td>' . $row['nom_form'] . '</td>';
                    echo '<td class="col-2">';
                    echo '<a href="voir.php?id=' . $row['ID_ate'] . '" class="btn btn-primary btn-sm mt-2 mb-2"><i class="fa-regular fa-eye"></i></a> ';
                    echo '<a href="modifier.php?id=' . $row['ID_ate'] . '" class="btn btn-warning btn-sm mt-2 mb-2"><i class="fa fa-edit"></i></a> ';
                    echo '<a href="supprimer.php?id=' . $row['ID_ate'] . '" class="btn btn-danger btn-sm mt-2 mb-2"><i class="fa fa-trash"></i></a>';
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