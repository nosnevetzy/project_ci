<?php $this->load->view(admin_dir('template/header')); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div id="clearflash" class="">
        <div class="page-title">
            <div class="clearfix"></div>
        </div><!-- end of page-title -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User Profile</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                <img class="img-responsive avatar-view" src="<?php echo upload_user_dir($row->id_user . '/profile/' . $row->user_picture); ?>" alt="Avatar">
                            </div>
                        </div>
                        <h3><?php echo $this->Misc->display_name($row->user_fname, $row->user_mname, $row->user_lname); ?></h3>

                        <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-user user-profile-icon"></i> Username: <?php echo $row->user_code; ?>
                            </li>
                            <li>
                                <i class="fa fa-external-link user-profile-icon"></i> E-Mail: 
                                <a href="mailto:<?php echo $row->user_email; ?>" target="_blank"><?php echo $row->user_email; ?></a>
                            </li>
                            <?php if ($row->user_street && $row->user_city && $row->user_province && $row->user_country): ?>
                                <li>
                                    <i class="fa fa-map-marker user-profile-icon"></i> <?php echo "$row->user_street $row->user_city $row->user_province $row->user_country"; ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($row->user_contact): ?>
                                <li class="m-top-xs">
                                    <i class="fa fa-mobile user-profile-icon"></i>
                                    <?php echo $row->user_contact; ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <a href="<?php echo admin_url('profile/edit_password_page'); ?>" class="btn btn-primary"><i class="fa fa-edit m-right-xs"></i> Change Password</a>
                        <a href="<?php echo admin_url('profile/edit_myinfo_page'); ?>" class="btn btn-primary"><i class="fa fa-key m-right-xs"></i> Edit Information</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php $this->load->view(admin_dir('template/footer')); ?>