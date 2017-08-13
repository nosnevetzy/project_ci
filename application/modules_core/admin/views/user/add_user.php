<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-user-plus mr-5"></i> Add New User</span>
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
                            <legend class="text-bold">Personal Information</legend>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    ID No. <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_code" class="form-control formdata" placeholder="You cannot change this once added.">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    First Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_fname" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Middle Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_mname" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Last Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_lname" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Street <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_street" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    City <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_city" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Province <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_province" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Country <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                   <input type="text" id="formdata_country" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Contact No. <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" id="formdata_contact" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    User Type <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Select a User Type..." class="form-control formdata select-search" id="formdata_usertype">
                                        <?php foreach ($user_types as $q) { ?>
                                            <option value='<?php echo $q->id_user_type; ?>'><?php echo $q->user_type; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Department <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Select a Department..." class="form-control formdata select-search" id="formdata_department">
                                        <option value=''></option>
                                        <?php foreach ($departments as $q) { ?>
                                            <option value='<?php echo $q->id_department; ?>'><?php echo $q->department_name; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="email" id="formdata_email" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9">
                                    <input type="password" id="formdata_password" class="form-control formdata">
                                </div>
                            </div>

                        </fieldset>
                        
                        <div class="item form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="<?php echo admin_url('user/list_user'); ?>" class="btn bg-teal-400">Cancel</a>
                                <button id="formdata_confirm" type="button" class="btn btn-success" data-toggle="modal" href="#dfltmodal">Submit</button>
                            </div>
                        </div>
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
            'action': "<?php echo admin_url("user/method/add_user"); ?>",
            'message': "You are about to add new user. Check if the ID No. is correct, you cannot change it once added.",
            'redirect': "<?php echo admin_url("user/list_user"); ?>"
        }, load_dfltconfirmation);

    });
</script>  
<?php $this->load->view(admin_dir('template/footer')); ?>