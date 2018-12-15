<!-- Footer -->
{{--<section>--}}
<div class="container">
    <div id="footer" class="row" style="background: ghostwhite;">
        <div class="col-md-4">
                    <span class="copyright">
                        <!-- Copyright &copy; Your Website 2017 -->
                    <b>Today: </b>{{ date("l, d M, Y")." ||| "}} <b>Time: </b>{{ date("h:i A")}}
                        {{-- <div id="time">Time:</div> --}}
                        <p>&copy {{ date("Y") }}
                            {{-- <script type="text/JavaScript"> document.write(new Date().getFullYear()); </script> --}}
                            ITMS Developers | All Rights Reserved</p>
                    </span>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <li class="list-inline">
                Join our
                <a style="color: #636b6f; font-weight:bold;text-decoration: none;" target="_blank"
                   href="https://www.facebook.com/IIUCTMD/">facebook Group</a>

                &
                <a style="color: #636b6f; font-weight:bold;text-decoration: none;" target="_blank"
                   href="https://www.facebook.com/groups/iiuc.transport/">facebook Page</a>
            </li>
        </div>
        {{--<div class="col-md-4">--}}
        {{--<ul class="list-inline quicklinks">--}}
        {{--<li class="list-inline-item">--}}
        {{--<a target="_blank" href="#">Privacy Policy</a>--}}
        {{--</li>--}}
        {{--<li class="list-inline-item">--}}
        {{--<a target="_blank" href="#">Terms of Use</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</div>--}}
    </div>
</div>
{{--</section>--}}
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
    