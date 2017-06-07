
@if(isset ($errors) && count($errors) > 0)
    <?php 
    $data = Session::get('errors'); 
    $message = '';
    ?>  
    @foreach($errors->all() as $error)
        <?php $message .= $error.' '; ?> 
    @endforeach
    <script> notify('error', '{{ $message }}'); </script>
@endif

@if(Session::get('success', false))
    <?php 
    $data = Session::get('success'); 
    $message = '';
    ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <?php $message .= $msg.' '; ?> 
        @endforeach
        <script> notify('success', '{{ $message }}'); </script>
    @else
        <script> notify('success', '{{ $data }}'); </script>
    @endif
@endif

<!-- /Custom Notification -->
