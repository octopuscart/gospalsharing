<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title><?php echo SITE_NAME ?> | Admin Panel</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <?php
        $styleSheetArray = array(
            "Style" => "assets/dist/css/style.min.css",
            "Gitter" => "assets/gritter/css/jquery.gritter.css",
        );
        foreach ($styleSheetArray as $title => $stylesheet) {
            ?>
                                                                        <!-- ================== <?php echo $title ?> ================== -->
            <link href="<?php echo base_url(); ?><?php echo $stylesheet; ?>" rel="stylesheet" />
            <?php
        }
        ?>


        <!-- ============================================================== -->
        <script src="<?php echo base_url(); ?>assets/assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

        <!--angular js-->
        <script src="<?php echo base_url(); ?>assets/angular/angular.min.js"></script>
        <!--sweet alert-->
        <script src="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo base_url(); ?>assets/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css"
            />
        <style>
            .card.disable {
                opacity: 0.2;
            }

            element.style {
            }
            @media (min-width: 768px){
                #main-wrapper[data-layout=vertical][data-sidebar-position=fixed][data-sidebartype=full] .topbar .top-navbar .navbar-collapse, #main-wrapper[data-layout=vertical][data-sidebar-position=fixed][data-sidebartype=overlay] .topbar .top-navbar .navbar-collapse {
                    margin-left: 250px;
                }
            }
            #main-wrapper[data-layout=vertical] .topbar .navbar-collapse[data-navbarbg=skin3], #main-wrapper[data-layout=vertical] .topbar[data-navbarbg=skin3], #main-wrapper[data-layout=horizontal] .topbar .navbar-collapse[data-navbarbg=skin3], #main-wrapper[data-layout=horizontal] .topbar[data-navbarbg=skin3] {
                background: #ba9248;
            }
            #main-wrapper[data-layout=vertical] .topbar .top-navbar .navbar-header[data-logobg=skin3], #main-wrapper[data-layout=horizontal] .topbar .top-navbar .navbar-header[data-logobg=skin3] {
                background: #ba9248;
            }
            .sidebar-nav>ul>li.selected>a {
                border-radius: 60px 0 0 60px;
                background: #ba9248;
                color: #fff;
            }

        </style>
        <!--custom style-->
        <style>
<?php echo HEADERCSS; ?>
            span.display_index {
                font-weight: bold;
                font-size: 14px;
                margin-left: 10px;
            }
            b, strong {
                font-weight: bold;
            }
        </style>
        <!--custom style-->


    </head>
    <body class="" ng-app="Admin">

        <script>
            var Admin = angular.module('Admin', []).config(function ($interpolateProvider, $httpProvider) {
            //$interpolateProvider.startSymbol('{$');
            //$interpolateProvider.endSymbol('$}');
            $httpProvider.defaults.headers.common = {};
            $httpProvider.defaults.headers.post = {};
            });
            var rootBaseUrl = '<?php echo site_url("/"); ?>';
        </script>
        <!-- begin #page-loader -->
        <div id="page-loader" class="fade in"><span class="spinner"></span></div>
        <!-- end #page-loader -->
        <!-- begin #page-container -->
        <div id="page-container" class="page-sidebar-fixed page-header-fixed" ng-controller="rootController">