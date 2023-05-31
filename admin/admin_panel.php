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

// Close the database connection
$conn->close();
?>


<?php include('layout.php'); ?>


<div class="container mt-5">
  <div class="container mt-5">
    <div class="row gap-sm-3 gap-lg-0">
      <div class="col-md-12 col-lg-3">
        <div class="card bg-primary text-white">
          <div class="card-body">
            <h5 class="card-title"> <i class="fas fa-users"></i> Participantes</h5>
            <h2 class="card-text d-flex justify-content-between"> <?php echo $participantsCount; ?> <a href="" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3">
        <div class="card bg-success text-white">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-users"></i> Formateurs</h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $formateursCount; ?><a href="" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3">
        <div class="card bg-info text-white">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-list"></i> Activités</h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $activitiesCount; ?> <a href="activites/index.php" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3">
        <div class="card bg-warning text-dark">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-tools"></i> Ateliers</h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $ateliersCount; ?> <a href="" class="text-white "><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"> <i class="fas fa-calendar-alt"></i> Événements </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $evenementsCount; ?> <a href="" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-envelope animated faa-shake"></i>
 Messages </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $contactsCount; ?><a href="" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
      <div class="col-md-6">
      <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-user"></i> Animateurs </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $animateursCount; ?><a href="" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-play"></i> Carousels </h5>
            <h2 class="card-text d-flex justify-content-between"><?php echo $carouselsCount; ?><a href="" class=""><i class="fas fa-arrow-right"></i></a></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>

  <?php include('footer.html'); ?>