<?php $this->load->view(admin_dir('template/log_header')); ?>
<div class="loginContainer">
	<br/>
	<h3>Reset Password</h3>
	<form class="form-horizontal loginForm" method="POST" action="<?php echo admin_url('log/reset_password'); ?>" id="formlogin" role="form" >
		<div class="form-group">
			<label class="col-lg-12 control-label" for="code">ID Number:</label>
			<div class="col-lg-12">
				<input class="form-control" type="text" name="code"  placeholder="Enter your ID ...">
				<span class="icon16 wpzoom-user-2 right gray marginR10"></span>
			</div>
		</div><!-- End .form-group  -->
		<div class="form-group">
			<label class="col-lg-12 control-label" for="password">Email:</label>
			<div class="col-lg-12">
				<input class="form-control" type="email" name="email" >
			</div>
		</div><!-- End .form-group  -->
		<div class="form-group">
			<div class="col-lg-12 clearfix form-actions">
				<a href='<?php  echo admin_url('log'); ?>' class="btn btn-info left loginBtn"><span class="icon16 icomoon-icon-arrow-left-5 white"></span> Back</a>
				<button type="submit" class="btn btn-success right loginBtn"><span class="icon16 brocco-icon-key white"></span> Reset Password</button>
			</div>
		</div><!-- End .form-group  -->
	</form>
</div>
<?php $this->load->view(admin_dir('template/log_footer')); ?>