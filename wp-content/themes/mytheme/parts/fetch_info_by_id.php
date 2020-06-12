<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
global $wp_query;

// echo "hello box";
// print_r($_POST);
$post_id = $_POST['post_id'];

$args = array (
	'post__in' => array($post_id),
	'posts_per_page' => 1					    		
		);
$cat_posts = new WP_query($args);
if ( $cat_posts->have_posts() ) : while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
?>
<div class="modal-header">
        <h5 class="modal-title"><?php the_title(); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>

<div class="modal-body">
<?php if (has_post_thumbnail()) :  
?>
<figure> <a href="" ><?php the_post_thumbnail('full', array('class' => 'post-thumbnail-main')); ?></a> </figure>

<?php else: ?>
	<h6>No Image Available</h6>
<?php endif; ?>
</div>

<?php endwhile;endif; ?>