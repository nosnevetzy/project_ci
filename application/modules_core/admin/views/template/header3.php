<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php if(!empty($template['SITE_TITLE'])){ ?><title><?php echo $template['SITE_TITLE']; ?></title><?php } ?>
    <?php if(!empty($meta_author)){ ?><meta name="author" content="<?php echo $meta_author; ?>" /><?php } ?>
	<?php if(!empty($meta_description)){ ?><meta name="description" content="<?php echo $meta_description; ?>" /><?php } ?>
    <?php if(!empty($meta_keywords)){ ?><meta name="keywords" content="<?php echo $meta_keywords; ?>" /><?php } ?>
    <?php if(!empty($meta_application_name)){ ?><meta name="application-name" content="<?php echo $meta_application_name; ?>" /><?php } ?>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Force IE9 to render in normla mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Le styles -->
	
    <!-- Use new way for google web fonts 
    http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' /> <!-- Headings -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> <!-- Text -->
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->

    <!-- Core stylesheets do not delete -->
    <link id="bootstrap" href="<?php echo assets_dir("css/bootstrap/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_dir("css/bootstrap/bootstrap-theme.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_dir("css/supr-theme/jquery.ui.supr.css"); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo assets_dir("css/icons.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_dir("css/dflt.css"); ?>" rel="stylesheet" type="text/css" />

    <!-- Plugin stylesheets -->
    <link href="<?php echo assets_dir("plugins/misc/qtip/jquery.qtip.css"); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo assets_dir("plugins/forms/inputlimiter/jquery.inputlimiter.css"); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo assets_dir("plugins/forms/togglebutton/toggle-buttons.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_dir("plugins/forms/uniform/uniform.default.css"); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo assets_dir("plugins/forms/color-picker/color-picker.css"); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo assets_dir("plugins/forms/select/select2.css"); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo assets_dir("plugins/forms/validate/validate.css"); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo assets_dir("plugins/forms/smartWizzard/smart_wizard.css"); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo assets_dir("plugins/misc/prettify/prettify.css"); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo assets_dir("plugins/misc/pnotify/jquery.pnotify.default.css"); ?>" type="text/css" rel="stylesheet" />
	
	<link href="<?php echo assets_dir("plugins/misc/jqueryFileTree/jqueryFileTree.css"); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo assets_dir("plugins/tables/dataTables/jquery.dataTables.css"); ?>" type="text/css" rel="stylesheet" />  
	<link href="<?php echo assets_dir("plugins/gallery/jpages/jPages.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_dir("plugins/gallery/pretty-photo/prettyPhoto.css"); ?>" type="text/css" rel="stylesheet" />
    <!-- Main stylesheets -->
    <link href="<?php echo assets_dir("css/main.css"); ?>" rel="stylesheet" type="text/css" /> 

    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="<?php echo assets_dir("css/custom.css"); ?>" rel="stylesheet" type="text/css" /> 

    <!--[if IE 8]><link href="<?php echo assets_dir("css/ie8.css"); ?>" rel="stylesheet" type="text/css" /><![endif]-->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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

    <!-- Load modernizr first -->
    <script type="text/javascript" src="<?php echo assets_dir("js/libs/modernizr.js"); ?>"></script>
	
	<!-- Load js source -->
    <script type="text/javascript" src="<?php echo assets_dir("js/jquery/jquery.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo assets_dir("js/jquery/jquery-ui.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo assets_dir("js/jquery/jquery-migrate-1.2.1.min.js"); ?>"></script>	
	<script type="text/javascript">
		var baseURL="<?php echo base_url(); ?>";
		var loadMenu=true;
	</script>
    </head>
      
    <body>
		