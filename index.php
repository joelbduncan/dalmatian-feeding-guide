<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <li class="active"><a href="/">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Guides<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="purine-guide.php">Purine Table</a></li>
              <li><a href="advanced-purine-guide.php">Advanced Purine Table</a></li>
              <li><a href="dry-food-guide.php">Dry Food</a></li>
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

<style>
/* Move down content because we have a fixed navbar that is 50px tall */
body {
  padding-top: 50px;
  padding-bottom: 20px;
}

/* Jumbotron cover photo */
.jumbotron {
    position: relative;
    background: #000 url("img/zeus-dalmatian-cover.jpg") center center;
    width: 100%;
    background-size: cover;
    overflow: hidden;
    color: white;
    text-shadow: black 0.3em 0.3em 0.3em;
}

</style>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1>Welcome!</h1>
      <p>This website was created to combine information on feeding Dalmatians food that will prevent the formation of stones into one modern easy to navigate and understand website.</p>
      <p>All information provided is from reputable sources, if you think we have gotten something wrong feel to contact us!</p>
      <p><a class="btn btn-primary btn-lg" href="contact.php" role="button">Contact Us &raquo;</a></p>
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

    <hr>

<footer class="footer">
  <div class="container">
    <p class="text-muted">Created by Joel Duncan <a href="https://slethen.io">slethen.io</p>
  </div>
</footer>

</body>
