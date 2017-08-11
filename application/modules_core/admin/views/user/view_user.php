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
                        <h2><i class="fa fa-folder-open"></i> View User <small><?php echo $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname); ?>'s Information</small></h2>
                        <a href="<?php echo admin_url('user/list_user'); ?>"  class="btn btn-round btn-primary" style="float: right;"><span class='fa fa-undo'></span> Back</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content flex">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img img-avatar">
                                    <img class="img-responsive avatar-view" src="<?php echo upload_user_dir($row->id_user . '/profile/' . $row->user_picture); ?>" alt="Avatar" title="Change the avatar">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <label class="col-lg-4 control-label">ID No.</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $row->user_code; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 control-label">First Name</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $row->user_fname; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 control-label">Middle Name</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $row->user_mname; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 control-label">Last Name</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $row->user_lname; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 control-label">Address</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo "$row->user_street, $row->user_city, $row->user_province, $row->user_country"; ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-4 control-label">Contact No</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $row->user_contact; ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-4 control-label">User Type</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php foreach ($user_types as $q) { ?>
                                            <?= ($q->id_user_type == $row->id_user_type) ? $q->user_type : ''; ?>
                                        <?php } ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 control-label">Department</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php foreach ($departments as $q) { ?>
                                            <?= ($q->id_department == $row->department_id) ? $q->department_name : ''; ?>
                                        <?php } ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 control-label">Email</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $row->user_email; ?></p>
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