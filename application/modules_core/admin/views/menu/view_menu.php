<?php $this->load->view(admin_dir('template/header')); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div id="clearflash">
        <div class="page-title">
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Menu for <?php echo $row->user_type; ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown" style="float: right;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench fa-2x"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if ($this->Misc->accessible($this->access, 'menu', 'method', 'add_link')) { ?>
                                    <li style="padding: 5px 10px;"><a data-toggle="modal" href="#dfltmodallg" class="addlink"><span class="icomoon-icon-plus"></span> Add New Link</a></li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    </ul> 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-lg-1">#</th>
                                <th class="col-lg-3">Name</th>
                                <th class="col-lg-3">Url</th>
                                <th class="col-lg-3">Attributes</th>
                                <th class="col-lg-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr class='warning'>
                                <th colspan='5'>TOP MENU</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($topmenu as $q) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $q->link_order; ?> </td>
                                    <td><span class='icon16 <?php echo $q->link_icon; ?>'></span> <?php echo $q->link_name; ?></td>
                                    <td><?php echo ($q->link_external == 0) ? admin_url($q->link_url) : $q->link_url; ?></td>
                                    <td>
                                        <?php
                                        $attr = '';
                                        $attr.=($attr != '') ? " | " : "" . ($q->link_newtab == 1) ? "New Tab" : "";
                                        $attr.=($attr != '') ? " | " : "" . ($q->link_external == 1) ? "External Link" : "";
                                        $attr.=($attr != '') ? " | " : "" . ($q->link_head == 1) ? "Head Link" : "";
                                        echo "<small>" . $attr . "</small>";
                                        ?>
                                    </td>
                                    <td>
                                        <!-- Access Links -->
                                        <?php if ($this->Misc->accessible($this->access, 'menu', 'method', 'edit_link')) { ?>
                                            <a data-toggle="modal" href="#dfltmodallg" title="Edit Link" class="tip editlink" value='<?php echo $this->Misc->encode_id($q->id_link); ?>'><span class="fa fa-pencil fa-lg"></span></a>
                                            <?php
                                        }
                                        if ($this->Misc->accessible($this->access, 'menu', 'method', 'delete_link')) {
                                            ?>
                                            <a data-toggle="modal" href="#dfltmodallg"  title="Delete Link" class="tip deletelink" value='<?php echo $this->Misc->encode_id($q->id_link); ?>'><span class="fa fa-remove fa-lg"></span></a>
                                        <?php }
                                        ?>
                                    </td>
                                </tr>

                            <?php }
                            ?>
                            <tr class='warning'>
                                <th colspan='5' >SIDE MENU</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($sidemenu as $var => $val) {
                                if (!empty($val['val']['data'])) {
                                    $i++;
                                    $info = $val['val']['data'];
                                    ?>
                                    <tr class='success'>
                                        <td><?php echo $info->link_order; ?></td>
                                        <td><span class='icon16 <?php echo $info->link_icon; ?>'></span> <?php echo $info->link_name; ?></td>
                                        <td><?php echo ($info->link_external == 0) ? admin_url($info->link_url) : $info->link_url; ?></td>
                                        <td>
                                            <?php
                                            $attr = '';
                                            $attr.=($info->link_newtab == 1) ? "New Tab" : "";
                                            $attr.=($attr != '' and $info->link_external == 1) ? " | " : "";
                                            $attr.=($info->link_external == 1) ? "External Link" : "";
                                            $attr.=($attr != '' and $info->link_head == 1) ? " | " : "";
                                            $attr.=($info->link_head == 1) ? "Head Link" : "";
                                            echo "<small>" . $attr . "</small>";
                                            ?>
                                        </td>
                                        <td>
                                            <!-- Access Links -->
                                            <?php if ($this->Misc->accessible($this->access, 'menu', 'method', 'edit_link')) { ?>
                                                <a data-toggle="modal" href="#dfltmodallg" title="Edit Link" class="tip editlink" value='<?php echo $this->Misc->encode_id($info->id_link); ?>'><span class="fa fa-pencil fa-lg"></span></a>
                                                <?php
                                            }
                                            if ($this->Misc->accessible($this->access, 'menu', 'method', 'delete_link')) {
                                                ?>
                                                <a data-toggle="modal" href="#dfltmodallg"  title="Delete Link" class="tip deletelink" value='<?php echo $this->Misc->encode_id($info->id_link); ?>'><span class="fa fa-remove fa-lg"></span></a>
                                            <?php }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    if (!empty($val['child']))
                                        foreach ($val['child'] as $var2 => $val2) {
                                            $info2 = $val2['val']['data'];
                                            ?>
                                            <tr>
                                                <td style='text-align: right'><?php echo $info2->link_order; ?> <span class='icon16 typ-icon-arrow-right'></span></td>
                                                <td><span class='icon16 <?php echo $info2->link_icon; ?>'></span> <?php echo $info2->link_name; ?></td>
                                                <td><?php echo ($info2->link_external == 0) ? admin_url($info2->link_url) : $info2->link_url; ?></td>
                                                <td>
                                                    <?php
                                                    $attr = '';
                                                    $attr.=($info2->link_newtab == 1) ? "New Tab" : "";
                                                    $attr.=($attr != '' and $info2->link_external == 1) ? " | " : "";
                                                    $attr.=($info2->link_external == 1) ? "External Link" : "";
                                                    $attr.=($attr != '' and $info2->link_head == 1) ? " | " : "";
                                                    $attr.=($info2->link_head == 1) ? "Head Link" : "";
                                                    echo "<small>" . $attr . "</small>";
                                                    ?>
                                                </td>
                                                <td>
                                                    <!-- Access Links -->
                                                    <?php if ($this->Misc->accessible($this->access, 'menu', 'method', 'edit_link')) : ?>
                                                        <a data-toggle="modal" href="#dfltmodallg" title="Edit Link" class="tip editlink" value='<?php echo $this->Misc->encode_id($info2->id_link); ?>'><span class="fa fa-pencil fa-lg"></span></a>
                                                        <?php
                                                    endif;
                                                    if ($this->Misc->accessible($this->access, 'menu', 'method', 'delete_link')) :
                                                        ?>
                                                        <a data-toggle="modal" href="#dfltmodallg" title="Delete Link" class="tip deletelink" value='<?php echo $this->Misc->encode_id($info2->id_link); ?>'><span class="fa fa-remove fa-lg"></span></a>
                                                        <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                }
                            }
                            ?>

                        </tbody>
                    </table>	
                </div><!-- End .x_content -->
            </div><!-- end of .x_panel -->
        </div><!-- end of div -->
    </div><!-- end of .clearflash -->
</div><!-- end of .right_col -->
<script type="text/javascript">
    $(document).ready(function () {
        //Link
        $('.addlink').on('click', {
            'action': "<?php echo admin_url("menu/popupform_link"); ?>",
            'type': 1,
            'id': "<?php echo $this->Misc->encode_id($row->id_user_type); ?>",
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltpopform);

        $('.editlink').on('click', {
            'action': "<?php echo admin_url("menu/popupform_link"); ?>",
            'type': 2,
            'id': "<?php echo $this->Misc->encode_id($row->id_user_type); ?>",
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltpopform);

        //        $('.deletelink').on('click', {
        //            'action': "<?php echo admin_url("menu/method/delete_link"); ?>",
        //            'id': "<?php echo $this->Misc->encode_id($row->id_user_type); ?>",
        //            'conMessage': "You are about to delete this link.",
        //            'redirect': "<?php echo current_url(); ?>"
        //        }, dfltaction_item);

        $('.deletelink').on('click', {
            'template': "<?php echo admin_url("template/confirmation"); ?>",
            'id': "<?php echo $this->Misc->encode_id($row->id_user_type); ?>",
            'action': "<?php echo admin_url("menu/method/delete_link"); ?>",
            'message': "You are about to delete this link.",
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltconfirmation);
    });
</script>
<?php $this->load->view(admin_dir('template/footer')); ?>