<?php
if(!empty($add)){ ?>
	<div class="modal-content">
            <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
			<h3>Add New User Type</h3>
		</div>
		<div class="modal-body">
			<div class="row popformdata_alert"></div>
			<form class="form-horizontal" action="#" role="form">
				<div class="form-group">
					<label class="col-lg-3 control-label">* Name</label>
					<div class="col-lg-9">
						<input type="text" class='form-control popformdata' id='popformdata_name' value=""/>
					</div>
				</div><!-- End .form-group  -->
			</form>
		</div>
		<div class="modal-footer">
			<div class='right'>
				<button class="btn btn-success ui-wizard-content ui-formwizard-button" id="popformdata_save" type="button">Add</button>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){	
			$('#popformdata_save').on('click',{
				'action':"<?php echo admin_url("user/method/add_usertype"); ?>",
				'conMessage':"You are about to add new user type.",
				'clear':true,
				'redirect':"<?php echo $redirect; ?>"
			},save_form);
		});
	</script>
<?php
} else if(!empty($edit)){ ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
			<h3>Edit User Type</h3>
		</div>
		<div class="modal-body">
			<div class="row popformdata_alert"></div>
			<form class="form-horizontal" action="#" role="form">
				<div class="form-group">
					<label class="col-lg-3 control-label">* Name</label>
					<div class="col-lg-9">
						<input type="text" class='form-control popformdata' id='popformdata_name' value="<?php echo $row->user_type; ?>"/>
					</div>
				</div><!-- End .form-group  -->
			</form>
		</div>
		<div class="modal-footer">
			<div class='right'>
				<button class="btn btn-warning ui-wizard-content ui-formwizard-button" id="popformdata_save" type="button">Save</button>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){	
			$('#popformdata_save').on('click',{
				'action':"<?php echo admin_url("user/method/edit_usertype"); ?>",
				'id':"<?php echo $this->Misc->encode_id($row->id_user_type); ?>",
				'conMessage':"You are about to edit this user type.",
				'redirect':"<?php echo $redirect; ?>"
			},save_form);
		});
	</script>
<?php
} ?>	
<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->