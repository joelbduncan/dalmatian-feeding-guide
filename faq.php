<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dalmatian Feeding Guide</title>

<head>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="//bootswatch.com/4/flatly/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-table.css">
</head>

<body>

<style>
  main > .container {
    padding: 50px 15px 0;
  }
</style>

<?php include('navbar.php'); ?>

<!-- Page Header -->
<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">FAQ
                <small>Frequently asked questions</small>
          </h1>
            </div>
        </div>
    </div>
</main>

<div class="container ">
    <div class="panel-group" id="faqAccordion">

<?php
include 'config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, question, answer FROM faq";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<div class="container">
      <div class="card">
        <div class="card-header">
          Q: ' . $row["question"] .'
        </div>
        <div class="card-body">
        <span class="badge badge-primary">Answer</span>
            <p class="card-text">' . $row["answer"] .'</p>
        </div>
      </div>
    </div>
    <br>';

    }
} else {
    echo "0 results";
}
?>

<?php include('footer.php'); ?>

</body>
</main>
</html>
