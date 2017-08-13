<?php $this->load->view(admin_dir('template/header')); ?>

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <i class=" icon-folder-open2 mr-5"></i>
                    View User
                    <small><?php echo $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname); ?>'s Information</small>
                </h5>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <a class="text-white" href="<?php echo admin_url('user/list_user'); ?>"><i class="icon-undo position-left">
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
        <div id="clearflash" class="">
            <div class="row">
                <!--Body content-->
                <div id="def_body" class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-body">
                        <div class="panel-body flex">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img img-avatar">
                                        <img class="img-responsive avatar-view" src="<?php echo upload_user_dir($row->id_user . '/profile/' . $row->user_picture); ?>" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">ID No.:</label>
                                    <div class="pull-right"><?php echo $row->user_code; ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">First Name:</label>
                                    <div class="pull-right"><?php echo $row->user_fname; ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">Middle Name:</label>
                                    <div class="pull-right"><?php echo $row->user_mname; ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">Last Name:</label>
                                    <div class="pull-right"><?php echo $row->user_lname; ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">Address:</label>
                                    <div class="pull-right"><?php echo "$row->user_street $row->user_city $row->user_province $row->user_country"; ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">Contact No:</label>
                                    <div class="pull-right"><?php echo $row->user_contact; ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">User Type:</label>
                                    <div class="pull-right">
                                    <?php foreach ($user_types as $q) { ?>
                                        <?= ($q->id_user_type == $row->id_user_type) ? $q->user_type : ''; ?>
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">Department:</label>
                                    <div class="pull-right">
                                        <?php foreach ($departments as $q) { ?>
                                            <?= ($q->id_department == $row->department_id) ? $q->department_name : ''; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label no-margin text-semibold">Email Address:</label>
                                    <div class="pull-right"><?php echo $row->user_email; ?></div>
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