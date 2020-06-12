<?php 
/**
 * Template Name: Search Page
 */


get_header();
?> 
<section class="hero-section-1">
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <?php get_search_form(); 
        if(isset($_GET['s'])) : 
        	$search=$_GET['s'];
        	$args = array(
    			'post_title_like' => $search
			);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
		?>
		<div class="col-md-12">
			<?php the_post_thumbnail('thumbnail') ;?>
			 <h3 class="title"><a href="<?php the_permalink();?>"><?php echo $sn++.'.' ;?><?php the_title();?></a></h3>
			<p><?php echo substr(strip_tags($post->post_content), 0, 800);?></p>
			<h5><a href="<?php the_permalink();?>">पूरा पढ्नुहोस्</a></h5>
		</div>
		
		<?php endwhile; else : ?>
			<p>Sorry Nothing found related to '<?php echo $search ;?>'.</p>
		<?php endif; ?>

		<?php endif; ?>
        </main>
    </div>
</div>
</section>



<?php get_footer(); ?>