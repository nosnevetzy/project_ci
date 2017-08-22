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
                    <th class="col-lg-2">Department Name
                        <div style="float: right;">
                            <a class="listasc" name='department_name' style="margin-right: 5px;" title='Ascending'><span class="fa fa-sort-amount-asc "></span></a>
                            <a class="listdesc" name='department_name' style="margin-right: 10px;" title='Descending'><span class="fa fa-sort-amount-desc"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">Department Code
                        <div style="float: right;">
                            <a class="listasc" name='department_code' style="margin-right: 5px;" title='Ascending'><span class="fa fa-sort-amount-asc "></span></a>
                            <a class="listdesc" name='department_code' style="margin-right: 10px;" title='Descending'><span class="fa fa-sort-amount-desc"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">Actions</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="department_name" placeholder="Search Department Name" />
                    </td>
                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="department_code" placeholder="Search Department Code" />
                    </td>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                if (!empty($rowcount['start']))
                    $i = $rowcount['start'] - 1;
                foreach ($list->result() as $department) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $department->department_name; ?>
                        </td>   
                        <td>
                            <?php echo $department->department_code; ?>
                        </td>  

                        <td>
                            <div class="controls center">
                                <!-- Access Links -->
                                <?php if ($this->Misc->accessible($this->access, 'departments', 'page', 'view_department')) : ?>
                                    <a href="<?php echo users_url("page/view_department/" . $this->Misc->encode_id($department->id_department)); ?>" title="<?php echo "View $department->department_name's Profile"; ?>"; style="text-decoration:none; margin-right: 10px;"class="tip view_department" >
                                        <span class="fa fa-search fa-lg"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($this->Misc->accessible($this->access, 'departments', 'page', 'edit_department')) : ?>
                                    <a href="<?php echo users_url("page/edit_department/" . $this->Misc->encode_id($department->id_department)); ?>" title="<?php echo "Edit $department->department_name's Profile"; ?>"; style="text-decoration:none; margin-right: 10px;"class="tip view_department" >
                                        <span class="fa fa-pencil fa-lg"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($this->Misc->accessible($this->access, 'departments', 'page', 'delete_department')) : ?>
                                    <a href="#dfltmodal" data-toggle="modal" class="tip delete_department" value='<?php echo $this->Misc->encode_id($department->id_department); ?>' title="<?php echo "Delete $department->department_name's Profile"; ?>" style="text-decoration:none; margin-right: 10px;">
                                        <span class="fa fa-remove fa-lg"></span>
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
                    <th class="col-lg-2">Department</th>
                </tr>
            </thead>
            <tbody >
                <?php
                $i = 0;
                if (!empty($rowcount['start']))
                    $i = $rowcount['start'] - 1;
                foreach ($list->result() as $department) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $department->department_name; ?>
                        </td>   
                        <td>
                            <?php echo $department->department_code; ?>
                        </td>  

                    </tr>
                <?php } if ($list->num_rows() == 0) { ?>
                    <tr>
                        <td valign="top" colspan="15" class="dataTables_empty">No matching records found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view(admin_dir('template/pagination')); ?>
</div>
