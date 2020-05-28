<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
  <a class="navbar-brand" href="/">Dalmatian Feeding Guide</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active' ?>">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown  <?php if (basename($_SERVER['PHP_SELF']) == 'three-rules.php') echo 'active' ?><?php if (basename($_SERVER['PHP_SELF']) == 'purine-guide.php') echo 'active' ?><?php if (basename($_SERVER['PHP_SELF']) == 'advanced-purine-guide.php') echo 'active' ?><?php if (basename($_SERVER['PHP_SELF']) == 'dry-food-guide.php') echo 'active' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Guides
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'three-rules.php') echo 'active' ?>" href="three-rules">Three Rules</a>
          <a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'purine-guide.php') echo 'active' ?>" href="purine-guide">Purine Table</a>
          <a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'advanced-purine-guide.php') echo 'active' ?>" href="advanced-purine-guide">Advanced Purine Table</a>
          <a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'dry-food-guide.php') echo 'active' ?>" href="dry-food-guide">Dry Food</a>
        </div>
      </li>
      <li class="nav-item dropdown <?php if (basename($_SERVER['PHP_SELF']) == 'friends.php') echo 'active' ?><?php if (basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'active' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Contact
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'active' ?>" href="contact">Contact Us</a>
          <a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'friends.php') echo 'active' ?>" href="friends">Friends</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-header">Useful Links</a>
          <a class="dropdown-item" href="http://www.dalmatianwelfare.co.uk/">Dalmatian Welfare</a>
        </div>
      </li>
      <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'faq.php') echo 'active' ?>">
        <a class="nav-link" href="faq"><i class="fas fa-book"></i> FAQ</a>
      </li>
    </ul>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Theme
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item theme-link" href="#" data-theme="flatly" class="theme-link">Light</a>
        <a class="dropdown-item theme-link" href="#" data-theme="darkly" class="theme-link">Dark</a>
      </div>
    </div>
  </div>
</nav>
</div>

<script>
var themes = {
    "flatly" : "//bootswatch.com/4/flatly/bootstrap.min.css",
    "darkly" : "//bootswatch.com/4/darkly/bootstrap.min.css"
}
$(function(){
    function getCookie(c_name) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(c_name + "=");
            if (c_start != -1) {
                c_start = c_start + c_name.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) c_end = document.cookie.length;
                return unescape(document.cookie.substring(c_start, c_end));
            }
        }
        return "default";
    }

    function setCookie(c_name, value) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + 7);
        document.cookie = c_name + "=" + escape(value) + ";path=/;expires=" + exdate.toUTCString();
    }

    var setTheme = getCookie('setTheme');

    var themesheet = $('<link href="'+themes[getCookie('setTheme')]+'" rel="stylesheet" />');

    themesheet.appendTo('head');

    $('.theme-link').click(function(){
        var themeurl = themes[$(this).attr('data-theme')];
        setCookie('setTheme', $(this).attr('data-theme'));
        themesheet.attr('href',themeurl);
    });
});
</script>