<div class="col-sm-12">
    <div class='dataTables_wrapper'>
        <div class="row">
            <div class="col-lg-4 dataTables_wrapper form-inline dt-bootstrap no-footer">
                <!-- <div class="dataTables_length">
                    <label>Show<select class="col-lg-6 listdisplay form-control input-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>entries</label>
                    <input type='hidden' class='listsort'>
                </div> -->
                <div class="dataTables_length" id="datatable-fixed-header_length"><label>Show <select class="listdisplay form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label><input type='hidden' class='listsort'></div>
            </div>
        </div>
    </div>
    <div class='dataTables_wrapper'>
        <table class="table" id="checkAll">
            <thead>
                <tr>
                    <th class="col-lg-1">#</th>
                    <?php
                    foreach ($this->list_content as $col_name => $var) {
                        if ($var['type'] != 'hidden') {
                            ?>
                            <th class="<?= $var['class']; ?>"><?= $var['label']; ?>
                               <!--   <div style="float: right;">
                                 <img class='listasc' name='<?= $var['var-value']; ?>' title='Ascending' src='<?php echo images_dir('up.gif'); ?>'>&nbsp;
                                <img class='listdesc' name='<?= $var['var-value']; ?>' title='Descending' src='<?php echo images_dir('down.gif'); ?>'> 
                                </div> -->
                                <div style="float: right;">
                                <a class="listasc" name='<?= $var['var-value']; ?>' style="margin-right: 5px;" title='Ascending'><span class="fa fa-sort-amount-asc "></span></a>
                                <a class="listdesc" name='<?= $var['var-value']; ?>' style="margin-right: 10px;" title='Descending'><span class="fa fa-sort-amount-desc"></span></a>
                                </div>
                            </th>
                            <?php
                        }
                    }
                    ?>
                    <th class="col-lg-2">Actions</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <?php
                    foreach ($this->list_content as $col_name => $var) {
                        if ($var['type'] != 'hidden') {
                            ?>
                            <?php if ($var['type'] == 'text') { ?>
                                <td>
                                    <input type="<?= $var['type']; ?>" class="listsearch form-control <?= $var['type-class']; ?>" id="<?= $var['var-value']; ?>" placeholder="<?= $var['label']; ?>" />
                                </td>
                            <?php } ?>
                            <?php if ($var['type'] == 'datepicker') { ?>
                                <td>
                                    <input type="text" class="datepicker listsearch uniform-input text <?= $var['type-class']; ?>" id="<?= $var['var-value']; ?>" placeholder="<?= $var['label']; ?>" />
                                </td>
                            <?php } ?>
                            <?php
                        }
                    }
                    ?>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody >
                <?php
                $i = 0;
                if (!empty($rowcount['start']))
                    $i = $rowcount['start'] - 1;
                foreach ($list->result() as $q) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <?php
                        foreach ($this->list_content as $col_name => $val) {
                            $output = '';
                            $id = ($col_name == 'id') ? $q->{$val['var-value']} : $id;
                            if ($val['type'] == 'datepicker') {
                                $output .= date('M d, Y', strtotime($q->{$val['var-value']}));
                            } else {
                                $output .= $q->{$val['var-value']};
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
                        <td>
                            <div class="controls center">
                                <!-- Access Links -->
                                <?php
                                foreach ($this->access as $classname => $val) {
                                    if (!empty($val['method'])) {
                                        foreach ($val['method'] as $method_name => $v) {
                                            if ($this->Misc->accessible($this->access, $this->classname, 'method', $method_name)) { // check if permitted
                                                //output would be classname in singular form
                                                $format_function = '_' . strtolower(trim(str_replace(' ', '_', $this->function_name)));
                                                //get function to differentiate if view, edit, delete, print etc.
                                                $function = strtolower(str_replace($format_function, '', $method_name));
                                                ?>
                                                <?php if (($function == "view") && ($classname == $this->function_name)) { ?>
                                                    <a href="<?php echo admin_url("$this->classname/$method_name/" . $this->Misc->encode_id($id)); ?>" title="<?= $val['title'][$method_name] ?>" style="text-decoration:none; margin-right: 10px;"class="tip <?= $method_name; ?>" >
                                                        <span class="fa fa-search fa-lg"></span>
                                                    </a>
                                                    <?php
                                                }
                                                ?>

                                                <?php if (($function == "edit") && ($classname == $this->function_name)) { ?>
                                                    <a href="<?php echo admin_url("$this->classname/$method_name/" . $this->Misc->encode_id($id)); ?>" title="<?= $val['title'][$method_name]; ?>" style="text-decoration:none; margin-right: 10px;"class="tip <?= $method_name; ?>" >
                                                        <span class="fa fa-pencil fa-lg"></span>
                                                    </a>
                                                    <?php
                                                }
                                                ?>


                                                <?php if (($function == "delete") && ($classname == $this->function_name)) { ?>
                                                    <a href="#dfltmodal"  data-toggle="modal" class="tip <?= $method_name ?>" value='<?php echo $this->Misc->encode_id($id); ?>' title="<?= $val['title'][$method_name]; ?>" style="text-decoration:none; margin-right: 10px;">
                                                        <span class="fa fa-remove fa-lg"></span>
                                                    </a>
                                                <?php } ?>
                                                <?php
                                            }
                                        }
                                    }
                                    if (!empty($val['page'])) {
                                        foreach ($val['page'] as $method_name => $v) {
                                            if ($this->Misc->accessible($this->access, $this->classname, 'page', $method_name)) {
                                                //output would be classname in singular form
                                                $format_function = '_' . strtolower(trim(str_replace(' ', '_', $this->function_name)));
                                                //get function to differentiate if view, edit, delete, print etc.
                                                $function = strtolower(str_replace($format_function, '', $method_name));
                                                if (($function == 'print') && ($classname == $this->classname)) {
                                                    ?>
                                                    <a target="blank" href="<?php echo admin_url("$this->classname/$method_name/" . $this->Misc->encode_id($id)); ?>" title="Print <?= $this->function_name; ?>" class="tip <?= $method_name; ?>" >
                                                        <span class="con16 icomoon-icon-print"></span>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                if (count($list) == 0) {
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
                foreach ($list->result() as $q) {
                    $i++;
                    ?>
                    <tr>
                        <?php
                        foreach ($this->list_content as $col_name => $val) {
                            $output = '';
                            $id = ($col_name == 'id') ? $q->{$val['var-value']} : $id;
                            if ($val['type'] == 'datepicker') {
                                $output .= date('M d, Y', strtotime($q->{$val['var-value']}));
                            } else {
                                $output .= $q->{$val['var-value']};
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
                if (count($list) == 0) {
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
<script type="text/javascript">

    $(document).ready(function () {
       /* $(".datepicker").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: '+0d'});*/
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }

<?php if (!empty($search)) foreach ($search as $var => $val) { ?>
                $('#<?php echo $var; ?>').val('<?php echo $val; ?>');
    <?php } ?>
<?php if (!empty($sort)) { ?>
            $('.listsort').addClass('list<?php echo $sort['sort_type']; ?>');
            $('.listsort').attr('name', '<?php echo $sort['sort_by']; ?>');
<?php } ?>
<?php if (!empty($display)) { ?>
            $('.listdisplay').val('<?php echo $display; ?>');
<?php } ?>
    });
</script>