<?php get_header(); 

if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	$role = $user->roles[0];

	if( is_super_admin() ) : 
		// super admin
		$max = '10';
	else:
		// subscriber, contributor, author, etc
		$t = get_user_meta($user_id);
		$subs = $t['user_type'][0];
		$exp_date = $t['expiration_date'][0];

		if($subs == 'paid'){
			$max = '10';
		}elseif($subs == 'trial'){
			$max = '10';
		}else{
			$max = '5';
		}
	endif;
else:
	$max = '2';
endif;
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
	<?php
	$currCat = get_queried_object();
	$cat_name = $currCat->name;
	$slug = $currCat->slug;
	$cat_id   = get_cat_ID( $cat_name );

	// $custom_terms = get_terms('newspapers');
	$custom_terms = get_terms($currCat->taxonomy);
	?>

	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="">Home</a></span> /
					<span><?= ucfirst($currCat->taxonomy); ?></span> /
					<span><?= $cat_name; ?></span>
			</div>
		</div>
	</div>

	<?php
	echo '<div class="container mt-4">';
		echo '<div class="row">';
			echo '<div class="col-md-3 tax-heading ml-3">';
				echo '<h4>'.$currCat->name.'</h4>';
			echo '</div>';
		echo '</div>';
	echo '<div>';

	?>
	<div class="container cards mb-4">

		<div class="row">
		<?php
			
// foreach($custom_terms as $custom_term) {
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
	   $paged = 1;
	}

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

		<div class="col-md-12 card p-2 mb-5" style="border-bottom: 2px solid lightgrey;">
			
			
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
						<div class="col-md-12">
						<p class="">
							<span class="float-left"><i class="fa fa-hourglass-end fa-red" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span><?php
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
						}
						?></span></span>	
						</p></div>
					</div>

				</div>
			</div>
		</div>

<?php endwhile; else:
	echo '<div class="card col-md-12 col-sm-12 p-3">';
		echo "<h4>No Posts Available</h4>";
	echo '</div>';
endif;

// pagination
		if( is_super_admin() || $role == 'author' || $role == 'contributor' || $role == 'editor' ) : 
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

		// subscription status
		if($user){
			if($subs == 'trial'){
			echo '<div class="col-md-12 col-sm-12 info-trial p-2">';
				echo "<p><b>Please Upgrade to View More Tenders</b></p>";
				echo '<p>Your Expiration Date is: <b>'.$exp_date.'</b></p>';
			echo '</div>';
			}elseif($subs == 'expired'){
			echo '<div class="col-md-12 col-sm-12 info-trial p-2">';
				echo "<p><b>Your Subscription has Expired.</b></p>";
				echo '<p>Please Renew Your Subscription to access further services.</b></p>';
			echo '</div>';
			}
		}else{
			echo '<div class="col-md-12 col-sm-12 info-free-trial p-2">';
				echo '<p><b>Please Sign Up to View More Tenders</b></p>';
			echo '</div>';
		}
     
 	// }else{
 	// 	$err++;
 		// echo "no  cate";
 	// } // endif
// }

		// display no posts message
		if($err > 0){ ?>
			<!-- <div class="col-md-12 card" style="min-height: 150px;">
				<h4 class="mt-3">No Posts Available</h4>
			</div> -->
		<?php } ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>