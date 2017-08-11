<?php $this->load->view(admin_dir('template/header')); ?>

<div class="right_col" role="main">
    <div id="clearflash" class="">
        <div class="page-title">
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <!--Body content-->
            <div id="def_body" class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-folder-open"></i> View User Type<small><?php echo $row->user_type; ?> Information</small></h2>
                        <a href="<?php echo admin_url('user_type/list_user_type'); ?>"  class="btn btn-round btn-primary" style="float: right;"><span class='fa fa-undo'></span> Back</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content flex">
                        <div class="col-md-3"></div>

                        <div class="col-md-9">
                            <div class="row">
                                <label class="col-lg-4 control-label">User Type</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $row->user_type; ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- End #def_body -->
    </div><!-- end of row -->
</div>
<!-- /page content -->


<?php $this->load->view(admin_dir('template/footer')); ?>