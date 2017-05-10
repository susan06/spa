<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Settings::get('app_name') }}</title>

    {!! HTML::style("assets/css/emails.css") !!}

</head>
<body bgcolor="#FFFFFF">

    <!-- HEADER -->
    <table class="head-wrap" bgcolor="#fff">
        <tr>
            <td class="header container">  
                <div class="content">
                <table bgcolor="#fff">
                    <tr>
                        <td align="left"><a href="miviajeseguro.com" target="_blank">{{ HTML::image('assets/images/logos/logo.png', Settings::get('app_name'), array('class' => 'navbar-img')) }}</a></td>
                    </tr>
                </table>
                </div>      
            </td>
        </tr>
    </table>
    <!-- /HEADER -->

    @yield('content')
    
    <!-- FOOTER -->
    <table class="footer-wrap">
        <tr>
            <td class="container" align="middle">
                <p>
                    Visita <a href="miviajeseguro.com">miviajeseguros.com</a>
                </p>
            </td>
        </tr>  
    </table>
    <!-- /FOOTER -->

</body>
</html>
