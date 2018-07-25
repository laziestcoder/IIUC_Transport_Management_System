<!-- Footer -->
        <div  class="container">
            <div id="footer" class="row">
                <div class="col-md-4">
                    <span class="copyright">
                        <!-- Copyright &copy; Your Website 2017 -->
                    <b>Today:</b>{{date("l, d M, Y")}} <b>Time:</b>{{date("h:i A")}}
                    {{-- <div id="time">Time:</div> --}}
                    <p>&copy {{ date("Y") }}
                    {{-- <script type="text/JavaScript"> document.write(new Date().getFullYear()); </script> --}}
                    ITMS & <a href="https://github.com/laziestcoder"> Towfiqul Islam </a> | All Rights Reserved</p>
                    </span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item">
                            <a href="#">
                  <i class="fa fa-twitter"></i>
                </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                  <i class="fa fa-linkedin"></i>
                </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li class="list-inline-item">
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
{{-- <script type="text/JavaScript">
    /* document.write(new Date().gettime()); */
    $(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        /* $('#date').html(momentNow.format('YYYY MMMM DD') + ' '
                            + momentNow.format('dddd')
                            .substring(0,3).toUpperCase()); */
        $('#time').html("<b>Time: </b> "+momentNow.format('hh:mm:ss A'));
    }, 100);
});
</script> --}}
    