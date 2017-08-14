<?php $this->load->view(admin_dir('template/header')); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <span class="text-semibold"><i class="icon-list-unordered mr-5"></i> Classes List</span>
                </h5>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <button class="btn btn-icon btn-sm dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-wrench"></i>
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'add_user_type')) { ?>
                            <li><a href="<?php echo admin_url("user/add_user_type"); ?>"><span class="icon-user-plus"></span> Add New User Type</a></li>
                        <?php }
                        ?>
                        <?php if ($this->Misc->accessible($this->access, 'user', 'method', 'csv_export')) { ?>
                            <li><a href="#" id="User Type List <?php echo date("M-d-Y") ?>" class="csv_export"><span class="icon-file-excel" style="pointer-events: cursor"></span> Export Table</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

    <!-- page content -->
    <div class="right_col" role="main">
        <div id="def_body">
            <div class="panel panel-flat">
                <div class="x_content">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-lg-1">#</th>
                                    <th class="col-lg-1">Class</th>
                                    <th class="col-lg-4">Function</th>
                                    <th class="col-lg-3">Name</th>
                                    <th class="col-lg-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php
                                $i = 0;
                                foreach ($classes as $q) {
                                    $i++;
                                    ?>
                                    <tr class='warning'>
                                        <td><?php echo $i; ?></td>
                                        <td colspan=3 style='text-align: left'><?php echo $q->class_title; ?> <small>(<?php echo $q->class_name; ?>)</small></td>
                                        <td>
                                            <div class="controls center">
                                                <!-- Access Links -->
                                                <?php if ($this->Misc->accessible($this->access, 'myclass', 'method', 'edit_class')) { ?>
                                                    <a data-toggle="modal" href="#dfltmodal" title="Edit Class" class="tip editclass mr-10" value='<?php echo $this->Misc->encode_id($q->id_class); ?>'>                                              
                                                        <span class="icon-pencil text-slate-700"></span>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->Misc->accessible($this->access, 'myclass', 'method', 'delete_class')) {
                                                    ?>
                                                    <a href="#" title="Delete Class" class="tip deleteclass" value='<?php echo $this->Misc->encode_id($q->id_class); ?>'>
                                                        <span class="icon-trash text-slate-700"></span>
                                                    </a>
                                                <?php }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php if (!empty($class_functions[$q->id_class][1])) { ?>
                                        <tr class='success'>
                                            <td>&nbsp;</td>
                                            <td style='text-align: left'><span class='icon16 icomoon-icon-file-5'></span></td>
                                            <td style='text-align: left' colspan='3'>Page</td>
                                        </tr>	
                                        <?php
                                        $pagedata = $class_functions[$q->id_class][1];
                                        foreach ($pagedata as $var => $val) {
                                            ?>
                                            <tr>
                                                <td colspan='2'>&nbsp;</td>
                                                <td style='text-align: left'><span class='icon16 typ-icon-arrow-right'></span> <?php echo $val->class_function_title; ?></td>
                                                <td><?php echo $val->class_function_name; ?></td>
                                                <td>
                                                    <!-- Access Links -->
                                                    <?php if ($this->Misc->accessible($this->access, 'myclass', 'method', 'edit_function')) { ?>
                                                        <a data-toggle="modal" href="#dfltmodal" title="Edit Function" class="tip editfunction mr-10" value='<?php echo $this->Misc->encode_id($val->id_class_function); ?>'>
                                                            <span class="icon-pencil text-slate-700"></span>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->Misc->accessible($this->access, 'myclass', 'method', 'delete_function')) {
                                                        ?>
                                                        <a href="#" title="Delete Function" class="tip deletefunction" value='<?php echo $this->Misc->encode_id($val->id_class_function); ?>'>
                                                            <span class="icon-trash text-slate-700"></span>
                                                        </a>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }

                                    if (!empty($class_functions[$q->id_class][2])) {
                                        ?>
                                        <tr class='success'>
                                            <td>&nbsp;</td>
                                            <td style='text-align: left'><span class='icon16 minia-icon-bolt'></span></td>
                                            <td style='text-align: left' colspan='3'>Method</td>
                                        </tr>	
                                        <?php
                                        $methoddata = $class_functions[$q->id_class][2];
                                        foreach ($methoddata as $var => $val) {
                                            ?>
                                            <tr>
                                                <td colspan='2'>&nbsp;</td>
                                                <td style='text-align: left'><span class='icon16 typ-icon-arrow-right'></span> <?php echo $val->class_function_title; ?></td>
                                                <td><?php echo $val->class_function_name; ?></td>
                                                <td>
                                                    <!-- Access Links -->
                                                    <?php if ($this->Misc->accessible($this->access, 'myclass', 'method', 'edit_function')) { ?>
                                                        <a data-toggle="modal" href="#dfltmodal" title="Edit Function" class="tip editfunction mr-10" value='<?php echo $this->Misc->encode_id($val->id_class_function); ?>'>
                                                            <span class="icon-pencil text-slate-700"></span>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->Misc->accessible($this->access, 'myclass', 'method', 'delete_function')) {
                                                        ?>
                                                        <a href="#" title="Delete Function" class="tip deletefunction" value='<?php echo $this->Misc->encode_id($val->id_class_function); ?>'>
                                                            <span class="icon-trash text-slate-700"></span>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>	
                    </div><!-- End .panel-body -->
                </div>
            </div>
        </div><!-- end of row -->
    </div><!-- end of page-title -->



<script type="text/javascript">
    $(document).ready(function () {
        //Class
        $('.addclass').on('click', {
            'action': "<?php echo admin_url("myclass/popupform_class"); ?>",
            'type': 1,
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltpopform);

        $('.editclass').on('click', {
            'action': "<?php echo admin_url("myclass/popupform_class"); ?>",
            'type': 2,
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltpopform);

        $('.deleteclass').on('click', {
            'action': "<?php echo admin_url("myclass/method/delete_class"); ?>",
            'conMessage': "You are about to delete this class.",
            'redirect': "<?php echo current_url(); ?>"
        }, dfltaction_item);

        //Function
        $('.addfunction').on('click', {
            'action': "<?php echo admin_url("myclass/popupform_function"); ?>",
            'type': 1,
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltpopform);

        $('.editfunction').on('click', {
            'action': "<?php echo admin_url("myclass/popupform_function"); ?>",
            'type': 2,
            'redirect': "<?php echo current_url(); ?>"
        }, load_dfltpopform);

        $('.deletefunction').on('click', {
            'action': "<?php echo admin_url("myclass/method/delete_function"); ?>",
            'conMessage': "You are about to delete this function.",
            'redirect': "<?php echo current_url(); ?>"
        }, dfltaction_item);
    });
</script>
<?php $this->load->view(admin_dir('template/footer')); ?>