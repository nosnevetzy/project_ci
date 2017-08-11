<table class="table">
	<thead>
		<tr>
			<th class="col-lg-2">#</th>
			<th class="col-lg-4">Title</th>
			<th class="col-lg-5">Class/Function Name</th>
			<th class="col-lg-1">Actions</th>
		</tr>
	</thead>
	<tbody >
		<?php
		$i=0;
		if(!empty($classes))
		foreach($classes as $q){ $i++; ?>
			<tr class='warning' >
				<td><?php echo $i; ?></td>
				<td style='text-align: left'><?php echo $q->class_title; ?></td>
				<td><small><?php echo $q->class_name; ?></small></td>
				<td>&nbsp;</td>
			</tr>
			<?php
			if(!empty($class_functions[$q->id_class][1])){ ?>
				<tr class='success'>
					<td style='text-align: right'><span class='icon16 icomoon-icon-file-5'></span></td>
					<td colspan='3' style='text-align: left'>Page</td>
				</tr>	
				<?php
				$pagedata=$class_functions[$q->id_class][1];
				foreach($pagedata as $var=>$val){ ?>
					<tr>
						<td>&nbsp;</td>
						<td style='text-align: left'><span class='icon16 typ-icon-arrow-right'></span> <?php echo $val->class_function_title; ?></td>
						<td><small><?php echo $val->class_function_name; ?></small></td>
						<td class='center' style='text-align: center'>
							<!-- Access Links -->
							<?php
							if($this->Misc->accessible($this->access,'user','method','change_access')){ 
								$check=!empty($user_accesses[$val->id_class_function])?"checked='true'":""; ?>
								<input type="checkbox" class='changeaccess' value="<?php echo $val->id_class_function; ?>" <?php echo $check; ?> >
							<?php
							} ?>
						</td>
					</tr>
				<?php	
				}
			}
			
			if(!empty($class_functions[$q->id_class][2])){ ?>
				<tr class='success'>
					<td style='text-align: right'><span class='icon16 minia-icon-bolt'></span></td>
					<td colspan='3' style='text-align: left'>Method</td>
				</tr>	
				<?php
				$methoddata=$class_functions[$q->id_class][2];
				foreach($methoddata as $var=>$val){ ?>
					<tr>
						<td>&nbsp;</td>
						<td style='text-align: left'><span class='icon16 typ-icon-arrow-right'></span> <?php echo $val->class_function_title; ?></td>
						<td><small><?php echo $val->class_function_name; ?></small></td>
						<td class='center' style='text-align: center'>
							<!-- Access Links -->
							<?php
							if($this->Misc->accessible($this->access,'user','method','change_access')){ 
								$check=!empty($user_accesses[$val->id_class_function])?"checked='true'":""; ?>
								<input type="checkbox" class='changeaccess' value="<?php echo $val->id_class_function; ?>" <?php echo $check; ?> >
							<?php
							} ?>
						</td>
					</tr>
				<?php	
				}
			}
		} ?>	
		
	</tbody>
</table>	
<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->