<div class="alert alert-<?php echo $alert_type; ?>">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>

	<strong>
		<?php 
		if($alert_type=='success'){ ?>
			<i class="icon-ok"></i> Well done!
		<?php
		}else if($alert_type=='error'){ ?>	
			<i class="icon-remove"></i> Oh snap!
		<?php
		}else if($alert_type=='warning'){ ?>	
			<i class="icon-warning-sign"></i> Warning!
		<?php
		}else if($alert_type=='info'){ ?>	
			<i class="icon-info-sign"></i> Heads up!
		<?php
		}
		?>	
	</strong>
	<?php echo $alert_message; ?>
	<br />
</div>