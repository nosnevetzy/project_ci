
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>New Refraction</h3>
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
                            <th><input type="text" class="popformdata form-control" id="popformdata_odsphere"></th>
                            <th><input type="text" class="popformdata form-control" id="popformdata_odcylinder"></th>
                            <th><input type="text" class="popformdata form-control" id="popformdata_odaxis"></th>
                            <th><input type="text" class="popformdata form-control" id="popformdata_odpd"></th>
                        </tr>
                        <tr>
                            <th>OS</th>
                            <th><input type="text" class="popformdata form-control" id="popformdata_ossphere"></th>
                            <th><input type="text" class="popformdata form-control" id="popformdata_oscylinder"></th>
                            <th><input type="text" class="popformdata form-control" id="popformdata_osaxis"></th>
                            <th><input type="text" class="popformdata form-control" id="popformdata_ospd"></th>
                        </tr>
                    </table>
                </div>
            </div><!-- End .item form-group  -->
    </div>
    <div class="modal-footer">
        <div class='right'>
            <button class="btn btn-success ui-wizard-content ui-formwizard-button" id="popformdata_save" type="button">Add</button>
        </div>
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

