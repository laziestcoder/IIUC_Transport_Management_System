<!-- Bootstrap core JavaScript -->
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js'), false); ?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js'), false); ?>"></script>

<!-- Contact form JavaScript -->


<!-- Custom scripts for this template -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
<script>
    // $(document).ready(function () {
    //     console.log("1");
    //     $('[data-toggle=confirmation]').confirmation({
    //         rootSelector: '[data-toggle=confirmation]',
    //         onConfirm: function (event, element) {
    //             element.closest('form').submit();
    //         }
    //     });
    //
    // });
    // $("#delete").on("submit", function () {
    //     console.log("2");
    //     return confirm("Do you want to delete this item?");
    // });
    $(document).ready(function () {
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });
    });
</script>
<script src="<?php echo e(asset('js/agency.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('js/jqBootstrapValidation.js'), false); ?>"></script>
<script src="<?php echo e(asset('js/report.js'), false); ?>"></script>