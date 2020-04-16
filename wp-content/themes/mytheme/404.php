<?php


get_header(); ?>

	

	<section class="hero-section-1 bg-image-section">
		<div class="container">
			<div class="row">
				<?php 
						$class='col-md-12';
				?>

				
				<div class="<?php echo esc_attr($class);?>" style="margin-top: 50px;">
					<div class="not-found">
						<h3><?php esc_html_e( 'OOPS, This page could not be found!', 'engager' ); ?></h3>
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links on the menu or Login and Try Again!.', 'engager' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .page-content -->
				</div>

				

			</div><!-- row -->
		</div><!-- container -->
	</section><!-- section -->
<?php
get_footer(); ?>
