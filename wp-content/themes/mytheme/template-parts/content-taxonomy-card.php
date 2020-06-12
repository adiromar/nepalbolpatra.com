<!-- <div class="row p-3"> -->
		<?php
			
// foreach($custom_terms as $custom_term) {
	if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
		   $paged = 1;
		}

$currCat = get_queried_object();
	$cat_name = $currCat->name;
	$slug = $currCat->slug;
	$cat_id   = get_cat_ID( $cat_name );

	// $custom_terms = get_terms('newspapers');
	$custom_terms = get_terms($currCat->taxonomy);

    // wp_reset_query();
    $args = array(
    	'paged'         => $paged, 
    	'post_type' => 'post',
    	'posts_per_page' => $max,
        'tax_query' => array(
            array(
                'taxonomy' => $currCat->taxonomy,
                'field' => 'slug',
                'terms' => $slug,
                
            ),
        ),
     );
    // echo $custom_term->name;echo $currCat->taxonomy;
    // if($custom_term->slug == $slug){

     $query = new WP_Query($args);
     if($query->have_posts()) : 
		while($query->have_posts()) : $query->the_post();
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
			// print_r($papers);
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
			if($p_date){
		        $sd = DateTime::createFromFormat( "Y-m-d", $p_date )->settime(0,0);
		        $diff = $today->diff($sd)->format("%R%a");
			}
     	?>

		<div class="col-md-4 cards mb-5 p-2" style="border-bottom: 1px solid darkgrey;">
			
			
			<div class="row mb-4">
				<div class="col-md-3">
					<?php if (has_post_thumbnail()) : ?>
					<figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(80, 80), array('class' => 'post-thumbnail-main')); ?></a> </figure>
				<?php else:
					echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main" width="80" height="80">';
				endif; ?>
				<!-- <a href="<?= the_permalink(); ?>" class="btn btn-primary btn-sm"><u>View Notice s</u></a> -->
				</div>
	
				<div class="col-md-9">
					<h5><a href="<?= the_permalink()?>"><?= get_the_title(); ?></a></h5>
					<?php //echo mb_strimwidth(get_the_content(), 0, 190, '...'); ?>

					<div class="row">
						<div class="col-md-12" style="overflow: hidden;">
							<div class="row">

						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-address-card"></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($publisher, 0, 15, '...'); ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-list-ul "></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($cat_names, 0, 15, '...'); ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-paper-plane"></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($paper_names, 0, 15, '...'); ?></span></span>	
						</p></div>

						<!-- <div class="col-md-12">
						<p class="">
							<span class="float-left"><i class="fa fa-calendar"></i></span>
							<span class="ml-4 float-left"><span><?= $published_date; ?></span></span>	
						</p></div> -->
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-calendar" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span><?= $expiry; ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-hourglass-end" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span>
							<?php
							if( $diff >= 0){
							switch ( substr( $diff, 1 ) ) {
								case 0:
									echo 'Ending Today';
									break;

								case 1:
									echo substr( $diff, 1 ) . ' day';
									break;

								default:
									echo substr( $diff, 1 ) . ' days';
									break;
								}
							} else {
								echo "<span style='color:red'>Expired</span>";
							} ?>
							</span></span>	
						</p></div>

	</div>
</div>
<!-- <div class="col-md-6" style="border-left: 1px dashed lightgrey;text-align: justify;">
	<?php// echo mb_strimwidth(get_the_content(), 0, 110, '...'); ?>
</div> -->
					</div>

				</div> <!-- col-9 ends  -->
			</div>
		</div>

<?php endwhile; else:
echo '<div class="card col-md-12 col-sm-12 p-3">';
	echo "<h4>No Posts Available</h4>";
echo '</div>';
endif;

	// pagination
		if( is_super_admin() ) : 
				echo '<div class="col-md-12 mt-3 pb-3" style="text-align: center;">';
					wpbeginner_numeric_posts_nav();
				echo '</div>';
		endif;
		if ($user) :
			if($subs == 'paid') :
				echo '<div class="col-md-12 mt-3 pb-3" style="text-align: center;">';
					wpbeginner_numeric_posts_nav();
				echo '</div>';
			elseif($subs == 'trial') :
				// nothing
			else:
				// nothing
			endif;
		else:
			// nothing
		endif;

		
		// reset post data
		wp_reset_postdata();
     
 	// }else{
 		// $err++;
 		// echo "no  cate";
 	// } // endif
// }

		// display no posts message
		if($err > 0){ ?>
			<!-- <div class="col-md-12 card" style="min-height: 150px;">
				<h4 class="mt-3">No Posts Available</h4>
			</div> -->
		<?php } ?>

		<!-- </div> -->