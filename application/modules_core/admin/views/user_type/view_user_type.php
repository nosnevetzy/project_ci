<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <i class=" icon-folder-open2 mr-5"></i>
                    View User Type
                    <small><?php echo $row->user_type; ?></small>
                </h5>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <a class="text-white" href="<?php echo admin_url('user_type/list_user_type'); ?>"><i class="icon-undo position-left">
                    <button type="button" class="btn bg-teal-400">
                        </i> Back to list
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <!--Body content-->
            <div id="def_body">
                <div class="panel panel-flat">
                    <div class="panel-body flex">
                        <div class="col-md-offset-3 col-lg-offset-3 col-sm-offset-3 col-md-3 col-lg-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label no-margin text-semibold">User Type:</label>
                                <div class="pull-right"><?php echo $row->user_type; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End #def_body -->
    </div>
    <!-- /page content -->


<?php $this->load->view(admin_dir('template/footer')); ?>