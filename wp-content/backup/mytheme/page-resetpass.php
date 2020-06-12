<?php get_header(); ?>


<section class="hero-section-1 main-pg-section">
	<div class="container card p-5">
		<div class="row">
			<?php

			if(have_posts()) : 

			while(have_posts()) : the_post();

				the_content();
			endwhile;
			endif;
			?>
		</div>
		
	</div>

	<p style="color: red; font-size: 15px;"><strong>Note: </strong>The password must be at least 8 characters long including numbers.</p>

</section>

<?php get_footer(); ?>