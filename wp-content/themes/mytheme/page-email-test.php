<?php
global $wpdb;
$result = (array) $wpdb->get_results( "SELECT * FROM wp_tender WHERE id IN ( $email_list_string )" );


$args = array (
    'cat' => array(),
    'orderby' => 'date',
    'posts_per_page' => 20					    		
 	);
$cat_posts= new WP_query($args);

global $table_result;
$table_result = $cat_posts;

// get_template_part( 'inc/tender', 'email-master' );
// include('inc/tender-email-master.php');
require( 'inc/tender-email-master-updated.php' );

?> 


