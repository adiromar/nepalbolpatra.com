<?php get_header(); ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php
				if(have_posts()) : 

				while(have_posts()) : the_post();

				the_content();
				endwhile;
				endif;
				?>
			</div>
		</div>
	</div>
</section>



<?php get_footer(); ?>