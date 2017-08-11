<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Add New Department</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal" action="#" role="form">
            <div class="form-group">
                <label class="col-lg-4 control-label">* Department Name</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-department_name' value=""/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label">* Department Code</label>
                <div class="col-lg-8">
                    <input type="text" class='form-control popformdata' id='popformdata-department_code' value=""/>
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-4 control-label"> Department Head</label>
                <div class="col-lg-8">
                    <select class='form-control popformdata' id='popformdata-department_head_id' >
                        <option value=''></option>
                        <?php foreach ($users as $q) { ?>
                            <option value='<?= $q->id_user; ?>'><?= $q->user_fname." ".$q->user_lname; ?></option>
                        <?php }
                        ?>
                    </select>
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
            'action': "<?php echo admin_url("departments/method/add_department"); ?>",
            'conMessage': "You are about to add new item brand.",
            'redirect': "<?php echo admin_url("departments/list_department"); ?>"
        }, save_form_v1);
    });
</script>	