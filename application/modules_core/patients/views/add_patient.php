<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-user-plus mr-5"></i> Add New Patient</span>
                </h5>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <a class="text-white" href="<?php echo patients_url('lists'); ?>"><i class="icon-undo position-left">
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
            <div class="panel panel-flat">
                <div class="panel-body">
                    <form class="form-horizontal form-validate-jquery" novalidate>
                        <fieldset class="content-group">
                            <legend class="text-bold">Personal Information</legend>
                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    First Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_fname" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Middle Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_mname" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Last Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_lname" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Birth Date <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="formdata_birthdate" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Gender
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select data-placeholder="Select a Gender..." class="form-control formdata select-search" id="formdata_gender">
                                        <option value=''></option>
                                        <option value='Male'>Male</option>
                                        <option value='Female'>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Address 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_address" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Occupation
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_occupation" class="form-control formdata">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3 text-right">
                                    Contact No.
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="formdata_contact" class="form-control formdata">
                                </div>
                            </div>
                        </fieldset>
                        <div class="item form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="<?php echo patients_url('lists'); ?>" class="btn bg-teal-400">Cancel</a>
                                <button id="formdata_confirm" type="button" class="btn btn-success" data-toggle="modal" href="#dfltmodal">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!-- end of .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of .right_col -->
        <!-- /page content -->


        <script type="text/javascript">
            $(document).ready(function () {
                $('#formdata_confirm').on('click', {
                    'template': "<?php echo admin_url("template/confirmation"); ?>",
                    'action': "<?php echo patients_url("page/method/add_patient"); ?>",
                    'message': "You are about to add a new patient. Check if the details are correct.",
                    'redirect': "<?php echo patients_url("lists"); ?>"
                }, load_dfltconfirmation);

            });
        </script>  
        <?php $this->load->view(admin_dir('template/footer')); ?>