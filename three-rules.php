<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dalmatian Feeding Guide</title>

<head>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="//bootswatch.com/flatly/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-table.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/table.js"></script>
  <script src="js/bootstrap-table.js"></script>
</head>

<body>

<?php include('navbar.php'); ?>

<div class="container">
  <!-- Page Header -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Three Rules to a Healthy Dalmatian
          </h1>
      </div>
  </div>
</div>

<style>

html, body {
  overflow-x: hidden;
}

#dalmatian-header {
    position: relative;
    background: #fff url("img/dalmatian-header-three-rules.jpg") center center;
    width: 100vw;
    left: calc(-50vw + 50%);
    background-size: cover;
    color: white;
    text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
    padding-left: 10%;
    padding-right: 10%;
    padding-bottom: 2%;
}

@media only screen and (max-width: 640px){ #dalmatian-header { background: white; text-shadow: none; color: black; !important; } }

</style>

<div id="dalmatian-header">
  <div class="row">
    <div class="col-md-4">
      <h2><small>One</small></h2>
      <h2>A Healthy Diet Low in Purines</h2>
      <p>Its a misconception that low purines means low protein. Dalmatians need a relatively high protein diet but due to to their unique uric acid metabolism this must be human-grade protein low in purines. Suitable sources of low purine protein sources can be found in our <a href="purine-guide.php">Purine Guide.</a> Also check out our <a href="dry-food.php">Dry Food Guide.</a></p>

    </div>
    <div class="col-md-4">
      <h2><small>Two</small></h2>
      <h2>Frequent and Regular Exercise</h2>
      <p>Dalmatians are large dogs with excellent endurance and stamina. They require a minimum of an hour of exercise, once or preferably twice a day, this should include plenty of off lead running and play. Under exercised Dalmatians may suffer from stress, hyperactivity and in extreme cases aggression.</p>
   </div>
    <div class="col-md-4">
      <h2><small>Three</small></h2>
      <h2>Plenty of Fresh Water</h2>
      <p>Dalmatians should always have fresh clean water to drink and have access to outdoors so that they can regularly urinate.</p>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
