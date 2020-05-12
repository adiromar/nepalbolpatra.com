<?php

	global $wp_version;

	if ( $wp_version >= 4.1 ) :

		the_posts_pagination( array( 'prev_text' => __( 'Previous', 'tender' ), 'next_text' => __( 'Next', 'tender' ) ) );
	
	endif;

?>