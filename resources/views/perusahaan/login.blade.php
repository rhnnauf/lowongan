<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>Login | Perusahaan</title>

    <link rel="apple-touch-icon" href="{{ URL('assets/logo.png') }}">
    <link rel="shortcut icon" href="{{ URL('assets/logo.png') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/base/assets/css/site.min.css') }}">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/slidepanel/slidePanel.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/flag-icon-css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/waves/waves.css') }}">
    <link rel="stylesheet" href="{{ Url('css-js-backend/base/assets/examples/css/pages/login-v2.css') }}">


    <!-- Fonts -->
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ URL('css-js-backend/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="animsition page-login-v2 layout-full page-dark">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content">
            <div class="page-brand-info">
                <div class="brand">
                    <img class="brand-img" src="{{ URL('assets/logo.png') }}" alt="..." style="width: 15%;">
                    <h2 class="brand-text font-size-40">Ujob</h2>
                </div>
                <p class="font-size-20">Panel Perusahaan dari website Lowongan.</p>
            </div>

            <div class="page-login-main">
                <div class="brand hidden-md-up">
                    <img class="brand-img" src="{{ URL('assets/logo.png') }}" alt="..." style="width: 15%;">
                    <h3 class="brand-text font-size-40">Perusahaan</h3>
                </div>
                <h3 class="font-size-24">Log In</h3>
                <p>Silahkan isi username dan password.</p>

                @if ($message = Session::get('alert-login-perusahaan'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <form method="post" action="{{ URL('perusahaan/login') }}" autocomplete="off">
                    @csrf
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control <?= ($errors->first('email') != "") ? 'is-invalid' : ''; ?>" id="inputEmail" name="email">
                        <label class="floating-label" for="inputEmail">Email</label>
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="password" class="form-control <?= ($errors->first('password') != "") ? 'is-invalid' : ''; ?>" id="inputPassword" name="password">
                        <label class="floating-label" for="inputPassword">Password</label>
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Log in</button>
                </form>

                <footer class="page-copyright">
                    <p>WEBSITE BY Lowongan</p>
                    <p>© 2020. All RIGHT RESERVED.</p>
                </footer>
            </div>

        </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
    <script src="{{ URL('css-js-backend/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/popper-js/umd/popper.min.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/animsition/animsition.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/waves/waves.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ URL('css-js-backend/global/vendor/switchery/switchery.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/intro-js/intro.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/screenfull/screenfull.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ URL('css-js-backend/global/js/Component.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Base.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Config.js') }}"></script>

    <script src="{{ URL('css-js-backend/base/assets/js/Section/Menubar.js') }}"></script>
    <script src="{{ URL('css-js-backend/base/assets/js/Section/GridMenu.js') }}"></script>
    <script src="{{ URL('css-js-backend/base/assets/js/Section/Sidebar.js') }}"></script>
    <script src="{{ URL('css-js-backend/base/assets/js/Section/PageAside.js') }}"></script>
    <script src="{{ URL('css-js-backend/base/assets/js/Plugin/menu.js') }}"></script>

    <script src="{{ URL('css-js-backend/global/js/config/colors.js') }}"></script>
    <script src="{{ URL('css-js-backend/base/assets/js/config/tour.js') }}"></script>
    <script>
        Config.set('assets', "{{ URL('css-js-backend/base/assets') }}");
    </script>

    <!-- Page -->
    <script src="{{ URL('css-js-backend/base/assets/js/Site.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/asscrollable.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/slidepanel.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/switchery.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/jquery-placeholder.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/material.js') }}"></script>

    <script>
        (function(document, window, $) {
            'use strict';

            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);
    </script>

</body>

</html>