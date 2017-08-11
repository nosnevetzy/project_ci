<?php $this->load->view(admin_dir('template/header')); ?>
<!--Body content-->
<div class="right_col" role="main">
    <div id="clearflash">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit User</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 pull-right" style="margin: 0;">
                    <div class="x_content">
                        <a href="<?php echo admin_url('user/list_user'); ?>"  class="btn btn-round btn-primary" style="float: right;"><span class='fa fa-undo'></span> Back</a>
                    </div>
                </div>
            </div>
        </div><!-- end of page-title -->
        <div class="clearfix"></div>
        <div class="row">
            <div id="content" class="clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <div class="x_panel">
                        <div class="x_title">
                            <h4>
                                <span><?php echo $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname); ?>'s Information</span>
                            </h4>
                        </div>
                        <div class="panel-body ">
                            <div class="row formdata_alert"></div>
                            <div class="row form-horizontal">
                                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">ID No.</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_code" value='<?php echo $row->user_code; ?>' readonly/>
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">* First Name</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_fname" value='<?php echo $row->user_fname; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">* Middle Name</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_mname" value='<?php echo $row->user_mname; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">* Last Name</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_lname"  value='<?php echo $row->user_lname; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">Street</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_street" value='<?php echo $row->user_street; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">City</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_city" value='<?php echo $row->user_city; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">Province</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_province" value='<?php echo $row->user_province; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">Country</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_country" value='<?php echo $row->user_country; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">Contact No</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_contact" value='<?php echo $row->user_contact; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->

                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">* User Type</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <select name="select" class="form-control formdata chosen" id="formdata_usertype">
                                                <?php foreach ($user_types as $q) { ?>
                                                    <option value='<?php echo $q->id_user_type; ?>' <?php echo ($q->id_user_type == $row->id_user_type) ? "Selected" : ""; ?> ><?php echo $q->user_type; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div><!-- End .form-group  -->

                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">* Department</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <select class="form-control formdata chosen" id="formdata_department" >
                                                <option value=''></option>
                                                <?php foreach ($departments as $q) { ?>
                                                    <option value='<?php echo $q->id_department; ?>' <?= ($row->department_id == $q->id_department) ? 'selected' : ''; ?>><?php echo $q->department_name; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div><!-- End .form-group  -->

                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">Email</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_email" value='<?php echo $row->user_email; ?>' />
                                        </div>
                                    </div><!-- End .form-group  -->

                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">Password</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_password"  />
                                        </div>
                                    </div><!-- End .form-group  -->

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-8">
                                            <button data-toggle="modal" href="#dfltmodal" class="btn btn-warning ui-wizard-content ui-formwizard-button" id='formdata_confirm' type="button">Save</button>
                                        </div>
                                    </div><!-- End .form-group  --> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End  -->
                <!-- Page end here -->
            </div><!-- End #content -->
        </div><!-- end of row -->
    </div>
</div>
<!-- /page content -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#formdata_confirm').on('click', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'action': "<?php echo admin_url("user/method/edit_user"); ?>",
            'id': "<?php echo $this->Misc->encode_id($row->id_user); ?>",
            'message': "You are about to edit user.",
            'redirect': "<?php echo admin_url("user/list_user"); ?>"
        }, load_dfltconfirmation);
    });
</script>	

<?php $this->load->view(admin_dir('template/footer')); ?>