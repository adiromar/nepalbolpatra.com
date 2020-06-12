<?php
/**
 * Template Name: Tender By Category Page
 */
get_header();
 ?>
 <style type="text/css">
 	.cat-lists{
 		border: 1px dotted lightgrey;
 		padding: 8px;
 	}	
 </style>

<section class="hero-section-1 main-pg-section">

	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home</a></span> /
					<span>List By Category</span>
			</div>
		</div>
	</div>

	<div class="container cards mt-4 mb-4">
		<div class="card p-3">
		<div class="row">
			
				<?php
				$args = array(
					'hide_empty' => false,
				);

				$category = get_categories($args);
				// $category = wp_list_categories($args);

				// echo '<pre>';
				// 	print_r($category);
				// echo '</pre>';die;
				// print_r($term);
				echo '<h6 class="col-md-12 col-sm ">Category<hr></h6>';
				foreach ($category as $val) {
					echo '<div class="col-md-2 cat-lists">';
						echo '<div class="row">';
							echo '<div class="col-md-12">';
						if ( z_taxonomy_image_url($val->term_id) ){
							?>
							<a href="<?php echo esc_url( get_term_link( $val ) ) ?>"><img src="<?= z_taxonomy_image_url($val->term_id); ?>" width="180" height="120"></a>
							
							<?php }else{ ?>
								<a href="<?= get_category_link($val->term_id) ?>"><img src="<?= get_template_directory_uri() ?>/img/unnamed.png" class="post-thumbnail-mains mb-3" width="180" height="120"></a>
						<?php } 
							echo '</div>';
							echo '<div class="col-md-12 cat-list">';

								echo '<a href="'.get_category_link($val->term_id).'">'.$val->name.'</a>';
								echo '<p>Total Posts : '.$val->category_count.'</p>';
							echo '</div>';
							echo '</div>';
					echo '</div>';
				}
				?>
			</div>
		</div>


		<?php
		// list the taxonomy
		$tax = array('newspapers','products','industries');
		?>
		<div class="card mt-4 p-3">
			<div class="row">
				<?php
				foreach ($tax as $val) {
					// get the terms of taxonomy
					$terms = get_terms( $val, $args = array(
					  'hide_empty' => false, // do not hide empty terms
					));

					// echo '<pre>';
					// print_r($terms);
					echo '<h6 class="col-md-12 col-sm mt-3" id="'.$val.'">'.strtoupper($val).'<hr></h6>';
					foreach ($terms as $term) {
						$term_link = get_term_link( $term );

						echo '<div class="col-md-2 cat-lists" >';
							echo '<div class="row">';
							echo '<div class="col-md-12">';
							if ( z_taxonomy_image_url($term->term_id) ){
							?>
							<a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><img src="<?= z_taxonomy_image_url($term->term_id); ?>" width="180" height="120"></a>
							
							<?php }else{ ?>
								<img src="<?= get_template_directory_uri() ?>/img/unnamed.png" class="post-thumbnail-mains mb-3" width="180" height="120">
						<?php } 
							echo '</div>';

							echo '<div class="col-md-12 cat-list">';
								echo '<a href="' . esc_url( $term_link ) . '">' . $term->name .'</a>';
								echo '<p>Total Posts : '.$term->count.'</p>';
							echo '</div>';

							echo '</div>';

						echo '</div>';
					}
				}

				?>
			</div>
		</div>
	</div>


</section>


<script src="<?php bloginfo('template_url') ?>/js/jquery-3.2.1.min.js"></script>
 <?php get_footer(); ?>