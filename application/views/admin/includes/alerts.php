<?php 
	
		$alert_class = $alert_type = '';

		if ($this->session->flashdata('success'))
		{
			$alert_class = $alert_type = 'success';
		}
		elseif ($this->session->flashdata('warning'))
		{
			$alert_class = $alert_type =  'warning';
		}
		elseif ($this->session->flashdata('error'))
		{
			$alert_class = 'danger';
			$alert_type = 'error';
		}
		elseif ($this->session->flashdata('info'))
		{
			$alert_class = $alert_type =  'info';
		}

		if ($this->session->flashdata($alert_type))
		{
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-<?php echo $alert_class; ?>">
					<button type="button" class="close" data-dismiss="alert" style="margin-left:2px"><span>×</span><span class="sr-only">Close</span></button>
					<?php echo $this->session->flashdata($alert_type); ?>
				</div>
			</div>
		</div>
	<?php } ?>
		<script>
			$(".alert").fadeTo(2000, 500).slideUp(500, function(){
   				$(".alert").slideUp(3000);
			});

		</script>