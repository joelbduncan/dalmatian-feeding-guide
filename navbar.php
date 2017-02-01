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
        <li <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"' ?>><a href="index.php">Home</a></li>
        <li <?php if (basename($_SERVER['PHP_SELF']) == 'three-rules.php') echo 'class="active"' ?>
        <li <?php if (basename($_SERVER['PHP_SELF']) == 'purine-guide.php') echo 'class="active"' ?>
        <li <?php if (basename($_SERVER['PHP_SELF']) == 'advanced-purine-guide.php') echo 'class="active"' ?>
            <?php if (basename($_SERVER['PHP_SELF']) == 'dry-food-guide.php') echo 'class="active"' ?> class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Guides<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'three-rules.php') echo 'class="active"' ?>><a href="three-rules.php">Three Rules</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'purine-guide.php') echo 'class="active"' ?>><a href="purine-guide.php">Purine Table</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'advanced-purine-guide.php') echo 'class="active"' ?>><a href="advanced-purine-guide.php">Advanced Purine Table</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'dry-food-guide.php') echo 'class="active"' ?>><a href="dry-food-guide.php">Dry Food</a></li>
          </ul>
        </li>
        <li <?php if (basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'class="active"' ?> class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'class="active"' ?>><a href="contact.php">Contact Us</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Useful Links</li>
            <li><a href="http://www.dalmatianwelfare.co.uk/">Dalmatian Welfare</a></li>
          </ul>
        </li>
        <li><a href="faq.php"><span class="glyphicon glyphicon-book"></span> FAQ</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <div class="btn-group">
            <button data-toggle="dropdown" class="btn navbar-btn btn-success dropdown-toggle">Theme <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="#" data-theme="flatly" class="theme-link">Light</a></li>
              <li><a href="#" data-theme="darkly" class="theme-link">Dark</a></li>
            </ul>
          </div>
        </div>
      </div><!--/.nav-collapse -->
    </div>
</nav>
