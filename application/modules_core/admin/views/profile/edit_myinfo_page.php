<?php
$this->load->view(admin_dir('template/header'));
$row = $result;
?>
<div class="right_col" role="main">
    <div id="clearflash">
        <div class="page-title">
            <div class="title_left">&nbsp;</div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 pull-right" style="margin: 0;">
                    <div class="x_content">
                        <a href="<?php echo admin_url('profile/view_profile_page'); ?>"  class="btn btn-round btn-primary" style="float: right;"><span class='fa fa-undo'></span> Back</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div><!-- end of page-title -->

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Upload Profile Picture</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row formupload_alert"></div>
                    <form class="form-horizontal form-label-left" novalidate>
                        <div class="well well-small progressbar_div display-none">
                            &nbsp;
                            <div class="inline middle blue bigger-110"> Your profile picture is <span class='progressbar_upload_label'></span> complete </div>
                            &nbsp; &nbsp; &nbsp;
                            <div id='progressbar_upload' style="width:100%;" data-percent="" class="inline middle no-margin progress progress-success progress-striped active">
                                <div class="bar"></div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-5 col-sm-5 col-xs-12" for="normalInput">Upload Here <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <form id="upload_form" enctype="multipart/form-data" method="post">
                                    <input type="file"  class='formupload' name="formupload_file" id="formupload_file" />
                                </form>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button  class="btn btn-info ui-wizard-content ui-formwizard-button" id='formupload_save' type="button">Upload Photo</button>
                                &nbsp;
                                <a href="<?php echo admin_url('profile/take_picture_page'); ?>">
                                    <button  class="btn btn-success ui-wizard-content ui-formwizard-button"  type="button"><span class="icomoon-icon-camera-3 white"></span> Take a Picture <span class="icomoon-icon-arrow-right-7 white"></span></button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Personal Information</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row formdata_alert"></div>
                    <form class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_fname">First Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_fname" value='<?php echo $row->user_fname ?>' />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_mname">Middle Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_mname" value='<?php echo $row->user_mname ?>' />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_lname">Last Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_lname" value='<?php echo $row->user_lname ?>' />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_street">Street <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_street" value='<?php echo $row->user_street ?>' />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_city">City <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_city" value='<?php echo $row->user_city ?>' />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_province">Province <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_province" value='<?php echo $row->user_province ?>' />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_country">Country <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_country" value='<?php echo $row->user_country ?>' />
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formdata_contact">Contact No. <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control formdata" id="formdata_contact" value='<?php echo $row->user_contact ?>' />
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button data-toggle="modal" href="#dfltmodal" class="btn btn-warning ui-wizard-content ui-formwizard-button" id='formdata_confirm' type="button">Update</button>
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
        $('#formupload_save').on('click', {
            'action': "<?php echo admin_url("profile/method/upload_mypicture"); ?>",
            'conMessage': "You are about to change your profile picture.",
            'redirect': ""
        }, save_upload);



        $('#formdata_confirm').on('click', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'action': "<?php echo admin_url("profile/method/edit_myinfo"); ?>",
            'id': "<?php echo $this->Misc->encode_id($row->id_user); ?>",
            'message': "You are about to update your information.",
            'redirect': "<?php echo admin_url("profile/view_profile_page"); ?>"
        }, load_dfltconfirmation);

    });
</script>	
<?php $this->load->view(admin_dir('template/footer')); ?>