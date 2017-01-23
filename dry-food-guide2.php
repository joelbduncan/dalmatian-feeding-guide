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
          <a class="navbar-brand" href="/">Dalmatian Feeding Guide</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li class="active" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Guides<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="purine-guide.php">Purine Table</a></li>
                <li><a href="advanced-purine-guide.php">Advanced Purine Table</a></li>
                <li class="active"><a href="dry-food-guide.php">Dry Food</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="contact.php">Contact Us</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Useful Links</li>
                <li><a href="http://www.dalmatianwelfare.co.uk/">Dalmatian Welfare</a></li>
              </ul>
            </li>
            <li><a href="faq.php"><span class="glyphicon glyphicon-book"></span> FAQ</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

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
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                <a href="https://www.royalcanin.co.uk/products/dog/breed-health-nutrition/dalmatian-adult/">
                    <img class="img-responsive" src="img/dalmatian-royal-canin-adult-700x400.jpg" alt="">
                </a>
                <h3>
                    <a href="https://www.royalcanin.co.uk/products/dog/breed-health-nutrition/dalmatian-adult/">Royal Canin Dalmatian</a>
                </h3>
                <p>Complete feed for dogs - Specially for adult and mature Dalmatians - Over 15 months old.</p>
                <div class="col-xs-12 col-md-6">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#royal-canin-dalmatian-info">Ingredients</button>
                </div>
            </div>
            <div class="col-md-4 portfolio-item">
                <a href="https://www.royalcanin.co.uk/products/dog/breed-health-nutrition/dalmatian-junior/">
                    <img class="img-responsive" src="img/dalmatian-royal-canin-junior-700x400.jpg" alt="">
                </a>
                <h3>
                    <a href="https://www.royalcanin.co.uk/products/dog/breed-health-nutrition/dalmatian-junior/">Royal Canin Dalmatian Junior</a>
                </h3>
                <p>Complete feed for dogs - Specially for Dalmatian puppies - Up to 15 months old.</p>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#royal-canin-dalmatian-junior-info">Ingredients</button>
            </div>
            <!--
            <div class="col-md-4 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
        </div>
        //-->
        <!-- /.row -->

      <div class="modal fade" id="royal-canin-dalmatian-info" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Ingredients</h4>
            </div>
            <div class="modal-body">
              <p>COMPOSITION: Rice, maize fl our, vegetable protein isolate*, animal fats, egg powder, wheat fl our, maize gluten, minerals, vegetable fi bres, hydrolysed animal proteins, fi sh oil, soya oil, green tea and grape extracts (source of polyphenols), marigold extract (source of lutein), hydrolysed crustaceans (source of glucosamine), hydrolysed cartilage (source of chondroitin).</p>
              <p>ADDITIVES (per kg): Nutritional additives: Vitamin A: 28300 IU, Vitamin D3: 800 IU, E1 (Iron): 82 mg, E2 (Iodine): 5 mg, E4 (Copper): 4 mg, E5 (Manganese): 55 mg, E6 (Zinc): 194 mg, E8 (Selenium): 0.25 mg, Taurine: 2 g - Preservatives - Antioxidants</p>
              <p>ANALYTICAL CONSTITUENTS: Protein : 22 % - Fat content : 18 % - Crude ash : 6.4 % - Crude fibres : 2.8 % - EPA and DHA fatty acids : 3g/kg, Taurine: 2g.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

          <div class="modal fade" id="royal-canin-dalmatian-junior-info" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Ingredients</h4>
                </div>
                <div class="modal-body">
                  <p>COMPOSITION: rice, dehydrated poultry protein, vegetable protein isolate*, maize, animal fats, dehydrated pork protein*, hydrolysed animal proteins, minerals, beet pulp, vegetable fibres, soya oil, fish oil, psyllium husks and seeds, fructo-oligo-saccharides, hydrolysed yeast (source of manno-oligo-saccharides), hydrolysed crustaceans (source of glucosamine), marigold extract (source of lutein), hydrolysed cartilage (source of chondroitin).</p>
                  <p>ADDITIVES (per kg): Nutritional additives: Vitamin A: 26500 IU, Vitamin D3: 700 IU, E1 (Iron): 53 mg, E2 (Iodine): 5.3 mg, E4 (Copper):10 mg, E5 (Manganese): 69 mg, E6 (Zinc): 206 mg, E8 (Selenium): 0.12 mg, L-carnitine: 300 mg - Preservatives - Antioxidants.</p>
                  <p>ANALYTICAL CONSTITUENTS: Protein: 31% - Fat content: 16% - Crude ash: 7.8% - Crude fibres: 2% - Per kg: Calcium: 12 g - Phosphorus: 9 g.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
      </div>
      <hr>
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
