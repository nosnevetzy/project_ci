<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-pencil7 mr-5"></i> Edit User</span>
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
        <div id="clearflash">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <form class="form-horizontal form-validate-jquery" novalidate>
                        <fieldset class="content-group">
                            <legend class="text-bold"><?php echo $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname); ?>'s Information</legend>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    ID No. <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_code" class="form-control formdata" value='<?php echo $row->user_code; ?>' readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    First Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_fname" class="form-control formdata" value='<?php echo $row->user_fname; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Middle Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_mname" class="form-control formdata" value='<?php echo $row->user_mname; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Last Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_lname" class="form-control formdata" value='<?php echo $row->user_lname; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Street <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_street" class="form-control formdata" value='<?php echo $row->user_street; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    City <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_city" class="form-control formdata" value='<?php echo $row->user_city; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Province <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_province" class="form-control formdata" value='<?php echo $row->user_province; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Country <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" id="formdata_country" class="form-control formdata" value='<?php echo $row->user_country; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Contact No. <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_contact" class="form-control formdata" value='<?php echo $row->user_contact; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    User Type <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select data-placeholder="Select a User Type..." class="form-control formdata select-search" id="formdata_usertype">
                                        <?php foreach ($user_types as $q) { ?>
                                            <option value='<?php echo $q->id_user_type; ?>'
                                            <?php echo ($q->id_user_type == $row->id_user_type) ? "selected" : ""; ?>><?php echo $q->user_type; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Department <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select data-placeholder="Select a Department..." class="form-control formdata select-search" id="formdata_department">
                                        <option value=''></option>
                                        <?php foreach ($departments as $q) { ?>
                                            <option value='<?php echo $q->id_department; ?>'
                                            <?= ($row->department_id == $q->id_department) ? 'selected' : ''; ?>><?php echo $q->department_name; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="formdata_email" class="form-control formdata" value='<?php echo $row->user_email; ?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="formdata_password" class="form-control formdata">
                                </div>
                            </div>

                        </fieldset>
                        
                        <div class="form-group">
                            <div class="col-lg-8">
                                <button data-toggle="modal" href="#dfltmodal" class="btn bg-teal-400 ui-wizard-content ui-formwizard-button" id='formdata_confirm' type="button">Update Information</button>
                            </div>
                        </div><!-- End .form-group  -->
                    </form>
                </div><!-- end of .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of .clearflash -->
    </div><!-- end of .right_col -->
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