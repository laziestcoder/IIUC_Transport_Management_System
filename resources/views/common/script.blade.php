<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugin JavaScript -->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Contact form JavaScript -->
<script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
<script src="{{ asset('js/contact_me.js') }}"></script>

<!-- Custom scripts for this template -->
<script src="{{ asset('js/agency.min.js') }}"></script>
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