<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="HandheldFriendly" content="true" />
    <!--
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
     CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Settings::get('app_name') }} | @yield('page-title')</title>

    <!-- Styles -->
    {!! HTML::style("vendors/bootstrap/dist/css/bootstrap.min.css") !!}
    <!-- font-awesome.css -->
    {!! HTML::style("vendors/font-awesome/css/font-awesome.min.css") !!}
    <!-- bootstrap datetimepicker -->
    {!! HTML::style("vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css") !!}

     <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

    <!-- all vendors -->
    {!! HTML::style("assets/css/all_styles.css") !!}
    <!-- Custom Theme Style -->
    {!! HTML::style("assets/css/style_front.css") !!}

    @yield('styles') 

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
    @yield('scripts_head') 

</head>

<body>
    
    <div class="wrapper">

    <div class="loader loader-default" id="loading"></div>

        <div class="main-panel">

            @include('partials.user-menu-front')

                <div id="nav-bar-header" class="visible-mobile">

                    @if(Auth::check() && Auth::user()->hasRole('client')) 
                    <div id="menu-auth" style="display: block;">
                        <ul class="nav navbar-nav menu-header">
                            <li>
                                <a href="#" class="-menu-click">
                                    <i class="pe-7s-search"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('local.favorites') }}" class="menu-click">
                                    <i class="pe-7s-safe"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('local.visites') }}" class="menu-click">
                                    <i class="pe-7s-check"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="-menu-click">
                                    <i class="pe-7s-user"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif

                    <div id="menu-mobile">
                       @include('partials.menu-movil')
                    </div>
                </div>

            <div class="content">
                @yield('content')   
            </div>

        </div>

    </div>


    @include('partials.modals')
    
    <!--JQuery--> 
    {!! HTML::script('vendors/jquery/dist/jquery.min.js') !!}

    <!--Bootstrap--> 
    {!! HTML::script('vendors/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- moment -->
    {!! HTML::script('assets/js/moment/moment.min.js') !!}

    <!-- bootstrap-daterangepicker -->
    {!! HTML::script('vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

    <!--sweet alert--> 
    {!! HTML::script('assets/js/sweetalert/sweetalert.min.js') !!}

    @include('sweet::alert')

    <!-- Datatables -->
    {!! HTML::script('assets/js/datatables.js') !!}

    <!-- PNotify -->
    {!! HTML::script('assets/js/bootstrap-notify.js') !!}

    <script>
        var imgload = "{{ url('/public-img/images/loading-1.gif') }}";
        var lang = {
            "cancel" : "@lang('app.cancel')",
            "no_data_table" : "@lang('app.no_records_found')",
            "invalidUpdateMsg" : "@lang('app.invalid_update_status')",
        };
 
        $("#nav-bar-button").click(function(){
            $("#menu-mobile").toggle();
            $("#menu-auth").toggle();
            /*$('html,body').animate({
                scrollTop: $("#menu-mobile").offset().top
            }, 2000);*/
        });

        $("#nav-bar-button-foo").click(function(){
            $("#menu-mobile-foo").toggle();
            /*$('html,body').animate({
                scrollTop: $("#menu-mobile-foo").offset().top
            }, 2000);*/
        });

    </script>

    <!-- Custom Theme Scripts -->
    {!! HTML::script('assets/js/custom.js') !!}
    
    @include('partials.messages')

    @yield('scripts')
    
</body>
</html>
