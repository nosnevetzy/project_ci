
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Edit IOP Measurement</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal form-label-left" novalidate>
            <div class="item form-group">
                <div class="col-lg-12">
                    <table> 
                        <tr>
                            <th></th>
                            <th>SPHERE</th>
                            <th>CYLINDER</th>
                            <th>AXIS</th>
                            <th>PD</th>
                        </tr>
                        <tr>
                            <th>OD</th>
                            <th><input type="text" value="<?php echo $row->od_sphere ?>" class="popformdata form-control" id="popformdata_odsphere"></th>
                            <th><input type="text" value="<?php echo $row->od_cylinder ?>"class="popformdata form-control" id="popformdata_odcylinder"></th>
                            <th><input type="text" value="<?php echo $row->od_axis ?>"class="popformdata form-control" id="popformdata_odaxis"></th>
                            <th><input type="text" value="<?php echo $row->od_pd ?>"class="popformdata form-control" id="popformdata_odpd"></th>
                        </tr>
                        <tr>
                            <th>OS</th>
                            <th><input type="text" value="<?php echo $row->os_sphere ?>"class="popformdata form-control" id="popformdata_ossphere"></th>
                            <th><input type="text" value="<?php echo $row->os_cylinder ?>"class="popformdata form-control" id="popformdata_oscylinder"></th>
                            <th><input type="text" value="<?php echo $row->os_axis ?>"class="popformdata form-control" id="popformdata_osaxis"></th>
                            <th><input type="text" value="<?php echo $row->os_pd ?>"class="popformdata form-control" id="popformdata_ospd"></th>
                        </tr>
                    </table>          
                </div>
            </div><!-- End .item form-group  -->
    </div>
    <div class="modal-footer">
        <div class='right'>
            <button class="btn btn-success ui-wizard-content ui-formwizard-button" id="popformdata_save" type="button">Update</button>
        </div>
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

