<?php $this->load->view(admin_dir('template/log_header')); ?>
<!-- <div class="loginContainer">
    <form class="form-horizontal loginForm" method="POST" action="" id="formlogin" role="form" >
        <div class="form-group" style="margin-bottom: 50px;">
            <div class="col-lg-12">
                <a class="log-in-logo" href="<?php echo base_url(); ?>"><img src='<?php echo assets_dir("images/login.png"); ?>'></a>
            </div>
        </div>
        <div class="form-group form_input">
            <div class="col-lg-12">
                <span class="icon16 icomoon-icon-user-2 right marginL5"></span>
                <input class="form-control" type="text" name="code" placeholder="ID Number">
            </div>
        </div>
        <div class="form-group form_input">
            <div class="col-lg-12">
                <span class="icon16 icomoon-icon-lock right marginL5"></span>
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12 clearfix form-actions">
                <button type="submit" class="btn loginBtn">SIGN IN</button>
            </div>
            <span class="forgot help-block"><a href="<?php echo admin_url('log/reset_password'); ?>">Forgot your password?</a></span>
        </div>
    </form>
</div> -->

 <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content pb-20">

                    <!-- Advanced login -->
                     <form class="loginForm" method="POST" action="" id="formlogin" role="form" >
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <img src="<?php echo assets_dir("theme/images/logo.png"); ?>" class="img-responsive" width="64" height="64" style="margin: 0 auto;">
                                <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" class="form-control" name="code" placeholder="Username">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group login-options">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <a href="#">Forgot password?</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                            
                            <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
                        </div>
                    </form>
                    <!-- /advanced login -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->
<?php $this->load->view(admin_dir('template/log_footer')); ?>