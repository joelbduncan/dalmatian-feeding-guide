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
    padding: 50px 0 0;
  }
</style>

  <?php include('navbar.php'); ?>

  <main role="main" class="flex-shrink-0">
  <div class="container">

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Best Dry Food</h1>
            </div>
        </div>

        <div class="alert alert-info">
          <strong>Tip!</strong> Dalmatians need plenty of Fresh Water especailly if you're feeding dry food. Considering adding it to there biscuits!
        </div>

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

        <div class="row">

        <?php
        include 'config.php';

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, title, paragraph, ingredients, link, image FROM food";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4 col-xs-6 col-md-6 mt-4">
                      <div class="card">
                        <img class="card-img-top img-fluid" src="' . $row["image"] .'" alt="Card image cap">
                          <div class="card-body">
                            <h4 class="card-title">' . $row["title"] .'</h4>
                            <p class="card-text">' . $row["paragraph"] .'</p>
                          </div>
                          <div class="card-footer text-muted">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#id-' . $row["id"] .'">Ingredients</button>
                          </div>
                        </div>
                      </div>
                      
                    <!-- Modal -->
                    <div class="modal fade" tabindex="-1" id="id-' . $row["id"] .'" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">' . $row["title"] .': Ingredients</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <p>' . $row["ingredients"] .'</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo "0 results";
        }
        ?>

  </div>

<?php include('footer.php'); ?>

</body>
</main>

  <script>
  $(document).ready(function() {
    $(".search").keyup(function () {
      var searchTerm = $(".search").val();
      var listItem = $('.results tbody').children('tr');
      var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

    $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
          return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
      }
    });

    $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
      $(this).attr('visible','false');
    });

    $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
      $(this).attr('visible','true');
    });

    var jobCount = $('.results tbody tr[visible="true"]').length;
      $('.counter').text(jobCount + ' item');

    if(jobCount == '0') {$('.no-result').show();}
      else {$('.no-result').hide();}
  		  });
  });
  </script>
</html>
