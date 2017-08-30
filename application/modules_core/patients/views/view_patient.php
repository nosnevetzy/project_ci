<?php $this->load->view(admin_dir('template/header')); ?>

<?php $segment = explode('/', current_url()); ?>

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h5>
                    <i class=" icon-folder-open2 mr-5"></i>
                    View Patient
                    <small><?php echo $this->Misc->display_name($row->patient_fname, $row->patient_mname, $row->patient_lname); ?>'s Information</small>
                </h5>
            </div>

            <div class="heading-elements">
                <div class="btn-group heading-btn">
                    <a class="text-white" href="<?php echo patients_url('lists'); ?>">
                        <button type="button" class="btn bg-teal-400">
                            <i class="icon-undo position-left"></i> Back to list
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="row">
                    <!--Body content-->
                    <div id="def_body" class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <div class="tabbable nav-tabs-vertical nav-tabs-left">
                                    <ul class="nav nav-tabs nav-tabs-highlight">
                                        <li <?php if(empty($segment[9])): ?> class="active" <?php endif; ?>><a href="#info" data-toggle="tab"><i class="icon-menu7 position-left"></i> INFORMATION</a></li>
                                        <li <?php if(!empty($segment[9]) && $segment[9] == "refraction"): ?> class="active" <?php endif; ?>><a href="#ref" data-toggle="tab"><i class="icon-calendar3 position-left"></i> REFRACTION</a></li>
                                        <li <?php if(!empty($segment[9]) && $segment[9] == "cee"): ?> class="active" <?php endif; ?>><a href="#cee" data-toggle="tab"><i class="icon-cog3 position-left"></i> COMPREHENSIVE EYE EXAMINATION</a></li>
                                        <li <?php if(!empty($segment[9]) && $segment[9] == "cl"): ?> class="active" <?php endif; ?>><a href="#cl" data-toggle="tab"><i class="icon-cog3 position-left"></i> CONTACT LENS</a></li>
                                        <li <?php if(!empty($segment[9]) && $segment[9] == "iop"): ?> class="active" <?php endif; ?>><a href="#iop" data-toggle="tab"><i class="icon-cog3 position-left"></i> IOP MEASUREMENT</a></li>
                                        <li <?php if(!empty($segment[9]) && $segment[9] == "vt"): ?> class="active" <?php endif; ?>><a href="#vt" data-toggle="tab"><i class="icon-cog3 position-left"></i> VISUAL THERAPY</a></li>
                                        <li <?php if(!empty($segment[9]) && $segment[9] == "cer"): ?> class="active" <?php endif; ?>><a href="#cer" data-toggle="tab"><i class="icon-cog3 position-left"></i> CERTIFICATION</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade <?php if(empty($segment[9])): ?> active in <?php endif; ?>" id="info">
                                            <div class="panel panel-flat">
                                                <div class="panel-body flex">
                                                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                                                        <div class="profile_img img-avatar">
                                                            <img class="img-responsive avatar-view" src="<?php echo upload_patient_dir($row->id_patient . '/profile/' . $row->patient_picture); ?>" alt="Avatar" title="Change the avatar">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label no-margin text-semibold">First Name:</label>
                                                            <div class="pull-right"><?php echo $row->patient_fname; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label no-margin text-semibold">Middle Name:</label>
                                                            <div class="pull-right"><?php echo $row->patient_mname; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label no-margin text-semibold">Last Name:</label>
                                                            <div class="pull-right"><?php echo $row->patient_lname; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label no-margin text-semibold">Address:</label>
                                                            <div class="pull-right"><?php echo $row->patient_address; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label no-margin text-semibold">Contact No:</label>
                                                            <div class="pull-right"><?php echo $row->patient_contact; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label no-margin text-semibold">Gender:</label>
                                                            <div class="pull-right"><?php echo $row->patient_gender; ?></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label no-margin text-semibold">Occupation:</label>
                                                            <div class="pull-right"><?php echo $row->patient_occupation; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade <?php if(!empty($segment[9]) && $segment[9] == "refraction"): ?> active in <?php endif; ?>" id="ref">

                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <button data-toggle="modal" href="#dfltmodallg" title="New Refraction" class="tip newrefraction btn bg-teal-400">
                                                        <i class="icon-add-to-list position-left"></i> Add New
                                                    </button>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                    <?php if ($refraction): ?>
                                                        <table class="table table-refraction">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2" class="text-bold">DATE</th>
                                                                    <th class="text-bold">SPHERE</th>
                                                                    <th class="text-bold">CYLINDER</th>
                                                                    <th class="text-bold">AXIS</th>
                                                                    <th class="text-bold">PD</th>
                                                                    <th class="text-bold"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($refraction as $ref): ?>
                                                                <tr>
                                                                    <th rowspan="2" class="text-bold"><?php echo date('F d,Y', strtotime($ref->added_date)) ?></th>
                                                                    <th class="separate text-bold">
                                                                        OD
                                                                    </th>
                                                                    <td>
                                                                        <?php echo $ref->od_sphere ?>
                                                                    </td>
                                                                    <td><?php echo $ref->od_cylinder ?></td>
                                                                    <td><?php echo $ref->od_axis ?></td>
                                                                    <td><?php echo $ref->od_pd ?></td>
                                                                    <td rowspan="2">
                                                                        <a data-toggle="modal" href="#dfltmodallg" title="Edit IOP Measurement" class="tip editrefraction" value='<?php echo $this->Misc->encode_id($ref->id_refraction); ?>'>
                                                                            <span class="icon-pencil text-slate-700"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="separate text-bold">OS</th>
                                                                    <td><?php echo $ref->os_sphere ?></td>
                                                                    <td><?php echo $ref->os_cylinder ?></td>
                                                                    <td><?php echo $ref->os_axis ?></td>
                                                                    <td><?php echo $ref->os_pd ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade <?php if(!empty($segment[9]) && $segment[9] == "cee"): ?> active in <?php endif; ?>" id="cee">

                                            <div class="panel panel-flat">
                                                <div class="panel-body">
                                                    <button class="btn bg-green-700">New</button>
                                                    <hr>
                                                    <div class="panel-body">asd</div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="cl">

                                            <div class="panel panel-flat">
                                                <div class="panel-body">
                                                    <button class="btn bg-green-700">New</button>
                                                    <hr>
                                                    <div class="panel-body">asd</div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade <?php if(!empty($segment[9]) && $segment[9] == "iop"): ?> active in <?php endif; ?>" id="iop">

                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <button data-toggle="modal" href="#dfltmodallg" title="New IOP Measurement" class="tip newiop btn bg-teal-400">
                                                        <i class="icon-add-to-list position-left"></i> Add New
                                                    </button>
                                                </div>
                                                <div class="panel-body">
                                                    <?php if ($iop): ?>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">DATE</th>
                                                                    <th class="text-center">IOP MEASUREMENT</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($iop as $io): ?>
                                                                <tr>
                                                                    <td><?php echo date('F d,Y', strtotime($io->added_date)) ?></td>
                                                                    <td><?php echo $io->iop ?></td>
                                                                    <td>  
                                                                        <a data-toggle="modal" href="#dfltmodallg" title="Edit IOP Measurement" class="tip editiop" value='<?php echo $this->Misc->encode_id($io->id_iop); ?>'>
                                                                            <span class="icon-pencil text-slate-700"></span>
                                                                        </a> 
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade <?php if(!empty($segment[9]) && $segment[9] == "vt"): ?> active in <?php endif; ?>" id="vt">

                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <button data-toggle="modal" href="#dfltmodallg" title="New Visual Therapy" class="tip newvt btn bg-teal-400">
                                                        <i class="icon-add-to-list position-left"></i> Add New
                                                    </button>
                                                </div>
                                                <div class="panel-body">
                                                    <?php if ($vt): ?>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-bold">DATE</th>
                                                                    <th class="text-bold">VISUAL THERAPY</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($vt as $vi): ?>
                                                                <tr>
                                                                    <td><?php echo date('F d,Y', strtotime($vi->added_date)) ?></td>
                                                                    <td><?php echo $vi->visual_therapy ?></td>
                                                                    <td>     
                                                                        <a data-toggle="modal" href="#dfltmodallg" title="Edit Visual Therapy" class="tip editvt" value='<?php echo $this->Misc->encode_id($vi->id_visual_therapy); ?>'>
                                                                            <span class="icon-pencil text-slate-700"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="tab-pane fade <?php if(!empty($segment[9]) && $segment[9] == "cer"): ?> active in <?php endif; ?>" id="cer">

                                            <div class="panel panel-flat">
                                                <div class="panel-body">
                                                    <button class="btn bg-green-700">New</button>
                                                    <hr>
                                                    <div class="panel-body">asd</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End #def_body -->
            </div><!-- end of row -->
        </div>
        <!-- /page content -->

        <script type="text/javascript">
            $(document).ready(function () {

                $('.newvt').on('click', {
                    'action': "<?php echo vt_url("page/add_vt"); ?>",
                    'id': "<?php echo $this->Misc->encode_id($row->id_patient); ?>",
                    'redirect': "<?php echo current_url(); ?>"
                }, load_dfltpopform);

                $('.editvt').on('click', {
                    'action': "<?php echo vt_url("page/edit_vt"); ?>",
                    'id': "<?php echo $this->Misc->encode_id($row->id_patient); ?>",
                    'redirect': "<?php echo current_url(); ?>"
                }, load_dfltpopform);


                $('.newiop').on('click', {
                    'action': "<?php echo iop_url("page/add_iop"); ?>",
                    'id': "<?php echo $this->Misc->encode_id($row->id_patient); ?>",
                    'redirect': "<?php echo current_url(); ?>"
                }, load_dfltpopform);

                $('.editiop').on('click', {
                    'action': "<?php echo iop_url("page/edit_iop"); ?>",
                    'id': "<?php echo $this->Misc->encode_id($row->id_patient); ?>",
                    'redirect': "<?php echo current_url(); ?>"
                }, load_dfltpopform);

                $('.newrefraction').on('click', {
                    'action': "<?php echo refraction_url("page/add_refraction"); ?>",
                    'id': "<?php echo $this->Misc->encode_id($row->id_patient); ?>",
                    'redirect': "<?php echo current_url(); ?>"
                }, load_dfltpopform);

                $('.editrefraction').on('click', {
                    'action': "<?php echo refraction_url("page/edit_refraction"); ?>",
                    'id': "<?php echo $this->Misc->encode_id($row->id_patient); ?>",
                    'redirect': "<?php echo current_url(); ?>"
                }, load_dfltpopform);

            });
        </script>
        <?php $this->load->view(admin_dir('template/footer')); ?>