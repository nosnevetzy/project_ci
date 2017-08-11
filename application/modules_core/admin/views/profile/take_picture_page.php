<?php $this->load->view(admin_dir('template/header'));
$row = $result;
?>
<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Update Profile Picture</h3>     
        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <span>Take Picture</span>
                                </h4>
                            </div>
                            <div class="panel-body ">
                                <div class="row formcam_alert"></div>
                                <div class="row form-horizontal">
                                    <div class="col-lg-4">
                                        <div class="well">
                                            <video id="video" width="314" height="223" autoplay></video>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="well">
                                            <canvas id="formcam_canvas" width="314" height="223" ></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-horizontal">
                                    <div class="col-lg-4">
                                        <button  class="btn btn-success ui-wizard-content ui-formwizard-button" id='formcam_snap' type="button">Take a Picture</button>
                                    </div>
                                    <div class="col-lg-4">
                                        <button class="btn btn-info ui-wizard-content ui-formwizard-button display-none" id="formcam_save" type="button">Save Picture</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .panel -->
                </div><!-- End .row -->  	
            </div><!-- End .span12 -->  
        </div><!-- End .row -->  
        <!-- Page end here -->
    </div><!-- End contentwrapper -->
</div><!-- End #content -->
<script type="text/javascript">
    $(document).ready(function () {
        load_camera();


        $('#formcam_save').on('click', {
            'action': "<?php echo admin_url("profile/method/upload_mypicture"); ?>",
            'conMessage': "You are about to change your profile picture."
        }, save_camera);

    });
</script>	
<?php $this->load->view(admin_dir('template/footer')); ?>