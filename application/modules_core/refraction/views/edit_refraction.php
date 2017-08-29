
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Edit IOP Measurement</h3>
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
                            <input type="text" class="popformdata form-control" id="popformdata_odsphere" value="<?php echo $row->od_sphere ?>">
                        </div>

                        <div class="col-sm-3">
                            <label>CYLINDER</label>
                            <input type="text" class="popformdata form-control" id="popformdata_odcylinder" value="<?php echo $row->od_cylinder ?>">
                        </div>

                        <div class="col-sm-3">
                            <label>AXIS</label>
                            <input type="text" class="popformdata form-control" id="popformdata_odaxis" value="<?php echo $row->od_axis ?>">
                        </div>

                        <div class="col-sm-3">
                            <label>PD</label>
                            <input type="text" class="popformdata form-control" id="popformdata_odpd" value="<?php echo $row->od_pd ?>">
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
                            <input type="text" class="popformdata form-control" id="popformdata_ossphere" value="<?php echo $row->os_sphere ?>">
                        </div>

                        <div class="col-sm-3">
                            <label>CYLINDER</label>
                            <input type="text" class="popformdata form-control" id="popformdata_oscylinder" value="<?php echo $row->os_cylinder ?>">
                        </div>

                        <div class="col-sm-3">
                            <label>AXIS</label>
                            <input type="text" class="popformdata form-control" id="popformdata_osaxis" value="<?php echo $row->os_axis ?>">
                        </div>

                        <div class="col-sm-3">
                            <label>PD</label>
                            <input type="text" class="popformdata form-control" id="popformdata_ospd" value="<?php echo $row->os_pd ?>">
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" id="popformdata_save" class="btn btn-success"> <i class="icon-add-to-list position-left"></i>Update Refraction</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#popformdata_save').on('click', {
            'action': "<?php echo refraction_url("page/method/edit_refraction"); ?>",
            'item': "<?php echo $this->misc->encode_id($row->id_refraction); ?>",
            'conMessage': "You are about to edit these details.",
            'clear': true,
            'redirect': "<?php echo patients_url("page/view_patient/$id_patient/refraction"); ?>"
        }, save_form);
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#popformdata_location').on('change', function () {
            var vals = $(this).val();
            if (vals == 2) {
                $('#div_popformdata_parent').show();
                if ($('#div_popformdata_parent').val() == 0) {
                    $('#div_popformdata_header').show();
                } else {
                    $('#div_popformdata_header').hide();
                }
            } else {
                $('#div_popformdata_parent').hide();
                $('#div_popformdata_header').hide();
            }
        });

        $('#popformdata_parent').on('change', function () {
            var vals = $(this).val();
            if (vals == 0) {
                $('#div_popformdata_header').show();
            } else {
                $('#div_popformdata_header').hide();
            }
        });

        $('#div_popformdata_parent').hide();
        $('#div_popformdata_header').hide();
    });
</script>

<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->

