<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Edit Department</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal" action="#" role="form">
            <div class="form-group">
                <label class="col-lg-4 control-label"> Department Name:</label>
                <div class="col-lg-8">
                    <b><?php echo $row->department_name; ?></b>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label"> Department Code:</label>
                <div class="col-lg-8">
                    <b><?php echo $row->department_code; ?></b>
                </div>
            </div><!-- End .form-group  -->
             <div class="form-group">
                <label class="col-lg-4 control-label"> Department Head:</label>
                <div class="col-lg-8">
                    <b><?php echo $row->user_fname.' '.$row->user_lname; ?></b>
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
        window.location.replace(adminURL + 'departments/list_department');
    }
</script>