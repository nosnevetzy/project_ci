<?php if ($list_count > 0) { ?>
    <div class='dataTables_wrapper form-inline uploadact'>
        <div class="row">
            <div class="col-lg-4">
                <div class="dataTables_info">Showing <?php echo $rowcount['start']; ?> to <?php echo $rowcount['end']; ?> of <?php echo $list_count; ?> <?php echo ($list_count > 1) ? "entries" : "entry"; ?></div>
            </div>
            <?php if ($max_page > 1) { ?>
                <div class="col-lg-8">
                    <div class="dataTables_paginate paging_bootstrap pagination">
                        <ul class="pagination">
                            <li><a value='1' class='listbutton hover'>First</a></li>
                            <li style="<?php
                            if ($button['prev'] == 0) {
                                echo 'display:none';
                            }
                            ?>">
                                <a value='<?php echo $button['prev']; ?>' class='listbutton hover' <?php ($button['prev'] == 0) ? "disabled" : "" ?>>
                                    <span class="fa fa-angle-left fa-lg"></span>
                                </a>
                            </li>
                            <?php for ($i = $button['start']; $i <= $button['end']; $i++) { ?>
                                <li class="<?php
                                if ($i == $page) {
                                    echo 'active';
                                }
                                ?>">
                                    <a value='<?php echo $i; ?>' class='listbutton hover <?php
                                    if ($i == $page) {
                                        echo 'active';
                                    }
                                    ?>'><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <li style="<?php
                            if ($button['next'] == 0) {
                                echo 'display:none';
                            }
                            ?>">
                                <a value='<?php echo $button['next']; ?>' class='listbutton hover'>
                                    <span class="fa fa-angle-right fa-lg"></span>
                                </a>
                            </li>
                            <li><a value='<?php echo $max_page; ?>' class='listbutton hover'>Last</a></li>
                        </ul>     
                    </div>
                </div>
            <?php } else { ?>
                <a value='1' class='listbutton hover listbutton_active display-none'>1</a>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        /* $(".datepicker").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: '+0d'});*/
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table');
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