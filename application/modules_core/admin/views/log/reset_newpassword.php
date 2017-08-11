<?php $this->load->view(admin_dir('template/log_header')); ?>
<div class="loginContainer">
	<br/>
	<?php
	if(empty($id)){ ?>
	<h3>New Password</h3>
	<form class="form-horizontal loginForm" method="POST" action="" id="formlogin" role="form" >
		<div class="form-group">
			<label class="col-lg-12 control-label" for="code">New Password:</label>
			<div class="col-lg-12">
				<input class="form-control" type="password" name="newpassword" >
			</div>
		</div><!-- End .form-group  -->
		<div class="form-group">
			<label class="col-lg-12 control-label" for="password">Confirm Password:</label>
			<div class="col-lg-12">
				<input class="form-control" type="password" name="confirm" >
			</div>
		</div><!-- End .form-group  -->
		<div class="form-group">
			<div class="col-lg-12 clearfix form-actions">
				<a href='<?php  echo admin_url('log'); ?>' class="btn btn-info left loginBtn"><span class="icon16 icomoon-icon-arrow-left-5 white"></span> Back</a>
				<button type="submit" class="btn btn-success right loginBtn"><span class="icon16 brocco-icon-key white"></span> Save New Password</button>
			</div>
		</div><!-- End .form-group  -->
	</form>
	<?php
	}else{ ?>
	<h3>Successfully Changed</h3>
	<form class="form-horizontal loginForm" method="POST" action="" id="formlogin" role="form" >
		<div class="form-group">
			<div class="col-lg-12 clearfix form-actions">
				<a href='<?php  echo admin_url('log'); ?>' class="btn btn-info left loginBtn"><span class="icon16 icomoon-icon-arrow-left-5 white"></span> Login</a>
			</div>
		</div><!-- End .form-group  -->
	</form>
	<?php
	} ?>
</div>
<?php $this->load->view(admin_dir('template/log_footer')); ?>