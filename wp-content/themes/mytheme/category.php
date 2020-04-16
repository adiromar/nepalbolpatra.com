<?php get_header(); 

$user_id = get_current_user_id();
$user = get_userdata( $user_id );

$t = get_user_meta($user_id);
$subs = $t['user_type'][0];
if($user){
	if($subs == 'trial'){
		$max = '2';
	}else{
		$max = '-1';
	}
}else{
	$max = '2';
}
$exp_date = $t['expiration_date'][0];

// category
$currCat = get_category(get_query_var('cat'));
$cat_name = $currCat->name;
$cat_id   = get_cat_ID( $cat_name );

$current_page = get_queried_object();
$category     = $current_page->post_name;

// print_r($current_page);
$tag_id = $current_page->term_id;

?>
<style type="text/css">
	.brd-crm span{
		font-size: 14px;
		color: var(--blue);
	}
	.tax-heading{
		background: #0070b8;
    	border-color: #0070b8;
    	text-align: center;
    	padding: 4px;
	}
	.tax-heading h4{
		color: #fff;
	}
</style>
<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home</a></span> /
					<span>Category</span> /
					<span><?= $cat_name; ?></span>
			</div>
		</div>
	</div>

	<?php
	echo '<div class="container mt-4">';
		echo '<div class="row">';
			echo '<div class="col-md-3 tax-heading ml-3">';
				echo '<h4>'.$cat_name.'</h4>';
			echo '</div>';
		echo '</div>';
	echo '<div>';

	?>
	<div class="container cards mb-4" style="min-height: 200px;">
		<div class="row">
		<?php
// 		  if ( ! function_exists( 'pagination' ) ) :
//     function pagination( $paged = '', $max_page = '' )
//     {
//         $big = 999999999; // need an unlikely integer
//         if( ! $paged )
//             $paged = get_query_var('paged');
//         if( ! $max_page )
//             $max_page = $wp_query->max_num_pages;

//         echo paginate_links( array(
//             'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link( $big ))),
//             'format'     => '?paged=%#%',
//             'current'    => max( 1, $paged ),
//             'total'      => $max_page,
//             'mid_size'   => 1,
//             'prev_text'  => __('«'),
//             'next_text'  => __('»'),
//             'type'       => 'list'
//         ) );
//     }
// endif;

		// $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
		   $paged = 1;
		}

        $query = new WP_Query( 
            array(
                'paged'         => $paged, 
                // 'category_name' => $category,
                'cat'       => array($tag_id),
                'order'         => 'desc',
                'post_type'     => 'post',
                'post_status'   => 'publish',
                'posts_per_page' => 2,
            )
        );

		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

			$cat_id = get_the_ID();

			$category = wp_get_post_terms( $cat_id, 'category');
			$cc = count($category);
			$cnames = array();
			for ($i=0; $i < $cc; $i++) { 
				$cname = $category[$i]->name;
				$cnames[] = $cname;
			}
			$cat_names = implode(', ', $cnames);

			$papers = wp_get_post_terms( $cat_id, 'newspapers'); 
			$papc = count($papers);
			$ppnames = array();
			for ($i=0; $i < $papc; $i++) { 
				$papname = $papers[$i]->name;
				$ppnames[] = $papname;
			}
			$paper_names = implode(', ', $ppnames);

			$ind = wp_get_post_terms( $cat_id, 'industries'); 
			$ic = count($ind);
			$inames = array();
			for ($i=0; $i < $ic; $i++) { 
				$iname = $ind[$i]->name;
				$inames[] = $iname;
			}
			$ind_names = implode(', ', $inames);

			$prod = wp_get_post_terms( $cat_id, 'products');
			$pc = count($prod);
			$pnames = array();
			for ($i=0; $i < $pc; $i++) { 
				$pname = $prod[$i]->name;
				$pnames[] = $pname;
			}
			$pro_names = implode(', ', $pnames);

			$publisher = get_post_meta( $cat_id, 'publisher' , true );
			$published_date = get_post_meta( $cat_id, 'published_date' , true );
			$p_date = get_post_meta( $cat_id, 'submission_date_eng' , true );
			$expiry = get_post_meta( $cat_id, 'expiry_date' , true );

			$today = new DateTime(date("Y-m-j"));

			?>

			<div class="col-md-12 col-sm card p-2 mb-3"  style="border-bottom: 2px solid lightgrey;">
			<div class="row mb-4">
				<div class="col-md-3">
					<?php if (has_post_thumbnail()) : ?>
					<figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
				<?php else:
					echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main" width="200" height="150">';
				endif; ?>
				<a href="<?= the_permalink(); ?>" class="btn btn-primary btn-sm"><u>View Notice</u></a>
				</div>
				<div class="col-md-9">
					<h5><a href="<?= the_permalink()?>"><?= get_the_title(); ?></a></h5>
					<?php echo mb_strimwidth(get_the_content(), 0, 190, '...'); ?>

					<div class="row">
						<div class="col-md-12">
						<p>
							<span class="float-left"><i class="fa fa-list-ul "></i></span>
							<span class="ml-4 float-left"><span><?= $cat_names; ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="">
							<span class="float-left"><i class="fa fa-paper-plane"></i></span>
							<span class="ml-4 float-left"><span><?= $paper_names; ?></span></span>	
						</p></div>

						<div class="col-md-12">
						<p class="">
							<span class="float-left"><i class="fa fa-calendar"></i></span>
							<span class="ml-4 float-left"><span><?= $published_date; ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="">
							<span class="float-left"><i class="fa fa-calendar" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span><?= $expiry; ?></span></span>	
						</p></div>
					</div>

				</div>
			</div>
			</div>

		<?php endwhile; 
		

		else:
			echo '<div class="col-md-12 card" style="min-height: 150px;">';
				echo "<h5 class='p-2'>No Posts Found</h5>";
			echo '</div>';
		endif;

		// echo '<div class="col-md-12">';
		// pagination( $paged, $query->max_num_pages);
		// echo '</div>';

		echo '<div class="col-md-12 mt-3 pb-3" style="text-align: center;">';
			wpbeginner_numeric_posts_nav();
		echo '</div>';
		
		?>
		
		<!-- Alternative Method -->
		<!-- <div class="pagination">
		    <?php 
		        echo paginate_links( array(
		            // 'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
		            // 'base' => preg_replace('/\?.*/', '/', get_pagenum_link( 999999999 )) . '%_%',
		            'total'        => $query->max_num_pages,
		            'current'      => max( 1, get_query_var( 'paged' ) ),
		            // 'format'       => '?paged=%#%',
		            'format' => '?page=%#%',
		            'show_all'     => true,
		            'type'         => 'plain',
		            'end_size'     => 2,
		            'mid_size'     => 1,
		            'prev_next'    => true,
		            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
		            'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
		            'add_args'     => false,
		            'add_fragment' => '',
		        ) );
		    ?>
		</div> -->

<?php
		// reset post query
		wp_reset_postdata();

		if($user){
			if($subs == 'trial'){
			echo '<div class="col-md-12 col-sm-12 info-trial pt-2">';
				echo "<p><b>Please Upgrade to View More Tenders</b></p>";
				echo '<p>Your Expiration Date is: <b>'.$exp_date.'</b></p>';
			echo '</div>';
			}
		}else{
			echo '<div class="col-md-12 col-sm-12 info-free-trial pt-2">';
				echo '<p><b>Please Sign Up to View More Tenders</b></p>';
			echo '</div>';
		}

		 ?>
		</div>

	</div>
</section>


<?php get_footer(); ?>