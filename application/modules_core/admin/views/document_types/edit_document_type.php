<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Edit Document Type</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal" action="#" role="form">
            <div class="form-group">
                <label class="col-lg-4 control-label">* Module Name</label>
                <div class="col-lg-5">
                    <select class='form-control popformdata' id='popformdata-class_id' >
                        <option value=''></option>
                        <?php foreach ($modules as $q) { ?>
                            <option value='<?= $q->id_class; ?>' <?= ($q->id_class == $row->class_id) ? 'Selected' : ''; ?> ><?= $q->class_title; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label">* Document Type Name</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-document_type_name' value="<?php echo $row->document_type_name; ?>"/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label">* Document Type Code</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-document_type_code' value="<?php echo $row->document_type_code; ?>"/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label">* Multiplier</label>
                <div class="col-lg-5">
                    <select class='form-control popformdata' id='popformdata-multiplier' >
                        <option value=''></option>
                        <option value='In' <?= ('In' == $row->multiplier) ? 'Selected' : ''; ?>>In</option>
                        <option value='Out' <?= ('Out' == $row->multiplier) ? 'Selected' : ''; ?>>Out</option>
                        <option value='None' <?= ('None' == $row->multiplier) ? 'Selected' : ''; ?>>None</option>
                    </select>
                </div>
            </div><!-- End .form-group  -->
        </form>
    </div>
    <div class="modal-footer">
        <div class='right'>
            <button class="btn btn-warning ui-wizard-content ui-formwizard-button" id="popformdata-save" type="button">Save</button>
        </div>
        <div class='right'>
            <button class="btn btn-warning ui-wizard-content ui-formwizard-button" id="popformdata-back" type="button">Back</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#popformdata-save').on('click', {
            'action': "<?php echo admin_url("document_types/method/edit_document_type"); ?>",
            'id': "<?php echo $this->Misc->encode_id($row->id_document_type); ?>",
            'conMessage': "You are about to edit document type."
        }, save_form_v1);
    });

    jQuery(function ()
    {
        jQuery(document).on('click', '#popformdata-back', backToList);
    });

    function backToList() {
        window.location.replace(adminURL + 'document_types/list_document_type');
    }
</script>