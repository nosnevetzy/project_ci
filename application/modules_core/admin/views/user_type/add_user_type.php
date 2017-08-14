<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-user-plus mr-5"></i> Add New User Type</span>
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
        <div class="panel panel-flat">
            <div class="panel-body">
                <form class="form-horizontal form-label-left" novalidate>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right">User Type <span class="required">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="formdata_code" class="form-control formdata col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button data-toggle="modal" href="#dfltmodal" class="btn btn-warning ui-wizard-content ui-formwizard-button" id='formdata_confirm' type="button">Save</button>
                        </div>
                    </div>
                </form>
            </div><!-- end of .x_content -->
        </div><!-- end of .x_panel -->
    </div><!-- end of .right_col -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#formdata_confirm').on('click', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'action': "<?php echo admin_url("user_type/method/add_user_type"); ?>",
            'message': "You are about to add this user type.",
            'redirect': "<?php echo admin_url("user_type/list_user_type"); ?>"
        }, load_dfltconfirmation);
    });
</script>	

<?php $this->load->view(admin_dir('template/footer')); ?>