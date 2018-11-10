<script>
    $(function () {
        $('#form').submit(function (event) {
            var verified = grecaptcha.getResponse();
            if (verified.length === 0) {
                event.preventDefault();
            }
        });

    });
</script>
