<?php get_header('user'); 

?>

<div class="container">
	<div class="row">
		<div class="col col-md-8 col-md-offset-2">
			<h3 style="margin-top: 100px; border: 2px solid blue; background-color: #31708f; padding: 20px; color: whitesmoke;">Details:</h3>
			<?php 
					global $wpdb;
					$result = (array) $wpdb->get_results(
 						'SELECT DISTINCT orgname FROM `wp_org` LIMIT 15'
 					); 
 			?>
			<form action="" method="post">
			<div class="row">
				<div class="col-md-4">
					<label class="control-label" style="font-size: 18px; margin-top: 10px;">Organizaton Name:</label>
				</div>
				<div class="col-md-8">
					<select name="org" onchange="this.form.submit()" style="width: 100%; padding: 10px; background-color: #8bc34a; color: black; font-size: 15px;">
						<option>Select one..</option>
					<?php 
						if (count($result)) {
						$i = 1;
						foreach ($result as $value_obj) {
							$entry = (array) $value_obj;
					?>
						<option style="background-color: lightgrey" value="<?php echo $entry['orgname']; ?>"><?php echo $entry['orgname']; ?></option>
						
					<?php 
						} }
					?>
					</select>
				</div>
			</div>
			<noscript><input type="submit" value="Submit"></noscript>
			</form>
			
			<?php 
			if ($_POST) { 
				$org = $_POST['org'];
				
				$sql = "SELECT * FROM `wp_sharereport` WHERE organization='$org'";
				
				$results = (array) $wpdb->get_results($sql);
					
					if (count($results)) {
						
						
							?>
						<div class="row">
						<div class="col col-md-12" style="margin-top: 30px">
							<div class="panel panel-success">
							  <div class="panel-heading" style="font-size: 20px; color: black; background-color: lightblue"><?php echo $org ?></div>
							  
							  <div class="panel-body">
							  	<h4>Download Reports:</h4>
							  	<?php 
								foreach ($results as $key) {
								$data = (array) $key; 
							  	?>
							  	<a href="<?php echo wp_upload_dir()['baseurl'] . '/reports/' . $data['file'] ?>" class="btn btn-primary" download>Download <?php echo $data['type'] ?> Report</a>
							  	<?php } ?>
							  </div>
							</div>
						</div>
					</div>
					<?php
						
					}
			?>
				
			<?php }else{ ?>
			<div class="row">
				<div class="col-md-12" style="margin-top: 30px">
					<div class="panel panel-default">
					  <div class="panel-heading">Organization</div>
					  <div class="panel-body">Please select an organization.</div>
					</div>
				</div>
			</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>