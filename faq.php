<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dalmatian Feeding Guide</title>

<head>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="//bootswatch.com/flatly/bootstrap.min.css" />
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
          <h1 class="page-header">FAQ
                <!--<small>Link to feeding practices</small>-->
          </h1>
      </div>
  </div>
</div>

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
      echo '<div class="container ">
          <div class="panel-group" id="faqAccordion">
              <div class="panel panel-default ">
                  <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#' . $row["id"] .'">
                       <h4 class="panel-title">
                          <a href="#" class="ing">Q: ' . $row["question"] .'</a>
                    </h4>

                  </div>
                  <div id="' . $row["id"] .'" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-body">
                           <h5><span class="label label-primary">Answer</span></h5>

                          <p>' . $row["answer"] .'</p>
                      </div>
                  </div>
              </div>
          </div>
          <!--/panel-group-->
      </div>';

    }
} else {
    echo "0 results";
}
?>

<?php include('footer.php'); ?>

</body>
</html>
