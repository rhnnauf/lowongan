<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>Ujob | Admin</title>

    <link rel="apple-touch-icon" href="{{ URL('assets/logo.png') }}">
    <link rel="shortcut icon" href="{{ URL('assets/logo.png') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/base/assets/css/site.min.css') }}">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/slidepanel/slidePanel.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/flag-icon-css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/waves/waves.css') }}">

    <!-- DataTable -->
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URl('css-js-backend/base/assets/examples/css/tables/datatable.css') }}">

    <!-- Summernote -->
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/vendor/summernote/summernote.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ URL('css-js-backend/global/fonts/font-awesome/font-awesome.css') }}">
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
    <script src="{{ URL('css-js-backend/global/vendor/jquery/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ URL('assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        Breakpoints();
    </script>
    <style>
        .cke_focused,
        .cke_editable.cke_focused {
            outline: 3px dotted blue !important;
            *border: 3px dotted blue !important;
            /* For IE7 */
        }
    </style>
</head>

<body class="animsition">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
                <span class="sr-only">Toggle navigation</span>
                <span class="hamburger-bar"></span>
            </button>
            <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
                <i class="icon md-more" aria-hidden="true"></i>
            </button>
            <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
                <img class="navbar-brand-logo" src="{{ URL('assets/logo.png') }}" title="Ujob">
                <span class="navbar-brand-text hidden-xs-down"> Ujob</span>
            </div>
            <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search" data-toggle="collapse">
                <span class="sr-only">Toggle Search</span>
                <i class="icon md-search" aria-hidden="true"></i>
            </button>
        </div>

        <div class="navbar-container container-fluid">
            <!-- Navbar Collapse -->
            <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                <!-- Navbar Toolbar -->
                <ul class="nav navbar-toolbar">
                    <li class="nav-item hidden-float" id="toggleMenubar">
                        <a class="nav-link" data-toggle="menubar" href="#" role="button">
                            <i class="icon hamburger hamburger-arrow-left">
                                <span class="sr-only">Toggle menubar</span>
                                <span class="hamburger-bar"></span>
                            </i>
                        </a>
                    </li>
                    <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                        <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                            <span class="sr-only">Toggle fullscreen</span>
                        </a>
                    </li>
                </ul>
                <!-- End Navbar Toolbar -->

                <!-- Navbar Toolbar Right -->
                <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                            <span class="avatar avatar-online">
                                <img src="{{ URL('css-js-backend/global/portraits/5.jpg') }}" alt="...">
                                <i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="menuitem" href="{{ URL('admin/logout') }}">
                                <i class="icon md-power" aria-hidden="true"></i> {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- End Navbar Toolbar Right -->
            </div>
            <!-- End Navbar Collapse -->
        </div>
    </nav>
    <div class="site-menubar">
        <div class="site-menubar-body">
            <div>
                <div>
                    <ul class="site-menu" data-plugin="menu">
                        <li class="site-menu-category">Menu</li>
                        <li class="site-menu-item <?= (Session::get('menu_admin') == "dashboard") ? 'active' : ''; ?>">
                            <a class="animsition-link" href="{{ URL('admin/dashboard') }}">
                                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="site-menu-item <?= (Session::get('menu_admin') == "bidang_pekerjaan") ? 'active' : ''; ?>">
                            <a class="animsition-link" href="{{ URL('admin/bidang-pekerjaan') }}">
                                <i class="site-menu-icon fa-tags" aria-hidden="true"></i>
                                <span class="site-menu-title">Bidang Pekerjaan</span>
                            </a>
                        </li>
                        <li class="site-menu-item <?= (Session::get('menu_admin') == "perusahaan") ? 'active' : ''; ?>">
                            <a class="animsition-link" href="{{ URL('admin/perusahaan') }}">
                                <i class="site-menu-icon fa-building" aria-hidden="true"></i>
                                <span class="site-menu-title">Perusahaan</span>
                            </a>
                        </li>
                        <li class="site-menu-item <?= (Session::get('menu_admin') == "pekerjaan") ? 'active' : ''; ?>">
                            <a class="animsition-link" href="{{ URL('admin/pekerjaan') }}">
                                <i class="site-menu-icon fa-newspaper-o" aria-hidden="true"></i>
                                <span class="site-menu-title">Pekerjaan</span>
                            </a>
                        </li>
                        <li class="site-menu-item <?= (Session::get('menu_admin') == "pelamar") ? 'active' : ''; ?>">
                            <a class="animsition-link" href="{{ URL('admin/pelamar') }}">
                                <i class="site-menu-icon fa-universal-access" aria-hidden="true"></i>
                                <span class="site-menu-title">Pelamar</span>
                            </a>
                        </li>
                    </ul>
                    <div class="site-menubar-section">
                    </div>
                </div>
            </div>
        </div>

        <div class="site-menubar-footer">
            <a href="{{ URL('admin/dashboard') }}" class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Dashboard">
                <span class="icon md-view-dashboard" aria-hidden="true"></span>
            </a>
            <a href="{{ URL('admin/pelamar') }}" data-placement="top" data-toggle="tooltip" data-original-title="Pelamar">
                <span class="icon fa-universal-access" aria-hidden="true"></span>
            </a>
            <a href="{{ URL('admin/logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
                <span class="icon md-power" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <div class="site-gridmenu">
        <div>
            <div>
                <ul>
                    <li>
                        <a href="{{ URL('admin/dashboard') }}">
                            <i class="icon md-view-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page -->
    <div class="page">
        @yield('content')
    </div>
    <!-- End Page -->


    <!-- Footer -->
    <footer class="site-footer">
        <div class="site-footer-legal">© 2020</div>
        <div class="site-footer-right">
            Crafted with <i class="red-600 icon md-favorite"></i> by Ujob</a>
        </div>
    </footer>
    <!-- Core  -->
    <script src="{{ URL('css-js-backend/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
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

    <!-- DataTable -->
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-scroller/dataTables.scroller.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-buttons/dataTables.buttons.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-buttons/buttons.html5.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-buttons/buttons.flash.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-buttons/buttons.print.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-buttons/buttons.colVis.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/asrange/jquery-asRange.min.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/vendor/bootbox/bootbox.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ URl('css-js-backend/global/vendor/summernote/summernote.min.js') }}"></script>

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
        Config.set("assets", "{{ URL('css-js-backend/base/assets') }}");
    </script>

    <script src="{{ URL('css-js-backend/base/assets/js/Site.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/asscrollable.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/slidepanel.js') }}"></script>
    <script src="{{ URL('css-js-backend/global/js/Plugin/switchery.js') }}"></script>
    <script src="{{ URl('css-js-backend/global/js/Plugin/summernote.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ URL('css-js-backend/global/js/Plugin/datatables.js') }}"></script>
    <script src="{{ URL('css-js-backend/base/assets/examples/js/tables/datatable.js') }}"></script>
    <script src="{{ URL('css-js-backend/base/assets/examples/js/uikit/icon.js') }}"></script>

    <script src="{{ URL('css-js-backend/base/assets/examples/js/forms/editor-summernote.js') }}"></script>

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