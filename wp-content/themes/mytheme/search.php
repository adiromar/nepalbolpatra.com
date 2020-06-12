<?php get_header(); 

// if( is_user_logged_in() ) : 
// 	$user_id = get_current_user_id();
// 	$user = get_userdata( $user_id );
// 	$role = $user->roles[0];

// 	if( is_super_admin() || $role == 'Editor' || $role == 'Subscriber' || $role == 'Contributor') : 
// 		// super admin
// 		$max = '10';
// 	else:
// 		// subscriber, contributor, author, etc
// 		$t = get_user_meta($user_id);
// 		$subs = $t['user_type'][0];		

// 		$exp_date = $t['expiration_date'][0];

// 		if($subs == 'paid'){
// 			$max = '10';
// 		}elseif($subs == 'trial'){
// 			$max = '10';
// 		}else{
// 			$max = '10';
// 		}
// 	endif;
// else:
// 	$max = '10';
// endif;
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

			if( is_user_logged_in() ) : 

				get_template_part( 'template-parts/content', 'search-user' );
			else:

			get_template_part( 'template-parts/content', 'search-user' );
			endif;
			?>


        
	</div>

			

		</div>
	</div>
</section>

<!-- <script src="<?php bloginfo('template_url') ?>/js/jquery-3.2.1.min.js"></script> -->
<script type="text/javascript">
// load sign up modal
<?php if( is_user_logged_in() ) : ?>
	// do nothing
<?php else: ?>
setTimeout(function() {
	console.log('timeout delay');
    $('#login_Modal').modal('show');

}, 3000);
<?php endif; ?>

</script>
<?php get_footer(); ?>