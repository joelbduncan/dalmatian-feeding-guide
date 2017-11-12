<div class="container">
  <hr>
  <footer class="footer">
    <div class="container">
      <p class="text-muted">Created by Joel Duncan | <a href="https://slethen.io">slethen.io</p>
    </div>
  </footer>
</div>

<script>
var themes = {
    "flatly" : "//bootswatch.com/3/flatly/bootstrap.min.css",
    "darkly" : "//bootswatch.com/darkly/bootstrap.min.css"
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
