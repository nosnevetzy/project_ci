<?php $this->load->view(admin_dir('template/header')); ?>
<!--Body content-->
<div class="right_col" role="main">
    <div id="clearflash">
        <div class="page-title">
            <div class="title_left">&nbsp;</div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 pull-right" style="margin: 0;">
                    <div class="x_content">
                        <a href="<?php echo admin_url('user/list_user'); ?>"  class="btn btn-round btn-primary" style="float: right;"><span class='fa fa-undo'></span> Back</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div><!-- end of page-title -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add New User Type</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_code">ID No.<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="formdata_code" class="form-control formdata col-md-7 col-xs-12"  placeholder="You cannot change this once added."  type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_fname">First Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_fname" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_mname">Middle Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_mname" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_fname">Last Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_lname" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_fname">Street <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_street" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_city">City <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_city" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_province">Province <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_province" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_country">Country <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_country" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_contact">Contact No <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_contact" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_usertype">User Type <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control formdata col-md-7 col-xs-12 chosen" id="formdata_usertype">
                                    <?php foreach ($user_types as $q) { ?>
                                        <option value='<?php echo $q->id_user_type; ?>'><?php echo $q->user_type; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Department <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control formdata col-md-7 col-xs-12 chosen" id="formdata_department">
                                    <option value=''></option>
                                    <?php foreach ($departments as $q) { ?>
                                        <option value='<?php echo $q->id_department; ?>'><?php echo $q->department_name; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_email">Email <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" id="formdata_email" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="formdata_password" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="<?php echo admin_url('user/list_user'); ?>" class="btn btn-primary">Cancel</a>
                                <button id="formdata_confirm" type="button" class="btn btn-success" data-toggle="modal" href="#dfltmodal">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!-- end of .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of div -->
    </div><!-- end of .clearflash -->
</div><!-- end of .right_col -->


<script type="text/javascript">
    $(document).ready(function () {
        console.log(init_validator());
        $('#formdata_confirm').on('click', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'action': "<?php echo admin_url("user/method/add_user"); ?>",
            'message': "You are about to add new user. Check if the ID No. is correct, you cannot change it once added.",
            'redirect': "<?php echo admin_url("user/list_user"); ?>"
        }, load_dfltconfirmation);

    });
</script>   
<?php $this->load->view(admin_dir('template/footer')); ?>