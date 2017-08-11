<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Edit Item Brand</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal" action="#" role="form">
            <div class="form-group">
                <label class="col-lg-4 control-label">* Item Brand Name</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-item_brand_name' value="<?php echo $row->item_brand_name; ?>"/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label">* Item Brand Code</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-item_brand_code' value="<?php echo $row->item_brand_code; ?>"/>
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
            'action': "<?php echo admin_url("item_brands/method/edit_item_brand"); ?>",
            'id': "<?php echo $this->Misc->encode_id($row->id_item_brand); ?>",
            'conMessage': "You are about to edit item brand."
        }, save_form_v1);
    });

    jQuery(function ()
    {
        jQuery(document).on('click', '#popformdata-back', backToList);
    });

    function backToList() {
        window.location.replace(adminURL + 'item_brands/list_item_brand');
    }
</script>