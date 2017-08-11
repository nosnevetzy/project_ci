<?php $this->load->view(admin_dir('template/header')); ?>
<!--Body content-->
<div id="def_body">
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->
            <div id="loader">
                <div class="heading">
                    <h3>My Profile</h3> 
                </div><!-- End .heading-->	
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <ul id="myTab" class="nav nav-tabs pattern">
                                        <li class="active"><a href="#tab1_1" data-toggle="tab"><span class="icon16 icomoon-icon-file"></span> Profile</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab1_1">
                                            <div class='clearfix'>
                                                <div class="right">
                                                    <a href="<?php echo admin_url('profile/edit_password_page'); ?>"><span class='icon16 icomoon-icon-key-2'></span> Change Password</a>
                                                    <a href="<?php echo admin_url('profile/edit_myinfo_page'); ?>"><span class='icon16 icomoon-icon-pencil'></span> Edit Information</a>
                                                </div>
                                            </div>	
                                            <h1>My Profile</h1>
                                            <div class='row'>
                                                <div class="col-lg-3">
                                                    <img alt="<?php echo $row->user_fname; ?>'s Photo" src="<?php echo upload_user_dir($row->id_user . '/profile/' . $row->user_picture); ?>" class="img-thumbnail" />
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="page-header">
                                                        <h4>
                                                            <?php echo $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <small class='grey'>ID# <?php echo $row->user_code; ?></small>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="page-header">
                                                <h4>
                                                    <strong>Other Information</strong>
                                                </h4>
                                            </div>	
                                            <dl class="dl-horizontal">
                                                <dt>Email&nbsp;</dt>
                                                <dd><?php echo $row->user_email; ?>&nbsp;</dd>

                                                <dt>Address&nbsp;</dt>
                                                <dd><?php echo $row->user_address; ?>&nbsp;</dd>

                                                <dt>Contact&nbsp;</dt>
                                                <dd><?php echo $row->user_contact; ?>&nbsp;</dd>
                                            </dl>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>	
                    </div><!-- End .span12 -->  
                </div><!-- End .row -->  
                <!-- Page end here -->
            </div><!-- End #loader -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
</div><!-- End #def_body -->

<?php $this->load->view(admin_dir('template/footer')); ?>