<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-list-unordered mr-5"></i> User List</span>
                </h5>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <button class="btn btn-icon btn-sm dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-wrench"></i>
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <?php if ($this->Misc->accessible($this->access, 'menu', 'method', 'copy_link')) { ?>
                            <li><a data-toggle="modal" href="#dfltmodal" class="copylink"><span class="icon-copy3"></span> Copy Link</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div id='containerList'><center style="min-height: 100vh;"><img src='<?php echo assets_dir("images/animal.gif"); ?>' ></center></div>
                </div><!-- end of .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of div -->
    </div><!-- end of .right_col -->

<script type = "text/javascript">
    $(document).ready(function () {
        load_datalist({action: "<?php echo admin_url('menu/method/list_usertype'); ?>"});

        //Link
        $('.copylink').on('click', {
            'action': "<?php echo admin_url("menu/popupform_link"); ?>",
            'type': 3,
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltpopform);
    });
</script>
<?php $this->load->view(admin_dir('template/footer')); ?>

