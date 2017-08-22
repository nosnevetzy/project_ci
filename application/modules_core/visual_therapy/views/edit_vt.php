
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>Edit Visual Therapy</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal form-label-left" novalidate>
            <div class="item form-group" id='div_popformdata_location'>
                <div class="col-lg-12">
                    <textarea id="popformdata_vt"class="wysihtml5 wysihtml5-min form-control popformdata"><?php echo $row->visual_therapy ?> </textarea>
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
            'action': "<?php echo vt_url("page/method/edit_vt"); ?>",
            'item': "<?php echo $this->misc->encode_id($row->id_visual_therapy); ?>",
            'conMessage': "You are about to edit this visual therapy history.",
            'clear': true,
            'redirect': "<?php echo patients_url("page/view_patient/$id_patient/vt"); ?>"
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

