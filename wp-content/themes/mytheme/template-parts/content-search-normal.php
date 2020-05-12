<?php  
if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	$role = $user->roles[0];

	if( is_super_admin() || $role == 'Editor' || $role == 'Subscriber' || $role == 'Contributor') : 
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
			$max = '10';
		}
	endif;
else:
	$max = '20';
endif;

        if(isset($_GET['s'])) : 
        	$search=$_GET['s'];

        	$argss = array(  
    			's' => $search,
    			'post_type' => 'post',
    			'post_status' => 'publish',
    			'posts_per_page' => $max,
			);

        $sn = 1;
		$query = new WP_Query( $argss );
		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

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
			if($p_date){
				$sd = DateTime::createFromFormat( "Y-m-d", $p_date )->settime(0,0);
				$diff = $today->diff($sd)->format("%R%a");
			}
			if($diff <=2){
		?>
		<div class="card mb-3 p-3">
			<div class="row cards mb-3">
			<div class="col-md-3 post-thumbnail-mains pl-3">
					<?php if (has_post_thumbnail()) : ?>
					<figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
				<?php else:
					echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-mains" width="200" height="150">';
				endif; ?>
				<a href="<?= the_permalink(); ?>" class="btn btn-primary btn-sm"><u>View Notice</u></a>
			</div>
			<div class="col-md-9">
				<h5><a href="<?= the_permalink()?>"><?= get_the_title(); ?></a></h5>
				<!-- <?php echo mb_strimwidth(get_the_content(), 0, 190, '...'); ?> -->
	
					<div class="row">
						<div class="col-md-6">
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
					<div class="col-md-6" style="text-align: justify;border-left: 1px solid lightgrey;">
						<?php echo mb_strimwidth(get_the_content(), 0, 300, '...'); ?>
					</div>
				</div> <!-- ends row -->

				<h5><a href="<?php the_permalink();?>">पूरा पढ्नुहोस्</a></h5>
			</div>


			<?php //the_post_thumbnail('thumbnail') ;?>
			 <!-- <h3 class="title"><a href="<?php the_permalink();?>"><?php echo $sn++.'.' ;?><?php the_title();?></a></h3>
			<p><?php echo substr(strip_tags($post->post_content), 0, 800);?></p>
			<h5><a href="<?php the_permalink();?>">पूरा पढ्नुहोस्</a></h5> -->
			</div>
		</div>
		
		<?php 
		} // end of checking number of days for not logged in users
	endwhile; else : ?>

	<div class="col-md-12 card mb-3 p-3">
			<p>Sorry Nothing found related to '<?php echo $search ;?>'.</p>
			</div>
		<?php endif; ?>

		<?php endif; ?>