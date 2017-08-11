<?php
if(!empty($add)){ ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span class="icon16 minia-icon-close"></span></button>
			<h3>Add New Function</h3>
		</div>
		<div class="modal-body">
			<div class="row popformdata_alert"></div>
			<form class="form-horizontal" action="#" role="form">
				<div class="form-group">
					<label class="col-lg-3 control-label">* Class</label>
					<div class="col-lg-9">
						<select class='form-control popformdata' id='popformdata_class' >
							<option value=''></option>
							<?php
							foreach($classes as $q){  ?>
								<option value='<?php echo $q->id_class; ?>'><?php echo $q->class_title." - (".$q->class_name.")"; ?></option>
							<?php
							} ?>
						</select>
					</div>
				</div><!-- End .form-group  -->
				<div class="form-group">
					<label class="col-lg-3 control-label">* Type</label>
					<div class="col-lg-9">
						<select class='form-control popformdata' id='popformdata_type' >
							<option value=''></option>
							<option value='1'>Page</option>
							<option value='2'>Method</option>
						</select>
					</div>
				</div><!-- End .form-group  -->
				<div class="form-group">
					<label class="col-lg-3 control-label">* Title</label>
					<div class="col-lg-9">
						<input type="text" class='form-control popformdata' id='popformdata_title' value=""/>
					</div>
				</div><!-- End .form-group  -->
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
				'action':"<?php echo admin_url("myclass/method/add_function"); ?>",
				'conMessage':"You are about to add new function.",
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
			<h3>Edit Function</h3>
		</div>
		<div class="modal-body">
			<div class="row popformdata_alert"></div>
			<form class="form-horizontal" action="#" role="form">
				<div class="form-group">
					<label class="col-lg-3 control-label">* Class</label>
					<div class="col-lg-9">
						<select class='form-control popformdata' id='popformdata_class' >
							<option value=''></option>
							<?php
							foreach($classes as $q){  ?>
								<option value='<?php echo $q->id_class; ?>' <?php echo ($row->class_id==$q->id_class)?"Selected":"";  ?> ><?php echo $q->class_title." - (".$q->class_name.")"; ?></option>
							<?php
							} ?>
						</select>
					</div>
				</div><!-- End .form-group  -->
				<div class="form-group">
					<label class="col-lg-3 control-label">* Type</label>
					<div class="col-lg-9">
						<select class='form-control popformdata' id='popformdata_type' >
							<option value=''></option>
							<option value='1' <?php echo ($row->class_function_type==1)?"Selected":"";  ?> >Page</option>
							<option value='2' <?php echo ($row->class_function_type==2)?"Selected":"";  ?> >Method</option>
						</select>
					</div>
				</div><!-- End .form-group  -->
				<div class="form-group">
					<label class="col-lg-3 control-label">* Title</label>
					<div class="col-lg-9">
						<input type="text" class='form-control popformdata' id='popformdata_title' value="<?php echo $row->class_function_title; ?>"/>
					</div>
				</div><!-- End .form-group  -->
				<div class="form-group">
					<label class="col-lg-3 control-label">* Name</label>
					<div class="col-lg-9">
						<input type="text" class='form-control popformdata' id='popformdata_name' value="<?php echo $row->class_function_name; ?>"/>
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
				'action':"<?php echo admin_url("myclass/method/edit_function"); ?>",
				'id':"<?php echo $this->Misc->encode_id($row->id_class_function); ?>",
				'conMessage':"You are about to edit this function.",
				'clear':true,
				'redirect':"<?php echo $redirect; ?>"
			},save_form);
		});
	</script>
<?php
} ?>	
<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->