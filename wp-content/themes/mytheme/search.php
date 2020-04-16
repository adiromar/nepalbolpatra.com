<?php get_header(); 

$user_id = get_current_user_id();
$user = get_userdata( $user_id );
$name = $user->user_login;

// echo $name;
// print_r($user);die;

$t = get_user_meta($user_id);

// echo '<pre>';
// print_r($t);

$subs = $t['user_type'][0];
if($user){
	if($subs == 'trial'){
		$max = '10';
	}else{
		$max = '-1';
	}
}else{
	$max = '2';
}
$exp_date = $t['expiration_date'][0];
?>

<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<div class="col-md-8 col-sm">
					<spam><a href="<?= home_url(); ?>">Home /</a></span>
					<span> Search /</span>
					<span><?= get_the_title(); ?></span>
				</div>
				<div class="col-md-4 col-sm">
					<?php get_search_form(); ?>
				</div>
				
			</div>
		</div>
	</div>


	<div class="container mt-4">

		<div class="row">
			<div class="col-md-12">
				<h4>Search Results:</h4>
			</div>
			

			<div class="col-md-12 p-3">
        <?php  
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
		?>
		<div class="card mb-3 p-3">
			<div class="row cards mb-3">
			<div class="col-md-3 post-thumbnail-mains p-1">
					<?php if (has_post_thumbnail()) : ?>
					<figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
				<?php else:
					echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-mains" width="200" height="150">';
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

				<h5><a href="<?php the_permalink();?>">पूरा पढ्नुहोस्</a></h5>
			</div>


			<?php //the_post_thumbnail('thumbnail') ;?>
			 <!-- <h3 class="title"><a href="<?php the_permalink();?>"><?php echo $sn++.'.' ;?><?php the_title();?></a></h3>
			<p><?php echo substr(strip_tags($post->post_content), 0, 800);?></p>
			<h5><a href="<?php the_permalink();?>">पूरा पढ्नुहोस्</a></h5> -->
			</div>
		</div>
		
		<?php 

	endwhile; else : ?>
	</div>

			<div class="col-md-12 card mb-3 p-3">
			<p>Sorry Nothing found related to '<?php echo $search ;?>'.</p>
			</div>
		<?php endif; ?>

		<?php endif;
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
        <!-- </main> -->

		</div>
	</div>
</section>

<script src="<?php bloginfo('template_url') ?>/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
// load sign up modal
<?php if($user){ ?>
	// do nothing
<?php }else{ ?>
setTimeout(function() {
	console.log('timeout delay');
    $('#login_Modal').modal('show');

}, 3000);
<?php } ?>

</script>
<?php get_footer(); ?>