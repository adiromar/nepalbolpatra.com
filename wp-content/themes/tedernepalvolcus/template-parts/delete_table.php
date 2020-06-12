<?php
/**
 * Template Name: DELETE TABLE
 *
 */

 // get_header();
 global $wpdb;

 if ($_GET['tender_id']) {
 	$id = $_GET['tender_id'];
 } else {
  echo "No POST id selected.";
  die();
 }

 $result = $wpdb->get_results( "SELECT * FROM wp_tender WHERE id = {$id}" );
 $result = (array) $result['0'];

   $table_name = $wpdb->prefix . "tender";

   unlink(wp_upload_dir()['basedir'] . '/' . $result['image']);
   $entry = $wpdb->delete($table_name, array('id'=>"{$id}"));

   if ($entry) {
     wp_redirect( "http://encoderslab.com/tendernepalvolcus/show-table" ); exit;
   }
?>
   <div class="wrap">
   	<div id="primary" class="content-area">
   		<main id="main" class="site-main" role="main">

   			<?php
   			while ( have_posts() ) : the_post();

   				get_template_part( 'template-parts/page/content', 'page' );

   				// If comments are open or we have at least one comment, load up the comment template.
   				if ( comments_open() || get_comments_number() ) :
   					comments_template();
   				endif;

   			endwhile; // End of the loop.
   			?>

   		</main><!-- #main -->
   	</div><!-- #primary -->
   </div><!-- .wrap -->

<?php
 get_footer();
