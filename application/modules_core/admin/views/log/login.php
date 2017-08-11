<style>
    @font-face {
        font-family: robotoLight;
        src: url(<?php echo assets_dir("fonts/roboto/Roboto-Light.ttf"); ?>);
    }
</style>
<?php $this->load->view(admin_dir('template/log_header')); ?>
<div class="loginContainer">
    <form class="form-horizontal loginForm" method="POST" action="" id="formlogin" role="form" >
        <div class="form-group" style="margin-bottom: 50px;">
            <div class="col-lg-12">
                <a class="log-in-logo" href="<?php echo base_url(); ?>"><img src='<?php echo assets_dir("images/login.png"); ?>'></a>
            </div>
        </div><!-- End .form-group  -->
        <div class="form-group form_input">
            <div class="col-lg-12">
                <span class="icon16 icomoon-icon-user-2 right marginL5"></span>
                <input class="form-control" type="text" name="code" placeholder="ID Number">
            </div>
        </div><!-- End .form-group  -->
        <div class="form-group form_input">
            <div class="col-lg-12">
                <span class="icon16 icomoon-icon-lock right marginL5"></span>
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
        </div><!-- End .form-group  -->
        <div class="form-group">
            <div class="col-lg-12 clearfix form-actions">
                <!--<div class="checkbox left">
                        <label><input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" /> Keep me logged in</label>
                </div>-->
                <button type="submit" class="btn loginBtn">SIGN IN</button>
            </div>
            <span class="forgot help-block"><a href="<?php echo admin_url('log/reset_password'); ?>">Forgot your password?</a></span>
        </div><!-- End .form-group  -->
    </form>
</div>
<?php $this->load->view(admin_dir('template/log_footer')); ?>