@if (Session::has('sweet_alert.alert'))
    <script>
        swal({!! Session::pull('sweet_alert.alert') !!});
    </script>
    <?Php Session::forget('sweet_alert.alert'); ?>
@endif
