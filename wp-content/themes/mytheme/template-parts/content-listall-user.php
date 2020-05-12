<?php
if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	$role = $user->roles[0];

	if( is_super_admin() || $role == 'Editor' || $role == 'Subscriber' || $role == 'Contributor') : 
		// super admin
		$max = '5';
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
			$max = '10';
		}
	endif;
else:
	$max = '20';
endif;

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
	   $paged = 1;
	}
$args = array (
    'cat' => array(),
    'orderby' => 'date',
    'post_type'     => 'post',
    'post_status'   => 'publish',
    'posts_per_page' => $max,
    'paged'         => $paged, 				    		
 	);
$query= new WP_query($args);
if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

			$cat_id = get_the_ID();
			$cat_names = $paper_names = $ind_names = $published_date = $expiry = '-';
				
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

			<div class="col-md-6 col-sm cards mt-3 mb-3 posts p-3" style="border: 1px solid lightgrey;">
				<div class="row">
				<div class="col-md-3 col-sm-4">
					<?php if (has_post_thumbnail()) : 
							if( is_user_logged_in() ) : 
						?>
					<figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
					<?php else: ?>
						<figure> <a href="#" data-toggle="modal" data-target="#login_Modal"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
					<?php endif; ?>

				<?php else:
					if( is_user_logged_in() ) : 
						echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main mb-3" width="200" height="150">';
					else:
						echo '<a href="#" data-toggle="modal" data-target="#login_Modal"><img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main mb-3" width="200" height="150"></a>';
					endif;
				endif; 

				if( is_user_logged_in() ) : 
					echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-sm">View Notice</a>';
				else:
					echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#login_Modal">View Notice</a>';
				endif;
				?>

				</div>
			
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
						<?php 
						if( !is_user_logged_in() ) : ?>
						<h5><a href="#" data-toggle="modal" data-target="#login_Modal" class="hr-btn"><?= the_title(); ?></a></h5>
						<?php else: ?>
							<h5><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></h5>
						<?php endif; ?>

						</div>
						<div class="col-md-12">
							<small><?php echo mb_strimwidth(get_the_content(), 0, 40, '...'); ?></small>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
						<p>
							<span class="float-left"><i class="fa fa-list-ul "></i></span>
							<span class="ml-4 float-left"><span><?= $cat_names; ?></span></span>	
						</p></div>

						<div class="col-md-12">
						<p class="">
							<span class="float-left"><i class="fa fa-address-card"></i></span>
							<span class="ml-4 float-left"><span><?= $publisher; ?></span></span>	
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
							<span class="float-left"><i class="fa fa-hourglass-end fa-red"></i></span>
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

<?php endwhile; endif; 
wp_reset_postdata();
// pagination
		if( is_super_admin() || $role == 'author' || $role == 'contributor' || $role == 'editor') : 
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
				echo '<div class="col-md-12 mt-3 pb-3" style="text-align: center;">';
					wpbeginner_numeric_posts_nav();
				echo '</div>';
			else:
				// nothing
				
			endif;
				
		else:
			// nothing
		endif;

		
		?>