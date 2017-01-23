<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-table.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/table.js"></script>
  <script src="js/bootstrap-table.js"></script>
</head>

<body>

  <!-- Fixed navbar -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Dalmatian Purine Guide</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Home</a></li>
          <li><a href="#about">Guide</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Add to Database</a></li>
              <li><a href="contact.php">Contact Us</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Useful Links</li>
              <li><a href="http://www.dalmatianwelfare.co.uk/">Dalmatian Welfare</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

<div class="container">
  <div class="form-group pull-right">
      <input type="text" class="search form-control" placeholder="What you looking for?">
  </div>
  <span class="counter pull-right"></span>
  <table width="100%" class="table results" data-toggle="table"
         data-sort-name="id"
         data-sort-order="asc">
    <thead>
      <tr>
        <th data-field="food">Food</th>
        <th data-field="total_purines">Total Purines in mg uric acid/100 g</th>
        <th data-field="min">Min</th>
        <th data-field="max">Max</th>
        <th data-field="nutr_density">Nutr. Density in mg/MJ</th>
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

<footer class="footer">
  <div class="container">
    <p class="text-muted">Created by Joel Duncan <a href="https://slethen.io">slethen.io</p>
  </div>
</footer>

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
