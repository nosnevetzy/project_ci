<?php $this->load->view(admin_dir('template/header')); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div id="clearflash" class="">
        <div class="page-title">
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown" style="float: right;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench fa-2x"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if ($this->Misc->accessible($this->access, 'menu', 'method', 'copy_link')) { ?>
                                    <li><a data-toggle="modal" href="#dfltmodal" class="copylink"><span class="icomoon-icon-copy"></span> Copy Link</a></li>
                                    <?php
                                }
                                ?>
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

