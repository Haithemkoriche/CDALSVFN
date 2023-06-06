<?php include("../layout.php"); ?>

<head>
  <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
  <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
  <div class="row justify-content-between mt-2 mb-2">
    <h2 class="col-4"><a href="../admin_panel.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Liste des formateurs</h2>
    <div class="col-4">
      <a href="ajouter.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Ajouter formateur</a>
    </div>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Inclure le fichier de configuration de la base de données
      require_once '../../config/bdd.php';

      // Récupérer tous les formateurs de la base de données
      $sql = "SELECT * FROM formateurs";
      $result = mysqli_query($conn, $sql);

      // Vérifier s'il y a des formateurs
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $row['ID_form'] . '</td>';
          echo '<td>' . $row['Nom_form'] . '</td>';
          echo '<td>' . $row['prenom_form'] . '</td>';
          echo '<td>' . $row['Email_form'] . '</td>';
          echo '<td>' . $row['telephon_form'] . '</td>';
          echo '<td class="col-2">';
          echo '<a href="voir.php?id=' . $row["ID_form"] . '" class="btn btn-primary btn-sm mt-2 mb-2"><i class="fa-regular fa-eye"></i></a> ';
          echo '<a href="modifier.php?id=' . $row["ID_form"] . '" class="btn btn-warning btn-sm mt-2 mb-2"><i class="fa fa-edit"></i></a> ';
          echo '<a href="supprimer.php?id=' . $row["ID_form"] . '" class="btn btn-danger btn-sm mt-2 mb-2"><i class="fa fa-trash"></i> </a> ';
          echo '</td>';
          echo '</tr>';
        }
      } else {
        echo '<tr><td colspan="8">Aucun formateur trouvé.</td></tr>';
      }

      // Fermer la connexion à la base de données
      mysqli_close($conn);
      ?>
    </tbody>
  </table>
</div>

<?php include("../footer.html"); ?>