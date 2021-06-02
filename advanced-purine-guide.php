<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dalmatian Feeding Guide</title>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script async defer data-domain="dalmatian-feeding-guide.org" src="https://plausible.joelduncan.io/js/plausible.js"></script>
  <link rel="stylesheet" type="text/css" href="//bootswatch.com/4/flatly/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="css/purine-table.css">
  <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
  <script src="js/table.js"></script>
</head>

<body>

<?php include( 'navbar.php'); ?>

<style>
  main > .container {
    padding: 50px 15px 0;
  }
</style>

<!-- Page Header -->
<main role="main" class="flex-shrink-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Advanced Purine Guide</h1> 
      </div>
		</div>
	</div>
</main>

<div class="container">
	<div class="form-group float-right">
		<input type="text" class="search form-control" placeholder="What you looking for?"> </div>
	<div class="form-group float-left">
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#table-info">Key</button>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="table-info" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">What does this mean?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<div class="modal-body">
					<p>This table breaks down purine levels into 3 groups. These groups are represented by a different colour.</p>
					<div class="alert alert-success" role="alert"> <strong>Green: </strong>Low Purine, can be fed as often as you like </div>
					<div class="alert alert-warning" role="alert"> <strong>Yellow: </strong>Moderate level of purines and are acceptable in your dogs diet </div>
					<div class="alert alert-danger" role="alert"> <strong>Red: </strong>Should be avoided as much as possible </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div> <span class="counter float-right"></span>
	<table width="100%" class="table results" data-toggle="table" data-sort-name="id" data-sort-order="asc">
		<thead>
			<tr>
				<th data-field="food">Food</th>
				<th data-field="total_purines">Total Purines in mg uric acid/100 g</th>
				<th data-field="min">Min</th>
				<th data-field="max">Max</th>
				<th data-field="nutr_density">Nutr. Density in mg/MJ</th>
				<th data-field="id" class="d-none">id</th>
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

      $sql = "SELECT id, food, total_purines, min, max, nutr_density, bootstrap_class FROM advanced_dalmatian_purine";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo '<tr class="' . $row["bootstrap_class"] .'">
                        <td>' . $row["food"] .'</td>
                        <td>' . $row["total_purines"] .'</td>
                        <td>' . $row["min"] .'</td>
                        <td>' . $row["max"] .'</td>
                        <td> '.$row["nutr_density"] .'</td>
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
    $(".search").keyup(function() {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

        $.extend($.expr[':'], {
            'containsi': function(elem, i, match, array) {
                return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });

        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
            $(this).attr('visible', 'false');
        });

        $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
            $(this).attr('visible', 'true');
        });

        var jobCount = $('.results tbody tr[visible="true"]').length;
        $('.counter').text(jobCount + ' item');

        if (jobCount == '0') {
            $('.no-result').show();
        } else {
            $('.no-result').hide();
        }
    });
});
</script>
</html>
