<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">

        <p>
            <strong> {{ date("Y") }} &copy  |
                ITMS & </strong>
            <a href="https://github.com/laziestcoder"> Developers </a>
            <strong> | All Rights Reserved </strong>
        </p>

    </div>
    <!-- Default to the left -->
    <strong>Today: </strong>{{date(" l, d M, Y")}}

    <div id="time"></div>
    <script type="text/JavaScript">
        $(document).ready(function () {
            var interval = setInterval(function () {
                var momentNow = moment();
                $('#time').html("<b>Time: </b> " + momentNow.format('hh:mm:ss A'));
            }, 100);
        });
    </script>
</footer>