<div class="col-sm-12">
    <div class='dataTables_wrapper'>
        <div class="row">
            <div class="col-lg-4 dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="" id="datatable-fixed-header_length"><label>Show 
                        <select class="listdisplay form-control input-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> entries</label>
                    <input type='hidden' class='listsort'>
                </div>
            </div>
        </div>
    </div>
    <div class='dataTables_wrapper'>
        <table class="table" id="checkAll">
            <thead>
                <tr>
                    <th class="col-lg-1">#</th>
                    <th class="col-lg-2">First Name
                        <div style="float: right;">
                            <a class="listasc" name='patient_fname' title='Ascending'><span class="icon-arrow-up5 text-slate-700"></span></a>
                            <a class="listdesc" name='patient_fname' title='Descending'><span class="icon-arrow-down5 text-slate-700"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">Last Name
                        <div style="float: right;">
                            <a class="listasc" name='patient_lname' title='Ascending'><span class="icon-arrow-up5 text-slate-700"></span></a>
                            <a class="listdesc" name='patient_lname' title='Descending'><span class="icon-arrow-down5 text-slate-700"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">Gender
                        <div style="float: right;">
                            <a class="listasc" name='patient_gender' title='Ascending'><span class="icon-arrow-up5 text-slate-700"></span></a>
                            <a class="listdesc" name='patient_gender' title='Descending'><span class="icon-arrow-down5 text-slate-700"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">Actions</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="patient_fname" placeholder="Search First Name" />
                    </td>
                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="patient_lname" placeholder="Search Last Name" />
                    </td>

                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="patient_gender" placeholder="Search Gender" />
                    </td>

                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                if (!empty($rowcount['start']))
                    $i = $rowcount['start'] - 1;
                foreach ($list->result() as $patient) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $patient->patient_fname; ?>
                        </td>   
                        <td>
                            <?php echo $patient->patient_lname; ?>
                        </td>  
                        <td>
                            <?php echo $patient->patient_gender; ?>
                        </td> 
                    
                        <td>
                            <div class="controls center">
                                <!-- Access Links -->
                                <?php if ($this->Misc->accessible($this->access, 'users', 'page', 'view_user')) : ?>
                                <a href="<?php echo patients_url("page/view_patient/" . $this->Misc->encode_id($patient->id_patient)); ?>" title="<?php echo "View $patient->patient_fname's Profile"; ?>"; style="text-decoration:none; margin-right: 10px;"class="tip view_user" >
                                        <span class="icon-search4 text-slate-700"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($this->Misc->accessible($this->access, 'users', 'page', 'edit_user')) : ?>
                                    <a href="<?php echo patients_url("page/edit_patient/" . $this->Misc->encode_id($patient->id_patient)); ?>" title="<?php echo "Edit $patient->patient_fname's Profile"; ?>"; style="text-decoration:none; margin-right: 10px;"class="tip view_user" >
                                        <span class="icon-pencil text-slate-700"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($this->Misc->accessible($this->access, 'users', 'page', 'delete_user')) : ?>
                                    <a href="#dfltmodal" data-toggle="modal" class="tip delete_patient" value='<?php echo $this->Misc->encode_id($patient->id_patient); ?>' title="<?php echo "Delete $patient->patient_fname's Profile"; ?>" style="text-decoration:none; margin-right: 10px;">
                                        <span class="icon-trash text-slate-700"></span>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </td>
                    </tr>
                    <?php
                }
                if ($list->num_rows() == 0) {
                    ?>
                    <tr>
                        <td valign="top" colspan="15" class="dataTables_empty">No matching records found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table class="table generate hidden" id="checkAll">
            <thead>
                <tr>
                    <th class="col-lg-1">#</th>
                    <th class="col-lg-2">Code</th>
                    <th class="col-lg-2">Name</th>
                    <th class="col-lg-2">User Type</th>
<!--                    <th class="col-lg-2">Department</th>-->
                    <th class="col-lg-2">Actions</th>
                </tr>
            </thead>
            <tbody >
                <?php
                $i = 0;
                if (!empty($rowcount['start']))
                    $i = $rowcount['start'] - 1;
                foreach ($list->result() as $user) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $user->user_code; ?>
                        </td>   
                        <td>
                            <?php echo $user->user_name; ?>
                        </td>  
                        <td>
                            <?php echo $user->user_type; ?>
                        </td> 
    <!--                        <td>
                        <?php echo $user->department_name; ?>
                        </td>-->

                    </tr>
                    <?php
                }
                if ($list->num_rows() == 0) {
                    ?>
                    <tr>
                        <td valign="top" colspan="15" class="dataTables_empty">No matching records found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view(admin_dir('template/pagination')); ?>
</div>
