<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Add New Item Brand</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal" action="#" role="form">
            <div class="form-group">
                <label class="col-lg-4 control-label">* Item Brand Name</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-item_brand_name' value=""/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label">* Item Brand Code</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-item_brand_code' value=""/>
                </div>
            </div><!-- End .form-group  -->
        </form>
    </div>
    <div class="modal-footer">
        <div class='right'>
            <button class="btn btn-success ui-wizard-content ui-formwizard-button" id="popformdata-save" type="button">Add</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#popformdata-save').on('click', {
            'action': "<?php echo admin_url("item_brands/method/add_item_brand"); ?>",
            'conMessage': "You are about to add new item brand.",
            'redirect': "<?php echo admin_url("item_brands/list_item_brand"); ?>"
        }, save_form_v1);
    });
</script>	