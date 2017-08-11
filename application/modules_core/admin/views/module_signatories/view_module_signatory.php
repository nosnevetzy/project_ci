<?php $this->load->view(admin_dir('template/header'), $js_files); ?>
<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>View Module Signatory</h3>     
        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row">
            <div class="col-lg-12">	
                <div class='clearfix'>
                    <div class="right">
                        <a href="<?php echo admin_url('module_signatories/list_module_signatory'); ?>"><span class='icon16 icomoon-icon-arrow-left-5'></span> Back</a>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <span><?= $row->class_title; ?>'s Information</span>
                                </h4>
                            </div>
                            <div class="panel-body ">
                                <div class="row formdata_alert"></div>
                                <div class="row form-horizontal">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Module:</label>
                                            <div class="col-lg-5">
                                                <?php foreach ($classes as $q) { ?>
                                                    <b><?= ($q->id_class == $row->class_id) ? $q->class_title : ''; ?></b>
                                                <?php } ?>
                                            </div>
                                        </div><!-- End .form-group  -->
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label"> Department:</label>
                                            <div class="col-lg-5">
                                                <?php foreach ($departments as $q) { ?>
                                                    <b><?= ($q->id_department == $row->department_id) ? $q->department_name : ''; ?></b>
                                                <?php } ?>
                                            </div>
                                        </div><!-- End .form-group  -->
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">User:</label>
                                            <div class="col-lg-5">
                                                <?php foreach ($users as $q) { ?>
                                                    <b><?= ($q->id_user == $row->signatory_user_id) ? $q->user_fname . ' - ' . $q->user_lname : ''; ?></b>
                                                <?php }
                                                ?>
                                            </div>
                                        </div><!-- End .form-group  -->
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Signatory Level (of approval):</label>
                                            <div class="col-lg-5">
                                                <b><?= $row->signatory_level; ?></b>
                                            </div>
                                        </div><!-- End .form-group  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .panel -->
                </div><!-- End .row -->  
            </div><!-- End .span12 -->  
        </div><!-- End .row -->  
        <!-- Page end here -->
    </div><!-- End contentwrapper -->
</div><!-- End #content -->
<?php $this->load->view(admin_dir('template/footer')); ?>