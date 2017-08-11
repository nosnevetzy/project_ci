<div class="panel-body noPad ">
    <div class='dataTables_wrapper form-inline'>
        <div class="row">
            <div class="col-lg-4">
                <div class="dataTables_length">
                    <select class="col-lg-6 listdisplay">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <input type='hidden' class='listsort'>
                </div>
            </div>
        </div>
    </div>
    <div class='dataTables_wrapper form-inline'>	
        <table class="table" id="checkAll">
            <thead>
                <tr>
                    <th class="col-lg-2">#</th>
                    <th class="col-lg-4">
                        User Type&nbsp;
                        <img class='listasc' name='user_type' title='Ascending' src='<?php echo images_dir('up.gif'); ?>'>&nbsp;
                        <img class='listdesc' name='user_type' title='Descending' src='<?php echo images_dir('down.gif'); ?>'>
                    </th>
                    <th class="col-lg-3">Actions</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>
                        <input type="text" class="listsearch col-lg-12" id='user_type' placeholder='Search User Type' />
                    </th>
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
                        <td><?php echo $i; ?></td>
                        <td class='blue'><?php echo $q->user_type; ?></td>
                        <td>
                            <div class="controls center">
                                <!-- Access Links -->
                                <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'edit_usertype')) { ?>
                                    <a data-toggle="modal" href="#dfltmodal" title="Edit User Type" class="tip editusertype" value='<?php echo $this->Misc->encode_id($q->id_user_type); ?>'><span class="icon16 icomoon-icon-pencil"></span></a>
                                <?php }
                                ?>
                                <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'delete_usertype')) { ?>
                                    <a href="#" title="Delete User Type" class="tip deleteusertype" value='<?php echo $this->Misc->encode_id($q->id_user_type); ?>'><span class="icon16 icomoon-icon-remove"></span></a>
                                <?php }
                                ?>

                            </div>
                        </td>
                    </tr>
                    <?php
                }
                if ($list->num_rows == 0) {
                    ?>
                    <tr>
                        <td valign="top" colspan="3" class="dataTables_empty">No matching records found</td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>	
    <?php $this->load->view(admin_dir('template/pagination')); ?>
</div>	
<script type="text/javascript">
    $(document).ready(function () {
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
<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->