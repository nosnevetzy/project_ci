<?php $this->load->view(admin_dir('template/header')); ?>
<!--Body content-->
<div class="right_col" role="main">
    <div id="clearflash">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit User Type</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 pull-right" style="margin: 0;">
                    <div class="x_content">
                        <a href="<?php echo admin_url('user_type/list_user_type'); ?>"  class="btn btn-round btn-primary" style="float: right;"><span class='fa fa-undo'></span> Back</a>
                    </div>
                </div>
            </div>
        </div><!-- end of page-title -->
        <div class="clearfix"></div>
        <div class="row">
            <div id="content" class="clearfix">
                <div class="contentwrapper"><!--Content wrapper-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="x_panel">
                            <div class="x_title">
                                <h4>
                                    <span>User Type Information</span>
                                </h4>
                            </div>
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
                    </div>
                </div><!-- End  -->
                <!-- Page end here -->
            </div><!-- End #content -->
        </div><!-- end of row -->
    </div>
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