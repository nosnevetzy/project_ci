<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Edit Department</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal" action="#" role="form">
            <div class="form-group">
                <label class="col-lg-4 control-label">* Department Name</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-department_name' value="<?php echo $row->department_name; ?>"/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label">* Department Code</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-department_code' value="<?php echo $row->department_code; ?>"/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label"> Department Head</label>
                <div class="col-lg-8">
                    <select class='form-control popformdata' id='popformdata-department_head_id' >
                        <option value=''></option>
                        <?php foreach ($users as $q) { ?>
                            <option value='<?= $q->id_user; ?>' <?= ($row->department_head_id==$q->id_user)?'Selected':''; ?> ><?= $q->user_fname." ".$q->user_lname; ?></option>
                        <?php }
                        ?>
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
            'action': "<?php echo admin_url("departments/method/edit_department"); ?>",
            'id': "<?php echo $this->Misc->encode_id($row->id_department); ?>",
            'conMessage': "You are about to edit item brand."
        }, save_form_v1);
    });

    jQuery(function ()
    {
        jQuery(document).on('click', '#popformdata-back', backToList);
    });

    function backToList() {
        window.location.replace(adminURL + 'departments/list_department');
    }
</script>