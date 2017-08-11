<?php $this->load->view(admin_dir('template/header')); ?>
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">
            <h3>Manage Company Access</h3>                    
        </div><!-- End .heading-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <span>Company Access</span>
                        </h4>
                    </div><!-- End .panel-heading -->
                    <div class="panel-body">
                        <div class="row form-horizontal">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" >* User Type</label>
                                    <div class="col-lg-4">
                                        <select class="form-control actionformdata" id='actionformdata_usertype'>
                                            <option></option>
                                            <?php foreach ($user_types as $q) { ?>
                                                <option value='<?php echo $q->id_user_type; ?>'><?php echo $q->user_type; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div><!-- End .form-group  -->

                            </div>	
                        </div>
                        <div class="row form-horizontal" id='containerList'>
                        </div>

                    </div>	

                </div><!-- End .panel -->
            </div><!-- End .span12 -->  
        </div><!-- End .row -->  
        <!-- Page end here -->       
    </div><!-- End contentwrapper -->
</div><!-- End #content -->
<script type="text/javascript">
    $(document).ready(function () {
        // load_datalist({action: "<?php echo admin_url('user/method/list_division'); ?>"});

        //Link
        $('.actionformdata').on('change', {
            'action': "<?php echo admin_url("user/method/list_company"); ?>",
            'formdata': true,
            'resulttohtml': "#containerList",
        }, load_dfltaction);

        $("#containerList").on('change', '.changeaccess', {
            'action': "<?php echo admin_url("user/method/change_company_access"); ?>",
            'getElementValue': {"usertype": "#actionformdata_usertype"},
            'checkbox': true
        }, load_dfltaction);
    });
</script>
<?php $this->load->view(admin_dir('template/footer')); ?>