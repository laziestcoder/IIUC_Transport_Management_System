

    
    
        
    
    
    


<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <p>&copy <?php echo e(date("Y"), false); ?>

            
            ITMS & <a href="https://github.com/laziestcoder"> Developers </a> | All Rights Reserved</p>
        
    </div>
    <!-- Default to the left -->
    <b>Today: </b><?php echo e(date(" l, d M, Y"), false); ?>

    
    <div id="time"></div>
    <script type="text/JavaScript">
        /* document.write(new Date().gettime()); */
        $(document).ready(function () {
            var interval = setInterval(function () {
                var momentNow = moment();
                /* $('#date').html(momentNow.format('YYYY MMMM DD') + ' '
                                    + momentNow.format('dddd')
                                    .substring(0,3).toUpperCase()); */
                $('#time').html("<b>Time: </b> " + momentNow.format('hh:mm:ss A'));
            }, 100);
        });
    </script>
    
</footer>