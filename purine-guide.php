<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dalmatian Feeding Guide</title>

<head>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="//bootswatch.com/3/flatly/bootstrap.min.css" />
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
          <h1 class="page-header">Purine Guide
                <small>Something missing? Let us know!</small>
          </h1>
      </div>
  </div>
</div>

<div class="container">
  <div class="form-group pull-right">
      <input type="text" class="search form-control" placeholder="What you looking for?">
  </div>

  <div class="form-group pull-left">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#table-info">Key</button>
  </div>

    <!-- Modal -->
  <div class="modal fade" id="table-info" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">What does this mean?</h4>
        </div>
        <div class="modal-body">
          <p>This table breaks down purine levels into 3 groups.
          These groups are represented by a different colour.</p>

          <div class="alert alert-success" role="alert">
            <strong>Green: </strong>Low Purine, can be fed as often as you like
          </div>
          <div class="alert alert-warning" role="alert">
            <strong>Yellow: </strong>Moderate level of purines and are acceptable in your dogs diet
          </div>
          <div class="alert alert-danger" role="alert">
            <strong>Red: </strong>Should be avoided as much as possible
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <span class="counter pull-right"></span>
  <table width="100%" class="table results" data-toggle="table"
         data-sort-name="id"
         data-sort-order="asc">
    <thead>
      <tr>
        <th data-field="Purine Level">Purine Level</th>
        <th data-field="Food">Food</th>
        <th data-field="id" class="hidden">id</th>
      </tr>
      <tr class="warning no-result">
        <td colspan="4"><i class="fa fa-warning"></i> No result</td>
      </tr>
    </thead>
    <tbody>

      <?php

      include 'config.php';

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT id, food, purine_level, bootstrap_class FROM dalmatian_purine";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo '<tr class="' . $row["bootstrap_class"] .'">
                        <td>' . $row["purine_level"] .'</td>
                        <td> '.$row["food"] .'</td>
                        <td> '.$row["id"] .'</td>
                      </tr>';
          }
      } else {
          echo "0 results";
      }
      ?>
             </tbody>
    </tbody>
  </table>
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
