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

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Best Dry Food
                      <!--<small>Link to feeding practices</small>-->
                </h1>
            </div>
        </div>

        <div class="alert alert-info">
          <strong>Tip!</strong> Dalmatians need plenty of Fresh Water especailly if you're feeding dry food. Considering adding it to there biscuits!
        </div>

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
              echo '<div class="container">
                      <div class="row">
                          <div class="col-md-4 portfolio-item">
                              <a href="' . $row["link"] .'">
                                  <img class="img-responsive" src="' . $row["image"] .'" alt="">
                              </a>
                              <h3>
                                  <a href="' . $row["link"] .'">' . $row["title"] .'</a>
                              </h3>
                              <p>' . $row["paragraph"] .'</p>
                              <p><button type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#' . $row["id"] .'">Ingredients</button></p>
                          </div>

                        <div class="modal fade" id="' . $row["id"] .'" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">' . $row["title"] .': Ingredients</h4>
                              </div>
                              <div class="modal-body">
                                ' . $row["ingredients"] .'
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
  </div>

<?php include('footer.php'); ?>

    </body>

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
