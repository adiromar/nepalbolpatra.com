<?php 
if( ! is_super_admin() )
{
 auth_redirect();
}
if (!is_user_logged_in()) {
	auth_redirect();
}
get_header(); ?>

<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home</a></span> /
					<span>Notification</span>
			</div>
		</div>
	</div>


	<div class="container">
		
		<div class="row mt-3 card p-3">
			<div class="col-md-12 col-sm-12 mb-2">
				<h4>Vouchers</h4>
			</div>
					<div class="col-md-8 col-md-offset-2">
			<table class="table table-striped table-hover table-bordered" style="background-color: lightblue;">
				<thead>
					<tr>
						<th>S.N.</th>
						<th>E-mail Address</th>
						<th>Transaction Date</th>
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
							<th><?= $key['inserted_date']; ?></th>
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
</section>

<?php get_footer(); ?>