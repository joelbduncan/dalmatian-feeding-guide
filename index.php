<!DOCTYPE html>
<html lang="en">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dalmatian Feeding Guide</title>
  
<head>
  <meta charset="utf-8">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="//bootswatch.com/4/flatly/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-table.css">
</head>
    
<body>

<?php include( 'navbar.php'); ?>

<style>
  .jumbotron {
  background-image: url(img/zeus-dalmatian-cover-blur.jpg);
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
  }
</style>

<!-- Jumbotron Header -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <h1 class="display-4">Welcome!</h1>
      <h5>
  <p>This website was created to combine information on feeding Dalmatians food that will prevent the formation of stones into one modern easy to navigate and understand website.</p>
  <p>All information provided is from reputable sources, if you think we have gotten something wrong feel free to contact us!</p>
</h5>
      <p><a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#importantModal">Why this Matters</a></p>
  </div>
</div>

<!-- Why Modal -->
<div class="modal fade" tabindex="-1" id="importantModal" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Why is This Important?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Dalmatians&apos; livers have trouble breaking down uric acid, which can build up in the blood serum <a href="https://en.wikipedia.org/wiki/Hyperuricemia">(hyperuricemia)</a> causing gout. Uric acid can also be excreted in high concentration into the urine, causing kidney stones and bladder stones. These conditions are most likely to occur in middle-aged males. The chances of this happening can be greatly reduced with a <a href="purine-guide.php"><b>low purine diet<b>.</b></b></a></p>
              <img style="border-radius: 10px; box-shadow: rgba(0,0,0,0.8) 0 0 10px;" src="img/dalmatian-why-it-matters.jpg" class="img-fluid" alt="Healthy Dalmatian" />
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<div class="container">

  <style>
  .row > div[class*='col-'] {
    display: flex;
    flex:1 0 auto;
  }

  .col {
    bottom-margin: 10px;
  }

  .card {
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    img {
      width: 100%;
    }
  }
  </style>

  <!-- Homepage cards -->
  <div class="row">

    <div class="col-sm-6 col-lg-4  mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Three Rules</h3></div>
            <div class="card-body">
                <p>Maintaining a happy healthy Dalmatian isn&apos;t a harrowing task, following these three simple rules will give your Dalmatian the highest change of living a long healthy and happy life.</p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="three-rules.php">View page &#xBB;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4  mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Purine Guide</h3></div>
            <div class="card-body">
                <p>Simple searchable table with easy to understand colour-coding breaking down purine contents of many foods. If you would like detailed information on the purine levels in food please see our <a href="advanced-purine-guide.php">Advanced Purine Guide.</a></p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="purine-guide.php">View page &#xBB;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4  mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Dry Food Guide</h3></div>
            <div class="card-body">
                <p>We have combined thoughts from the Dalmatian community and searched the web for dry foods suitable for our spotty friends. Along with the best ways to feed it and ways to make it a little more existing!</p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="dry-food-guide.php">View page &#xBB;</a>
            </div>
        </div>
    </div>
  </div>

</div>

<?php include( 'footer.php'); ?>

</body>
</html>