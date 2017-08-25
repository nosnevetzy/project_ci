<?php $this->load->view(admin_dir('template/header')); ?>

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
                    <a class="text-white" href="<?php echo patients_url('lists'); ?>"><i class="icon-undo position-left">
                            <button type="button" class="btn bg-teal-400">
                        </i> Back to list
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
            <div id="clearflash" class="">
                <div class="row">
                    <!--Body content-->
                    <div id="def_body" class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Toolbar -->
                        <div class="navbar navbar-default navbar-xs content-group">
                            <ul class="nav navbar-nav visible-xs-block">
                                <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                            </ul>

                            <div class="navbar-collapse collapse" id="navbar-filter">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#info" data-toggle="tab"><i class="icon-menu7 position-left"></i> INFORMATION</a></li>
                                    <li><a href="#ref" data-toggle="tab"><i class="icon-calendar3 position-left"></i> REFRACTION</a></li>
                                    <li><a href="#cee" data-toggle="tab"><i class="icon-cog3 position-left"></i> COMPREHENSIVE EYE EXAMINATION</a></li>
                                    <li><a href="#cl" data-toggle="tab"><i class="icon-cog3 position-left"></i> CONTACT LENS</a></li>
                                    <li><a href="#iop" data-toggle="tab"><i class="icon-cog3 position-left"></i> IOP MEASUREMENT</a></li>
                                    <li><a href="#vt" data-toggle="tab"><i class="icon-cog3 position-left"></i> VISUAL THERAPY</a></li>
                                    <li><a href="#cer" data-toggle="tab"><i class="icon-cog3 position-left"></i> CERTIFICATION</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /toolbar -->
                        <div class="tabbable">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="info">
                                    <div class="panel panel-flat">
                                        <div class="panel-body flex">
                                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                                <div class="profile_img img-avatar">
                                                    <img class="img-responsive avatar-view" src="<?php echo upload_patient_dir($row->id_patient . '/profile/' . $row->patient_picture); ?>" alt="Avatar" title="Change the avatar">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
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

                                <div class="tab-pane fade" id="ref">

                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <button data-toggle="modal" href="#dfltmodallg" title="New Refraction" class="tip newrefraction btn bg-green-700">New</button>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($refraction): ?>
                                                <table>
                                                    <?php foreach ($refraction as $ref): ?>
                                                        <tr>
                                                            <td><?php echo date('F d,Y', strtotime($ref->added_date)) ?></td>
                                                            <td>
                                                                <table> 
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>SPHERE</th>
                                                                        <th>CYLINDER</th>
                                                                        <th>AXIS</th>
                                                                        <th>PD</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>OD</th>
                                                                        <th><?php echo $ref->od_sphere ?></th>
                                                                        <th><?php echo $ref->od_cylinder ?></th>
                                                                        <th><?php echo $ref->od_axis ?></th>
                                                                        <th><?php echo $ref->od_pd ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>OS</th>
                                                                        <th><?php echo $ref->os_sphere ?></th>
                                                                        <th><?php echo $ref->os_cylinder ?></th>
                                                                        <th><?php echo $ref->os_axis ?></th>
                                                                        <th><?php echo $ref->os_pd ?></th> 
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>      
                                                                <button data-toggle="modal" href="#dfltmodallg" title="Edit IOP Measurement" class="tip editrefraction btn bg-blue-700" value='<?php echo $this->Misc->encode_id($ref->id_refraction); ?>'>Edit</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="cee">

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

                                <div class="tab-pane fade" id="iop">

                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <button data-toggle="modal" href="#dfltmodallg" title="New IOP Measurement" class="tip newiop btn bg-green-700">New</button>
                                            <hr>
                                        </div>
                                        <div class="panel-body">
                                            <?php if ($iop): ?>
                                                <table>
                                                    <?php foreach ($iop as $io): ?>
                                                        <tr>
                                                            <td><?php echo date('F d,Y', strtotime($io->added_date)) ?></td>
                                                            <td><?php echo $io->iop ?></td>
                                                            <td>      
                                                                <button data-toggle="modal" href="#dfltmodallg" title="Edit IOP Measurement" class="tip editiop btn bg-blue-700" value='<?php echo $this->Misc->encode_id($io->id_iop); ?>'>Edit</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="vt">

                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <button data-toggle="modal" href="#dfltmodallg" title="New Visual Therapy" class="tip newvt btn bg-green-700">New</button>
                                            <hr>
                                        </div>
                                        <div class="panel panel-body">
                                            <?php if ($vt): ?>
                                                <table>
                                                    <?php foreach ($vt as $vi): ?>
                                                        <tr>
                                                            <td><?php echo date('F d,Y', strtotime($vi->added_date)) ?></td>
                                                            <td><?php echo $vi->visual_therapy ?></td>
                                                            <td>      
                                                                <button data-toggle="modal" href="#dfltmodallg" title="Edit Visual Therapy" class="tip editvt btn bg-blue-700" value='<?php echo $this->Misc->encode_id($vi->id_visual_therapy); ?>'>Edit</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="tab-pane fade" id="cer">

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