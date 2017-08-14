<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-pencil7 mr-5"></i> Edit User Type</span>
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
            <div id="content" class="clearfix">
                <div class="contentwrapper"><!--Content wrapper-->
                    <div class="panel panel-flat">
                        <div class="panel-body ">
                            <div class="row formdata_alert"></div>
                            <div class="row form-horizontal">
                                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">User Type</label>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <input type="text" class="form-control formdata" id="formdata_code" value='<?php echo $row->user_type; ?>'/>
                                        </div>
                                    </div><!-- End .form-group  -->

                                    <hr>
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


<script type="text/javascript">
    $(document).ready(function () {

        $('#formdata_confirm').on('click', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'action': "<?php echo admin_url("user_type/method/edit_user_type"); ?>",
            'id': "<?php echo $this->Misc->encode_id($row->id_user_type); ?>",
            'message': "You are about to edit this user type.",
            'redirect': "<?php echo admin_url("user_type/list_user_type"); ?>"
        }, load_dfltconfirmation);
    });
</script>	

<?php $this->load->view(admin_dir('template/footer')); ?>