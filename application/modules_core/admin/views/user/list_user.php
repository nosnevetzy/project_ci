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
                        <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'add_user')) { ?>
                            <li><a href="<?php echo admin_url("user/add_user"); ?>"><i class="icon-user-plus"></i> Add New User</a></li>
                        <?php }
                        ?>
                        <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'csv_export')) { ?>
                            <li><a href="#" id="User List" class="csv_export"><i class="icon-file-excel"></i> Export Table</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

    <!-- page content -->
    <div class="right_col" role="main" >
        <div id="clearflash" class="">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div id='containerList'><center style="min-height: 100vh;"><img src='<?php echo assets_dir("images/animal.gif"); ?>' ></center></div>
                </div><!-- end of .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of .clearflash -->
    </div><!-- end of .right_col -->

    <script type="text/javascript">
        $(document).ready(function () {
            load_datalist({action: "<?php echo admin_url('user/method/list_user'); ?>"});

            $('#containerList').on('click', '.delete_user', {
                'template': "<?php echo admin_url("template/confirmation"); ?>",
                'action': "<?php echo admin_url("user/method/delete_user"); ?>",
                'message': "You are about to delete this user.",
                'redirect': "<?php echo current_url(); ?>"
            }, load_dfltconfirmation);
        });
    </script>

<?php $this->load->view(admin_dir('template/footer')); ?>