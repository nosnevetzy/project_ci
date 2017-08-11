<?php $this->load->view(admin_dir('template/header'), $js_files); ?>
<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Add New Module Signatory</h3>     
        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row">
            <div class="col-lg-12">	
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    <span>Module Signatory Information</span>
                                </h4>
                            </div>
                            <div class="panel-body ">
                                <div class="row formdata_alert"></div>
                                <div class="row form-horizontal">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">* Module</label>
                                            <div class="col-lg-5">
                                                <select class='form-control formdata chosen' id='formdata-class_id' >
                                                    <option value=''></option>
                                                    <?php foreach ($classes as $q) { ?>
                                                        <option value='<?= $q->id_class; ?>'><?= $q->class_title; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><!-- End .form-group  -->
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label"> Department</label>
                                            <div class="col-lg-5">
                                                <select class='form-control formdata chosen' id='formdata-department_id' >
                                                    <option value=''></option>
                                                    <?php foreach ($departments as $q) { ?>
                                                        <option value='<?= $q->id_department; ?>'><?= $q->department_name; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><!-- End .form-group  -->
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">* User</label>
                                            <div class="col-lg-5">
                                                <select class='form-control formdata chosen' id='formdata-signatory_user_id' >
                                                    <option value=''></option>
                                                    <?php foreach ($users as $q) { ?>
                                                        <option value='<?= $q->id_user; ?>'><?= $q->user_fname . ' - ' . $q->user_lname . ' [ ' . $q->user_type . ' ] '; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><!-- End .form-group  -->
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">* Signatory Level (of approval)</label>
                                            <div class="col-lg-5">
                                                <span> 0: Cancel, 1: 1st Level Approval, 2: 2nd Level Approval,3: 3rd Level Approval,4:Transaction Remarks,5: Generate PO;  6: Close (Completion)</span>
                                                <input type="number" min="0" max="6" class="form-control formdata" id="formdata-signatory_level" style="width: 402px"/>
                                            </div>
                                        </div><!-- End .form-group  -->
                                        <div class="form-group">
                                            <div class="col-lg-offset-4 col-lg-8">
                                                <button  class="btn btn-success ui-wizard-content ui-formwizard-button" id='formdata-save' type="button">Add</button>
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