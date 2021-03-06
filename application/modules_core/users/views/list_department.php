<?php $this->load->view(admin_dir('template/header')); ?>
<!-- page content -->
<div class="right_col" role="main" >
    <div id="clearflash" class="">
        <div class="page-title">
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Departments List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown" style="float: right;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench fa-2x"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'add_user')) { ?>
                                <li style="padding: 5px 10px;"><a href="<?php echo users_url("page/add_user"); ?>"><span class="icomoon-icon-plus"></span> Add New User</a></li>
                                <?php }
                                ?>
                                <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'csv_export')) { ?>
                                    <li style="padding: 5px 10px;"><a href="#" id="User List" class="csv_export"><span class="icomoon-icon-file-excel" style="pointer-events: cursor"></span> Export Table</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul> 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id='containerList'><center style="min-height: 100vh;"><img src='<?php echo assets_dir("images/animal.gif"); ?>' ></center></div>
                </div><!-- end of .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of div -->
    </div><!-- end of .clearflash -->
</div><!-- end of .right_col -->

<script type="text/javascript">
    $(document).ready(function () {
        load_datalist({action: "<?php echo users_url('lists/method/list_department'); ?>"});

        $('#containerList').on('click', '.delete_user', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'action': "<?php echo users_url("page/method/delete_user"); ?>",
            'message': "You are about to delete this user.",
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltconfirmation);
    });
</script>
<?php $this->load->view(admin_dir('template/footer')); ?>