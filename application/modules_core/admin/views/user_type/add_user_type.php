<?php $this->load->view(admin_dir('template/header')); ?>
<!--Body content-->

<div class="right_col" role="main">
    <div id="clearflash">
        <div class="page-title">
            <div class="title_left">&nbsp;</div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 pull-right" style="margin: 0;">
                    <div class="x_content">
                        <a href="<?php echo admin_url('user_type/list_user_type'); ?>"  class="btn btn-round btn-primary" style="float: right;"><span class='fa fa-undo'></span> Back</a>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">User Type <span class="required">*</span> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="formdata_code" class="form-control formdata col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button data-toggle="modal" href="#dfltmodal" class="btn btn-warning ui-wizard-content ui-formwizard-button" id='formdata_confirm' type="button">Save</button>
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
        $('#formdata_confirm').on('click', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'action': "<?php echo admin_url("user_type/method/add_user_type"); ?>",
            'message': "You are about to add this user type.",
            'redirect': "<?php echo admin_url("user_type/list_user_type"); ?>"
        }, load_dfltconfirmation);
    });
</script>	

<?php $this->load->view(admin_dir('template/footer')); ?>