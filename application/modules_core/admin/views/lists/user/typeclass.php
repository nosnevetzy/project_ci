	<div class="table-header">&nbsp;</div>
	<div class='dataTables_wrapper' role="grid">
		<table class="table table-striped table-bordered table-hover" id='class_list'>
			<thead>
				<tr>
					<th class='span2' colspan=2>#</th>
					<th>Title</th>
					<th>Class/Function Name</th>
					<th class='span2'></th>
				</tr>
			</thead>
			<?php
			function load_btnswitch_func($id,$check=''){  ?>
				<?php
				if($this->Misc->accessible($this->access,'user','method','change_useraccess')){ ?>
				<input class="ace-switch ace-switch-2 accesscheck" id='accesscheck_<?php echo $id; ?>' type="checkbox" <?php echo ($check!='')?"checked='true'":"" ?> >
				<span class="lbl"></span>
				<?php
				} ?>
			<?php			
			} ?>
			<tbody>
				<?php
				$i=0;
				if(!empty($classes))
				foreach($classes->result() as $q){ $i++; ?>
					<tr class='info' >
						<td colspan=2><?php echo $i; ?></td>
						<td><?php echo $q->class_title; ?></td>
						<td><small><?php echo $q->class_name; ?></small></td>
						<td>&nbsp;</td>
					</tr>
					<?php
					if(!empty($class_functions[$q->id_class][1])){ ?>
						<tr class='success'>
							<td class='span1'></td>
							<td class='span1'><i class='icon-file-alt'></li></td>
							<td colspan='3'>Page</td>
						</tr>	
						<?php
						$pagedata=$class_functions[$q->id_class][1];
						foreach($pagedata as $var=>$val){ ?>
							<tr>
								<td class='span1'></td>
								<td class='span1'><i class='icon-angle-right'></i></td>
								<td><?php echo $val->class_function_title; ?></td>
								<td><small><?php echo $val->class_function_name; ?></small></td>
								<td><?php load_btnswitch_func($val->id_class_function,!empty($user_accesses[$val->id_class_function])); ?></td>
							</tr>
						<?php	
						}
					}
					
					if(!empty($class_functions[$q->id_class][2])){ ?>
						<tr class='success'>
							<td class='span1'></td>
							<td class='span1'><i class='icon-bolt'></li></td>
							<td colspan='3'>Method</td>
						</tr>	
						<?php
						$methoddata=$class_functions[$q->id_class][2];
						foreach($methoddata as $var=>$val){ ?>
							<tr>
								<td class='span1'></td>
								<td class='span1'><i class='icon-angle-right'></i></td>
								<td><?php echo $val->class_function_title; ?></td>
								<td><small><?php echo $val->class_function_name; ?></small></td>
								<td><?php load_btnswitch_func($val->id_class_function,!empty($user_accesses[$val->id_class_function])); ?></td>
							</tr>
						<?php	
						}
					}
				} ?>	
			</tbody>
		</table>
	</div>	
	<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->