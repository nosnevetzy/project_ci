<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>View Document Type</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal" action="#" role="form">
            <div class="form-group">
                <label class="col-lg-4 control-label"> Class Title:</label>
                <div class="col-lg-8">
                    <b><?php echo $row->class_title; ?></b>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label"> Document Type Name:</label>
                <div class="col-lg-8">
                    <b><?php echo $row->document_type_name; ?></b>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label"> Document Type Code:</label>
                <div class="col-lg-8">
                    <b><?php echo $row->document_type_code; ?></b>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label"> Multiplier:</label>
                <div class="col-lg-8">
                    <b><?php echo $row->multiplier; ?></b>
                </div>
            </div><!-- End .form-group  -->
        </form>
    </div>
    <div class="modal-footer">
        <div class='right'>
            <button class="btn btn-warning ui-wizard-content ui-formwizard-button" id="popformdata-back" type="button">Back</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function ()
    {
        jQuery(document).on('click', '#popformdata-back', backToList);
    });

    function backToList() {
        window.location.replace(adminURL + 'document_types/list_document_type');
    }
</script>