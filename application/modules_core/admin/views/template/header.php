<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> --><!DOCTYPE html><html lang="en">    <head>        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        <!-- Meta, title, CSS, favicons, etc. -->        <?php if (!empty($template['SITE_TITLE'])) { ?><title><?php echo $template['SITE_TITLE']; ?></title><?php } ?>        <?php if (!empty($meta_author)) { ?><meta name="author" content="<?php echo $meta_author; ?>" /><?php } ?>        <?php if (!empty($meta_description)) { ?><meta name="description" content="<?php echo $meta_description; ?>" /><?php } ?>        <?php if (!empty($meta_keywords)) { ?><meta name="keywords" content="<?php echo $meta_keywords; ?>" /><?php } ?>        <?php if (!empty($meta_application_name)) { ?><meta name="application-name" content="<?php echo $meta_application_name; ?>" /><?php } ?>        <meta charset="utf-8">        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <meta name="viewport" content="width=device-width, initial-scale=1">        <!-- Global stylesheets -->        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">        <link href="<?php echo assets_dir("theme/css/icons/icomoon/styles.css"); ?>" rel="stylesheet" type="text/css">        <link href="<?php echo assets_dir("theme/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">        <link href="<?php echo assets_dir("theme/css/core.css"); ?>" rel="stylesheet" type="text/css">        <link href="<?php echo assets_dir("theme/css/components.css"); ?>" rel="stylesheet" type="text/css">        <link href="<?php echo assets_dir("theme/css/colors.css"); ?>" rel="stylesheet" type="text/css">        <!-- /global stylesheets -->               <!-- Core JS files -->        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/loaders/pace.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/core/libraries/jquery.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/core/libraries/bootstrap.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/loaders/blockui.min.js"); ?>"></script>        <!-- /core JS files -->        <!-- Theme JS files -->        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/validation/validate.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/selects/bootstrap_multiselect.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/inputs/touchspin.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/selects/select2.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/styling/switch.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/styling/switchery.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/styling/uniform.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/tables/tabletoexcel/jquery.table2excel.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/tables/tabletoexcel/export-excel.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/forms/selects/bootstrap_select.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/plugins/notifications/pnotify.min.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/core/app.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/pages/form_bootstrap_select.js"); ?>"></script>        <script type="text/javascript" src="<?php echo assets_dir("theme/js/pages/form_select2.js"); ?>"></script>        <!-- Theme JS files -->                <?php //echo assets_dir(""); ?>        <?php        $fixed_footer = $template['FIXED_FOOTER'] == 1 ? "footer_fixed" : "";        $fixed_menu = $template['FIXED_MENU'] == 1 ? "menu_fixed" : "";        ?>        <link href="<?php echo assets_dir("css/dflt.css"); ?>" rel="stylesheet" type="text/css" />        <!-- Le fav and touch icons -->        <link rel="shortcut icon" href="<?php echo assets_dir("images/favicon.ico"); ?>" />        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo assets_dir("images/apple-touch-icon-144-precomposed.png"); ?>" />        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo assets_dir("images/apple-touch-icon-114-precomposed.png"); ?>" />        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo assets_dir("images/apple-touch-icon-72-precomposed.png"); ?>" />        <link rel="apple-touch-icon-precomposed" href="<?php echo assets_dir("images/apple-touch-icon-57-precomposed.png"); ?>" />        <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->        <meta name="application-name" content="Supr"/>         <meta name="msapplication-TileColor" content="#3399cc"/>         <script type="text/javascript">            var baseURL = "<?php echo base_url(); ?>";            var loadMenu = true;            var adminURL = '<?= admin_url(); ?>';            var currentURL = '<?= current_url(); ?>';            var assetsDIR = '<?= assets_dir(); ?>';        </script>    </head>    <body class="nav-md <?= $fixed_footer ?>">        <!-- Main navbar -->        <div class="navbar navbar-default header-highlight">            <div class="navbar-header">                <a class="navbar-brand" href="index.html"><img src="<?php echo assets_dir("theme/images/logo_light.png"); ?>" alt=""></a>                <ul class="nav navbar-nav visible-xs-block">                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>                </ul>            </div>            <div class="navbar-collapse collapse" id="navbar-mobile">                <ul class="nav navbar-nav">                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>                   </ul>                <div class="navbar-right">                    <ul class="nav navbar-nav">                        <li class="dropdown dropdown-user">                            <a class="dropdown-toggle" data-toggle="dropdown">                                <img src="assets/images/placeholder.jpg" alt="">                                <span><?php echo $template['PROFILE_USER']; ?></span>                                <i class="caret"></i>                            </a>                            <ul class="dropdown-menu dropdown-menu-right">                                <?php                                if (!empty($template['CUS_MENU_TOP'])) {                                    foreach ($template['CUS_MENU_TOP'] as $var => $val) {                                        ?>                                        <li>                                            <a href="<?php echo ($val->link_external == 0) ? admin_url($val->link_url) : $val->link_url; ?>">                                                 <i class="icon-user-plus"></i>                                                <span><?php echo $val->link_name; ?></span>                                            </a>                                        </li>                                        <?php                                    }                                }                                ?>                                <li><a href="<?php echo admin_url('log/logout'); ?>"><i class="icon-switch2"></i> <span>Log Out</span></a></li>                            </ul>                        </li>                    </ul>                </div>            </div>        </div>        <!-- /main navbar -->    <!-- Page container -->    <div class="page-container">        <!-- Page content -->        <div class="page-content">            <!-- Main sidebar -->            <div class="sidebar sidebar-main">                <div class="sidebar-content">                    <!-- User menu -->                    <div class="sidebar-user">                        <div class="category-content">                            <div class="media">                                <a href="#" class="media-left"><img src="<?php echo assets_dir("theme/images/placeholder.jpg"); ?>" class="img-circle img-sm" alt=""></a>                                <div class="media-body">                                    <span class="media-heading text-semibold"><?php echo $template['PROFILE_USER']; ?>                                    </span>                                    <div class="text-size-mini text-muted">                                        <i class="icon-pin text-size-small"></i> &nbsp;Information Technology                                    </div>                                </div>                            </div>                        </div>                    </div>                    <!-- /user menu -->                    <!-- Main navigation -->                    <div class="sidebar-category sidebar-category-visible">                        <div class="category-content no-padding">                            <ul class="navigation navigation-main navigation-accordion">                                <!-- Main -->                                <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>                                <?php                                if (!empty($template['CUS_MENU_SIDE'])) {                                    $menu = $template['CUS_MENU_SIDE'];                                    foreach ($menu as $var => $val) {                                        if (!empty($val['val']['data'])) {                                            $info = $val['val']['data'];                                            if (!empty($val['child'])) {                                                ?>                                                <li <?php if ($template['CUS_MENU_SIDE_ACTIVE']['parent'] == $info->id_link)                                                        echo "class='active'";                                                    ?>>                                                    <a href="#" class="<?php if ($template['CUS_MENU_SIDE_ACTIVE']['parent'] == $info->id_link) echo "drop"; ?>">                                                        <i class="icon-gear"></i>                                                        <?php echo $info->link_name; ?>                                                        <span class="fa fa-chevron-down"></span>                                                    </a>                                                    <ul style="display:<?php                                                    if ($template['CUS_MENU_SIDE_ACTIVE']['parent'] == $info->id_link)                                                        echo "block";                                                    else                                                        echo "none";                                                    ?>"><?php if ($info->link_head == 0) { ?>                                                            <li>                                                                <a href="<?php echo ($info->link_external == 0) ? admin_url($info->link_url) : $info->link_url; ?>" <?php                                                                if ($info->link_newtab == 1) {                                                                    echo "target=_blank";                                                                }                                                                ?> class="<?php if ($template['CUS_MENU_SIDE_ACTIVE']['id'] == $info->id_link) echo "current"; ?>"><span class="icon16 <?php echo $info->link_icon; ?>"></span><?php echo $info->link_name; ?></a>                                                            </li><?php                                                        }                                                        foreach ($val['child'] as $var2 => $val2) {                                                            $info2 = $val2['val']['data'];                                                            ?>                                                            <li <?php if ($template['CUS_MENU_SIDE_ACTIVE']['id'] == $info2->id_link) echo "class='active'"; ?>">                                                                <a                                                                 <?php                                                                if ($info2->link_newtab == 1) {                                                                    echo "target=_blank";                                                                }                                                                ?> href="<?php echo ($info2->link_external == 0) ? admin_url($info2->link_url) : $info2->link_url; ?>" ><span class="icon16 <?php echo $info2->link_icon; ?>"></span><?php echo $info2->link_name; ?></a>                                                            </li>                                                        <?php } ?>                                                      </ul>                                                </li>                                                   <?php } else {                                                ?>                                                <li>                                                    <a <?php                                                    if ($info->link_newtab == 1) {                                                        echo "target=_blank";                                                    }                                                    ?> href="<?php echo ($info->link_external == 0) ? admin_url($info->link_url) : $info->link_url; ?>"> <span class="icon16  <?php echo $info->link_icon; ?>"></span><?php echo $info->link_name; ?> </a>                                                </li>                                                <?php                                            }                                        }                                    }                                }                                ?>                            </ul>                        </div>                    </div>                    <!-- /main navigation -->                </div>            </div>            <!-- /main sidebar -->