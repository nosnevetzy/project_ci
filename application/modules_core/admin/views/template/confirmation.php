<!-- <div class="modal-content">
    <div class="modal-header" style="border-top:1px solid #C4C4C4; padding:0;border-radius:6px 6px 0 0;">
        <button type="button" class="close modal_close" data-dismiss="modal" style="margin-top: 12px;margin-right: 12px;"><span class="icon16 minia-icon-close"></span></button>
        <h3>&nbsp;</h3>
    </div>
    <div class="modal-body alert_color">
        <div class="row formdata_alert"></div>
        <span class="confirmation_message"><?= $message ?></span>
    </div>
    <div class="modal-footer">
        <div class='center'>
            <button class="btn btn-success ui-wizard-content ui-formwizard-button" id="formdata_save" type="button">Confirm</button>
            <button class="btn btn-default ui-wizard-content ui-formwizard-button" data-dismiss="modal" id="formdata_back" type="button">Cancel</button>

        </div>
    </div>
</div> -->
<div class="modal-content">


    <div class="modal-body">
        <div>    
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>

        <div class="clearfix"></div>
        <p style="font-size: 15px;"><?= $message ?></p>

        <div style="text-align:right;">
            <button type="button" class="btn btn-primary" id="formdata_save">Confirm</button>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#formdata_save').on('click', {
            'id': "<?php echo $id ?>",
            'item': "<?php echo $item ?>",
            'action': "<?php echo $action ?>",
            'redirect': "<?php echo $redirect ?>"
        }, save_default_form);
    });
</script>
<!--<script type="text/javascript" src="<?php echo assets_dir("js/form.js"); ?>"></script>
<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script> -->
