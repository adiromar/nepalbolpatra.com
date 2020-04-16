<?php get_header(); ?>

<section class="hero-section-1 main-pg-section">
	<div class="container">
		<div class="row">
			<h1>Tender Services</h1>
			<h6 style="color: white; text-align: center;">Saving your bid team time and supporting  your business development</h6>
	
			<?php 
			global $wpdb;
			$table = 'wp_tender';
			$query = "SELECT *  FROM $table WHERE featured='yes' LIMIT 0,6";
			$result = $wpdb->get_results($query);
			if ( count( $result ) ) {
            $i = 1;
            foreach ( $result as $value_obj ) {
           	   $entry = (array) $value_obj;
          		
			?>
			<div class='col-md-6 service_content'>
				
				<a class="pop" href="#"><img src="<?php echo wp_upload_dir()['baseurl'] . '/' . $entry['image'] ?>"
                        alt="<?php echo $entry['publisher'] ?>"
                        style="min-height: 160px; max-width: 165px; cursor: pointer; border: 1px solid grey; padding: 2px;"></a>
				<h4 style="color: #76e276"><?php echo $entry['description']; ?></h4>
				<p style="font-size: 14px; text-align: center;"><span style="color: orange; font-size: 15px;">PUBLISHER: </span><?php echo $entry['publisher'] ?></p>

			</div>
			<?php } } ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>