<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>NO ACCESS</title>


        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Force IE9 to render in normla mode -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- Le styles -->
        <link href="<?php echo assets_dir("css/bootstrap/bootstrap.css"); ?>" rel="stylesheet" />
        <link href="<?php echo assets_dir("css/bootstrap/bootstrap-responsive.css"); ?>" rel="stylesheet" />
        <link href="<?php echo assets_dir("css/icons.css"); ?>" rel="stylesheet" type="text/css" />

        <!-- Main stylesheets -->
        <link href="<?php echo assets_dir("css/main.css"); ?>" rel="stylesheet" type="text/css" /> 

    <!--[if IE 8]><link href="<?php echo assets_dir("css/ie8.css"); ?>" rel="stylesheet" type="text/css" /><![endif]-->

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script type="text/javascript" src="<?php echo assets_dir("js/libs/excanvas.min.js"); ?>"></script>
           <script type="text/javascript" src="<?php echo assets_dir("js/html5.js"); ?>"></script>
          <script type="text/javascript" src="<?php echo assets_dir("js/libs/respond.min.js"); ?>"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo assets_dir("images/favicon.ico"); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo assets_dir("images/apple-touch-icon-144-precomposed.png"); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo assets_dir("images/apple-touch-icon-114-precomposed.png"); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo assets_dir("images/apple-touch-icon-72-precomposed.png"); ?>" />
        <link rel="apple-touch-icon-precomposed" href="<?php echo assets_dir("images/apple-touch-icon-57-precomposed.png"); ?>" />

        <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
        <meta name="application-name" content="Supr"/> 
        <meta name="msapplication-TileColor" content="#3399cc"/> 

    </head>

    <body class="errorPage">

        <div class="container-fluid">

            <div class="errorContainer">
                <div class="page-header">
                    <h1 class="center">Access Not Granted</h1>
                </div>

                <h2 class="center" style="color: red;"><?= $message; ?></h2>
                <div class="col-lg-offset-4 col-lg-8">
                    <button class="btn btn-default ui-wizard-content ui-formwizard-button" id='formdata-back' type="button" onclick="goBack()">
                        <i class="icon16 typ-icon-back"></i>
                        Back
                    </button>
                </div>
            </div>

        </div><!-- End .container -->

        <!-- Le javascript
        ================================================== -->
        <script type="text/javascript" src="<?php echo assets_dir("js/jquery/jquery.min.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo assets_dir("js/bootstrap/bootstrap.js"); ?>"></script>  

        <script type="text/javascript">
            // document ready function
            $(document).ready(function () {
                //------------- Some fancy stuff in error pages -------------//
                $('.errorContainer').hide();
                $('.errorContainer').fadeIn(1000).animate({
                    'top': "50%", 'margin-top': +($('.errorContainer').height() / -2 - 30)
                }, {duration: 750, queue: false}, function () {
                    // Animation complete.
                });
            });
            
            function goBack(){
                window.history.back();
            }
        </script>

    </body>
</html>