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

                    <th class="col-lg-2">Code
                        <div style="float: right;">
                            <a class="listasc" name='user_code' title='Ascending'><span class="icon-arrow-up5 text-slate-700"></span></a>
                            <a class="listdesc" name='user_code' title='Descending'><span class="icon-arrow-down5 text-slate-700"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">Name
                        <div style="float: right;">
                            <a class="listasc" name='user_name' title='Ascending'><span class="icon-arrow-up5 text-slate-700"></span></a>
                            <a class="listdesc" name='user_name' title='Descending'><span class="icon-arrow-down5 text-slate-700"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">User Type
                        <div style="float: right;">
                            <a class="listasc" name='user_type' title='Ascending'><span class="icon-arrow-up5 text-slate-700"></span></a>
                            <a class="listdesc" name='user_type' title='Descending'><span class="icon-arrow-down5 text-slate-700"></span></a>
                        </div>
                    </th>
                    <th class="col-lg-2">Department
                        <div style="float: right;">
                            <a class="listasc" name='department_name' title='Ascending'><span class="icon-arrow-up5 text-slate-700"></span></a>
                            <a class="listdesc" name='department_name' title='Descending'><span class="icon-arrow-down5 text-slate-700"></span></a>
                        </div>
                    </th>


                    <th class="col-lg-2">Actions</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="user_code" placeholder="Search Code" />
                    </td>
                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="user_name" placeholder="Search Name" />
                    </td>

                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="user_type" placeholder="Search User Type" />
                    </td>

                    <td>
                        <input type="text" class="listsearch form-control col-lg-12 uniform-input" id="department_name" placeholder="Search Department" />
                    </td>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
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
                        <td>
                            <?php echo $user->department_name; ?>
                        </td>
                        <td>
                            <div class="controls center">
                                <!-- Access Links -->
                                <?php if ($this->Misc->accessible($this->access, 'users', 'page', 'view_user')) : ?>
                                    <a href="<?php echo admin_url("user/view_user/" . $this->Misc->encode_id($user->id_user)); ?>" title="<?php echo "View $user->user_name's Profile"; ?>"; style="text-decoration:none; margin-right: 10px;"class="tip view_user" >
                                        <span class="icon-search4 text-slate-700"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($this->Misc->accessible($this->access, 'users', 'page', 'edit_user')) : ?>
                                    <a href="<?php echo admin_url("user/edit_user/" . $this->Misc->encode_id($user->id_user)); ?>" title="<?php echo "Edit $user->user_name's Profile"; ?>"; style="text-decoration:none; margin-right: 10px;"class="tip view_user" >
                                        <span class="icon-pencil text-slate-700"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($this->Misc->accessible($this->access, 'users', 'page', 'delete_user')) : ?>
                                    <a href="#dfltmodal" data-toggle="modal" class="tip delete_user" value='<?php echo $this->Misc->encode_id($user->id_user); ?>' title="<?php echo "Delete $user->user_name's Profile"; ?>" style="text-decoration:none; margin-right: 10px;">
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
                    <?php
                    foreach ($this->list_content as $col_name => $var) {
                        if ($var['type'] != 'hidden') {
                            ?>
                            <th class="<?= $var['class']; ?>"><?= $var['label']; ?></th>
                        <?php } ?>
                    <?php } ?>
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
                        <?php
                        foreach ($this->list_content as $col_name => $val) {
                            $output = '';
                            $id = ($col_name == 'id') ? $user->{$val['var-value']} : $id;
                            if ($val['type'] == 'datepicker') {
                                $output .= date('M d, Y', strtotime($user->{$val['var-value']}));
                            } else {
                                $output .= $user->{$val['var-value']};
                            }
                            if ($val['type'] != 'hidden') {
                                ?>
                                <td>
                                    <?php echo $output; ?>
                                </td>
                                <?php
                            }
                        }
                        ?>
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
