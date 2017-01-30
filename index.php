<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dalmatian Feeding Guide</title>

<head>
  <meta charset=utf-8>
  <link rel="stylesheet" type="text/css" href="//bootswatch.com/flatly/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-table.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/table.js"></script>
  <script src="js/bootstrap-table.js"></script>
</head>

<body>

<?php include('navbar.php'); ?>

<style>
/* Move down content because we have a fixed navbar that is 50px tall */
body {
  padding-top: 50px;
  padding-bottom: 20px;
}

/* Jumbotron cover photo */
.jumbotron {
    position: relative;
    background: #000 url("img/zeus-dalmatian-cover-blur.jpg") center center;
    width: 100%;
    background-size: cover;
    overflow: hidden;
    color: white;
    text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
}

</style>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1>Welcome!</h1>
      <p>This website was created to combine information on feeding Dalmatians food that will prevent the formation of stones into one modern easy to navigate and understand website.</p>
      <p>All information provided is from reputable sources, if you think we have gotten something wrong feel to contact us!</p>
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#importantModal">Why this Matters</button>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="importantModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Why is This Important?</h4>
        </div>
        <div class="modal-body">
          <p>Dalmatians' livers have trouble breaking down uric acid, which can build up in the blood serum <a href="https://en.wikipedia.org/wiki/Hyperuricemia">(hyperuricemia)</a> causing gout.
          Uric acid can also be excreted in high concentration into the urine, causing kidney stones and bladder stones.
          These conditions are most likely to occur in middle-aged males. The chances of this happening can be greatly reduced with a <a href="purine-guide.php"><b>low purine diet<b>.</p></a>
          <img style="border-radius: 10px; box-shadow: rgba(0,0,0,0.8) 0 0 10px;" class="img-responsive" src="img/dalmatian-why-it-matters.jpg" alt="Healthy Dalmatian">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2>Purine Guide</h2>
        <p>Simple searchable table with easy to understand colour-coding breaking down purine contents of many foods. If you would like detailed information on the purine levels in food please see our <a href="advanced-purine-guide.php">Advanced Purine Guide.</p>
        <p><a class="btn btn-default" href="purine-guide.php" role="button">View page &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Dry Food Guide</h2>
        <p>We have combined thoughts from the Dalmatian community and searched the web for dry foods suitable for our spotty friends. Along with the best ways to feed it and ways to make it a little more existing!</p>
        <p><a class="btn btn-default" href="dry-food-guide.php" role="button">View page &raquo;</a></p>
     </div>
      <div class="col-md-4">
        <h2>FAQ</h2>
        <p>For more information on who runs the site, our sources, how to use the site and some general facts on why Dalmatians require a low purine diet please see our FAQ.</p>
        <p><a class="btn btn-default" href="faq.php" role="button">View page &raquo;</a></p>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>

</body>
</html>
