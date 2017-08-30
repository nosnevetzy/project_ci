
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
        <h3>New IOP Measurement</h3>
    </div>
    <div class="modal-body">
        <div class="row popformdata_alert"></div>
        <form class="form-horizontal form-label-left" novalidate>
            <div class="item form-group">
                <div class="col-lg-12">
                    <textarea id="popformdata_iop"class="wysihtml5 wysihtml5-min form-control popformdata"> </textarea>
                </div>
            </div><!-- End .item form-group  -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" id="popformdata_save" class="btn bg-teal"> <i class="icon-add-to-list position-left"></i>Add</button>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#popformdata_save').on('click', {
            'action': "<?php echo iop_url("page/method/add_iop"); ?>",
            'item': "<?php echo ($id_patient); ?>",
            'conMessage': "You are about to add an IOP Measurement.",
            'clear': true,
            'redirect': "<?php echo patients_url("page/view_patient/$id_patient/iop");?>"
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

