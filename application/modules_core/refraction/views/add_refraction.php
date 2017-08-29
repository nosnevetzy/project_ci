
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3><i class=" icon-add-to-list"></i> New Refraction</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal form-label-left" novalidate>
            <fieldset class="content-group">
                <legend class="text-bold">OD</legend>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>SPHERE</label>
                            <input type="text" class="popformdata form-control" id="popformdata_odsphere">
                        </div>

                        <div class="col-sm-3">
                            <label>CYLINDER</label>
                            <input type="text" class="popformdata form-control" id="popformdata_odcylinder">
                        </div>

                        <div class="col-sm-3">
                            <label>AXIS</label>
                            <input type="text" class="popformdata form-control" id="popformdata_odaxis">
                        </div>

                        <div class="col-sm-3">
                            <label>PD</label>
                            <input type="text" class="popformdata form-control" id="popformdata_odpd">
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="content-group">
                <legend class="text-bold">OS</legend>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>SPHERE</label>
                            <input type="text" class="popformdata form-control" id="popformdata_ossphere">
                        </div>

                        <div class="col-sm-3">
                            <label>CYLINDER</label>
                            <input type="text" class="popformdata form-control" id="popformdata_oscylinder">
                        </div>

                        <div class="col-sm-3">
                            <label>AXIS</label>
                            <input type="text" class="popformdata form-control" id="popformdata_osaxis">
                        </div>

                        <div class="col-sm-3">
                            <label>PD</label>
                            <input type="text" class="popformdata form-control" id="popformdata_ospd">
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" id="popformdata_save" class="btn btn-success"> <i class="icon-add-to-list position-left"></i>Add Refraction</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#popformdata_save').on('click', {
            'action': "<?php echo refraction_url("page/method/add_refraction"); ?>",
            'item': "<?php echo ($id_patient); ?>",
            'conMessage': "You are about to add these details.",
            'clear': true,
            'redirect': "<?php echo patients_url("page/view_patient/$id_patient/refraction"); ?>"
        }, save_form);
    });
</script>

<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->

