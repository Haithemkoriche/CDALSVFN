<?php
include("../config/bdd.php");
// Fetch counts from the database
$query = "SELECT COUNT(*) AS count FROM participants";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$participantsCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM formateurs";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$formateursCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM activities";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$activitiesCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM ateliers";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$ateliersCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM evenements";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$evenementsCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM animateurs";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$animateursCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM contacts";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$contactsCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM carousels";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$carouselsCount = $row['count'];

$query = "SELECT COUNT(*) AS count FROM groups";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$groupsCount = $row['count'];

// Close the database connection
$conn->close();
?>


<?php include('layout.php'); ?>


<div class="container mt-5" id="">
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12 col-lg-3 mt-3">
        <div class="card bg-primary text-white">
          <div class="card-body">
            <h5 class="card-title"> <i class="fas fa-users"></i> Participantes</h5>
            <h2 class="card-text d-flex justify-content-between"> <?php echo $participantsCount; ?> <a href="participants/" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 mt-3">
        <div class="card bg-success text-white">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-users"></i> Formateurs</h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $formateursCount; ?><a href="Formateurs/" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 mt-3">
        <div class="card bg-info text-white">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-list"></i> Activités</h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $activitiesCount; ?> <a href="activites/" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 mt-3">
        <div class="card bg-warning text-dark">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-tools"></i> Ateliers</h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $ateliersCount; ?> <a href="ateliers/" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card mt-2 mb-4 ">
          <div class="card-body">
            <h5 class="card-title"> <i class="fas fa-calendar-alt"></i> Événements </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $evenementsCount; ?> <a href="evenements/" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
        <div class="card mt-2 mb-4 ">
          <div class="card-body">
            <h5 class="card-title">
              <?php if ($contactsCount > 0) { ?><i class="fas fa-envelope animated faa-shake"></i><?php } else { ?><i class="fas fa-envelope"></i><?php } ?>
              Messages </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $contactsCount; ?><a href="contacts/" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mt-2 mb-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-users"></i> Animateurs </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $animateursCount; ?><a href="Animateurs/" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
        <div class="card mt-2 mb-4 ">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-play"></i> Carousels </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $carouselsCount; ?><a href="Carousels/" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-md-6">
        <div class="card mt-2 mb-4 ">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-users"></i> groups </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $groupsCount; ?><a href="groups/" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mt-2 mb-4 ">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-users"></i> Participants Evenements </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $evenementsCount; ?><a href="participant_evenement/" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.html'); ?>