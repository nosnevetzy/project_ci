<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-key mr-5"></i> User Access</span>
                </h5>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <a class="text-white" href="<?php echo admin_url('user/list_user'); ?>"><i class="icon-undo position-left">
                    <button type="button" class="btn bg-teal-400">
                        </i> Back to list
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <form class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="actionformdata_usertype">User Type<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control actionformdata col-md-7 col-xs-12" id='actionformdata_usertype'>
                                    <option></option>
                                    <?php foreach ($user_types as $q) { ?>
                                        <option value='<?php echo $q->id_user_type; ?>'><?php echo $q->user_type; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div><!-- End .form-group  -->
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="actionformdata_usertype">Class<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control actionformdata col-md-7 col-xs-12" id='actionformdata_class'>
                                    <option value='0'>All</option>
                                    <?php foreach ($classes as $q) { ?>
                                        <option value='<?php echo $q->id_class; ?>'><?php echo $q->class_title; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div><!-- End .form-group  -->
                    </form>
                </div><!-- end of .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of div -->
        <div id="containerList"></div>
    </div><!-- end of .right_col -->

<script type="text/javascript">
    $(document).ready(function () {
        // load_datalist({action: "<?php echo admin_url('user/method/list_division'); ?>"});

        //Link
        $('.actionformdata').on('change', {
            'action': "<?php echo admin_url("user/method/list_classfunction"); ?>",
            'formdata': true,
            'resulttohtml': "#containerList"
        }, load_dfltaction);

        $("#containerList").on('change', '.changeaccess', {
            'action': "<?php echo admin_url('user/method/change_access'); ?>",
            'getElementValue': {'usertype': '#actionformdata_usertype'},
            'checkbox': true
        }, load_dfltaction);


    });
</script>
<?php $this->load->view(admin_dir('template/footer')); ?>