<table class="table">
	<thead>
		<tr>
			<th class="col-lg-2">#</th>
			<th class="col-lg-4">Company</th>
			<th class="col-lg-2">Actions</th>
		</tr>
	</thead>
	<tbody >
		<?php
		$i=0;
		if(!empty($companies))
		foreach($companies as $q){ $i++; ?>
			<tr >
				<td><?php echo $i; ?></td>
				<td><?php echo $q->company_name; ?></td>
				<td>
				<!-- Access Links -->
				<?php
				if($this->Misc->accessible($this->access,'user','method','change_company_access')){ 
					$check=!empty($company_accesses[$q->id_company])?"checked='true'":""; ?>
					<input type="checkbox" class='changeaccess' value="<?php echo $q->id_company; ?>" <?php echo $check; ?> >
				<?php
				} ?>
			</td>
		<?php	
		} ?>	
		
	</tbody>
</table>	
<script type="text/javascript" src="<?php echo assets_dir("js/main.js"); ?>"></script><!-- Core js functions -->