<?php get_header(); ?>


<section class="hero-section-1 spad">
	<div class="container">
		<?php 

		$date = date("Y-m-d");
			$args = array (
					    // 'cat' => array(),
					    'orderby' => 'meta_value_num',
					    'order' => 'ASC',
					    'posts_per_page' => 1,
					    'meta_query' => array(
					        array(
					            'key' => 'submission_date_eng',
					            'value' => $date,
					            'type' => 'DATE',
								'compare' => '<=',
					        	)		    		
				 			)					    		
					 	);
			$cat_posts= new WP_query($args);
if ( $cat_posts->have_posts() ) : while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
			?>
			<div class="sing-post col-md-3">
				<h1><?= the_title(); ?></h1>

				<p><?= the_excerpt(); ?></p>
			</div>



		<?php 
echo do_shortcode('[ajax_load_more repeater="" post_type="post, ajax_more" transition="fade" transition_speed="350" images_loaded="true" preloaded="true" preloaded_amount="4" posts_per_page="4" pause="true" pause_override="true" css_classes="flex"]');

	endwhile; endif; 

		


?>

	</div>
</div>

<?php get_footer('other'); ?>