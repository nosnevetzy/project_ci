<?php $this->load->view(admin_dir('template/header')); ?>
<div class="page-header position-relative">
	<h1>
		User Access
	</h1>
</div>
<div class="clearfix">
	<div class="pull-left">
		<select id="formdata_usertype">
			<option></option>
			<?php
			foreach($user_types->result() as $q){ ?>
				<option value='<?php echo $q->id_user_type; ?>'><?php echo $q->user_type; ?></option>
			<?php
			}?>
		</select>
	</div>
</div>
<div class="hr dotted"></div>
<div id="page-form" class="row-fluid">
	<div id='load_list'></div>
</div><!--/page-form-->
<script type="text/javascript">
	$(document).ready(function(){
		$('#formdata_usertype').on('change',function(){
			load_list($(this).val());
		});
		
		function load_list(ids){
			var post_data={};
			post_data['id']=ids;
			$.ajax({
				url: "<?php echo admin_url('user/method/list_typeclass'); ?>",
				type: 'POST',
				data: post_data,
				success:function(result){	
					$('#load_list').html(result);
				}
			});	
		}
		
		<?php
		if($this->Misc->accessible($this->access,'user','method','change_useraccess')){ ?>
		$('#load_list').on('change','.accesscheck',function(){
			var id_arr=$(this).attr('id').split('_');
			var post_data={};
			post_data['id']=$('#formdata_usertype').val();
			post_data['item']=id_arr[1];
			post_data['access']=$(this).prop('checked')?true:false;
			$.ajax({
				url: "<?php echo admin_url('user/method/change_useraccess'); ?>",
				type: 'POST',
				data: post_data,
				success:function(result){
				}
			});		
			// var result=$.ajax({				
				// url: "<?php echo admin_url('user/method/change_useraccess'); ?>",
				// type: 'POST',
				// async: false,
				// dataType:"json",
				// data: post_data
			// }).responseText;
			// $('.test').html(result);	
		});
		<?php
		} ?>
	});
</script>	
<?php $this->load->view(admin_dir('template/footer')); ?>