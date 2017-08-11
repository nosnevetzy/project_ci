<?php if (!empty($add)) { ?>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
            <h3>Add New Link</h3>
        </div>
        <div class="modal-body">
            <div class="row popformdata_alert"></div>
            <form class="form-horizontal form-label-left" novalidate>
                <div class="item form-group" id='div_popformdata_location'>
                    <label class="col-lg-3 control-label">* Location</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_location'>
                            <option value=''></option>
                            <option value='1'>Top</option>
                            <option value='2'>Side</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_name'>
                    <label class="col-lg-3 control-label">* Name</label>
                    <div class="col-lg-9">
                        <input type="text" class='form-control popformdata' id='popformdata_name' value=""/>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_external'>
                    <label class="col-lg-3 control-label">URL Source</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_external'>
                            <option value='0'>Internal</option>
                            <option value='1'>External</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_url'>
                    <label class="col-lg-3 control-label">* URL</label>
                    <div class="col-lg-9">
                        <input type="text" class='form-control popformdata' id='popformdata_url'/>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_icon'>
                    <label class="col-lg-3 control-label">Icon</label>
                    <div class="col-lg-9">
                        <input type="text" class='form-control popformdata' id='popformdata_icon' value=""/>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_parent'>
                    <label class="col-lg-3 control-label">Parent</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_parent'>
                            <option value='0'>Home</option>
                            <?php foreach ($parent_link as $q) { ?>
                                <option value='<?php echo $q->id_link; ?>'><?php echo $q->link_name; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_header'>
                    <label class="col-lg-3 control-label">Header</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_header'>
                            <option value='0'>No</option>
                            <option value='1'>Yes</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_newtab'>
                    <label class="col-lg-3 control-label">New Tab</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_newtab'>
                            <option value='0'>No</option>
                            <option value='1'>Yes</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
            </form>
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
                'action': "<?php echo admin_url("menu/method/add_link"); ?>",
                'item': "<?php echo $this->Misc->encode_id($id_user_type); ?>",
                'conMessage': "You are about to add new link.",
                'clear': true,
                'redirect': "<?php echo $redirect; ?>"
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
<?php } else if (!empty($edit)) {
    ?>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
            <h3>Edit Link</h3>
        </div>
        <div class="modal-body">
            <div class="row popformdata_alert"></div>
            <form class="form-horizontal" action="#" role="form">
                <div class="item form-group" id='div_popformdata_location'>
                    <label class="col-lg-3 control-label">* Location</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_location'>
                            <option value=''></option>
                            <option value='1' <?php echo ($row->link_location == 1) ? "selected" : ""; ?>>Top</option>
                            <option value='2' <?php echo ($row->link_location == 2) ? "selected" : ""; ?>>Side</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_name'>
                    <label class="col-lg-3 control-label">* Name</label>
                    <div class="col-lg-9">
                        <input type="text" class='form-control popformdata' id='popformdata_name' value="<?php echo $row->link_name; ?>"/>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_external'>
                    <label class="col-lg-3 control-label">URL Source</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_external'>
                            <option value='0' <?php echo ($row->link_external == 0) ? "selected" : ""; ?> >Internal</option>
                            <option value='1' <?php echo ($row->link_external == 1) ? "selected" : ""; ?> >External</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_url'>
                    <label class="col-lg-3 control-label">* URL</label>
                    <div class="col-lg-9">
                        <input type="text" class='form-control popformdata' id='popformdata_url' value="<?php echo $row->link_url; ?>" />
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_icon'>
                    <label class="col-lg-3 control-label">Icon</label>
                    <div class="col-lg-9">
                        <input type="text" class='form-control popformdata' id='popformdata_icon' value="<?php echo $row->link_icon; ?>"/>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_parent'>
                    <label class="col-lg-3 control-label">Parent</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_parent'>
                            <option value='0' <?php echo ($row->parent_link_id == 0) ? "selected" : ""; ?>>Home</option>
                            <?php foreach ($parent_link as $q) { ?>
                                <option value='<?php echo $q->id_link; ?>' <?php echo ($row->parent_link_id == $q->id_link) ? "selected" : ""; ?> ><?php echo $q->link_name; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_header'>
                    <label class="col-lg-3 control-label">Header</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_header'>
                            <option value='0' <?php echo ($row->link_head == 0) ? "selected" : ""; ?> >No</option>
                            <option value='1' <?php echo ($row->link_head == 1) ? "selected" : ""; ?> >Yes</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_newtab'>
                    <label class="col-lg-3 control-label">New Tab</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_newtab'>
                            <option value='0' <?php echo ($row->link_newtab == 0) ? "selected" : ""; ?> >No</option>
                            <option value='1' <?php echo ($row->link_newtab == 1) ? "selected" : ""; ?> >Yes</option>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group" id='div_popformdata_newtab'>
                    <label class="col-lg-3 control-label">Order</label>
                    <div class="col-lg-9">
                        <input type="text" class='form-control popformdata' id='popformdata_order' value="<?php echo $row->link_order; ?>"/>
                    </div>
                </div><!-- End .item form-group  -->
            </form>
        </div>
        <div class="modal-footer">
            <div class='right'>
                <button class="btn btn-warning ui-wizard-content ui-formwizard-button" id="popformdata_save" type="button">Save</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#popformdata_save').on('click', {
                'action': "<?php echo admin_url("menu/method/edit_link"); ?>",
                'id': "<?php echo $this->Misc->encode_id($row->id_link); ?>",
                'item': "<?php echo $this->Misc->encode_id($id_user_type); ?>",
                'conMessage': "You are about to edit this class.",
                'redirect': "<?php echo $redirect; ?>"
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

    <?php if ($row->link_location == 2) { ?>
                $('#div_popformdata_parent').show();
        <?php
    }
    if ($row->parent_link_id == 0 and $row->link_location == 2) {
        ?>
                $('#div_popformdata_header').show();
    <?php }
    ?>
        });
    </script>
<?php } else if (!empty($copy)) {
    ?>	
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
            <h3>Copy Link</h3>
        </div>
        <div class="modal-body">
            <div class="row popformdata_alert"></div>
            <form class="form-horizontal" action="#" role="form">
                <div class="item form-group">
                    <label class="col-lg-3 control-label">* Link From</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_from'>
                            <option value=''></option>
                            <?php foreach ($user_types as $q) { ?>
                                <option value='<?php echo $q->id_user_type; ?>'><?php echo $q->user_type; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
                <div class="item form-group">
                    <label class="col-lg-3 control-label">* Copy To</label>
                    <div class="col-lg-9">
                        <select class='form-control popformdata' id='popformdata_to'>
                            <option value=''></option>
                            <?php foreach ($user_types as $q) { ?>
                                <option value='<?php echo $q->id_user_type; ?>'><?php echo $q->user_type; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div><!-- End .item form-group  -->
            </form>
        </div>
        <div class="modal-footer">
            <div class='right'>
                <button class="btn btn-warning ui-wizard-content ui-formwizard-button" id="popformdata_save" type="button">Copy</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#popformdata_save').on('click', {
                'action': "<?php echo admin_url("menu/method/copy_link"); ?>",
                'redirect': "<?php echo $redirect; ?>"
            }, save_form);
        });
    </script>
<?php }
?>
<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->

