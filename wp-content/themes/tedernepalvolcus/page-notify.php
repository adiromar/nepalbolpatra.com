<?php 
if( ! is_super_admin() )
{
 auth_redirect();
}
if (!is_user_logged_in()) {
	auth_redirect();
}

get_header();
?>

<!--
  ====================================
    END MODAL
  ====================================
-->
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-striped table-hover table-bordered" style="margin-top: 150px; background-color: lightblue;">
				<thead>
					<tr>
						<th>S.N.</th>
						<th>E-mail Address</th>
						<th>View Voucher</th>
					</tr>
				</thead>
					<?php 
						$i = 1; 
						global $wpdb;
						$result = $wpdb->get_results( "SELECT * FROM wp_voucher LIMIT 0,10",ARRAY_A );
						// echo "<br><br><br><br>";
						// print_r($result);
					if($result){
						foreach ($result as $key) {
					
					?>
						<tr>
							<th><?php echo $i; $i++; ?></th>
							<th><?= $key['email'] ?></th>
							<th>
							<a href="<?php echo wp_upload_dir()['baseurl'] . '/vouchers/' . $key['voucher'] ?>" target="_blank">
								<img src="<?php echo wp_upload_dir()['baseurl'] . '/vouchers/' . $key['voucher'] ?>"
                        			alt="<?php echo $key['email'] ?>"
                        			style="max-height: 100px; max-width: 50px; cursor: pointer;">
                    		</a>
							</th>
						</tr>
					<?php 
						}
					}else{
						?>
						<tr>
							<th></th>
							<th>There are no notifications.</th>
							<th>-</th>
						</tr>
						<?php
					}
					?>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

</body>
</html>