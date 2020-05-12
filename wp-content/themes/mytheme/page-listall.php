<?php get_header(); 
global $maxx;

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

$maxx = $max;
?>

<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<div class="col-md-3 col-sm-12">
					<span><a href="<?= home_url(); ?>">Home/</a></span>
					<span>List All</span>
				</div>
				<div class="col-md-5 col-sm-12">
				<?php
				if( !is_user_logged_in() ) : ?>

				<div class="alert-bx" id="mydiv">
			        <h6 style="color:#fff;"><strong>Please Register for more tenders. </strong> <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#register_Modal" style="color: #fff;"><strong><u>Register Here</u></strong></a> </h6> 
			     </div>

				<?php endif; ?>
				</div>

				<div class="col-md-4 col-sm-12">
					<?php get_search_form(); ?>
				</div>
				
			</div>
		</div>
	</div>

	
<?php
	if( is_user_logged_in() ) : 
		if( is_super_admin() || $role == 'author' || $role == 'contributor' || $role == 'editor' ) : 
			// if super admin or author/contributor
		else: 
			if($subs == 'trial'){ ?>
				<div class="container mt-3">
					<div class="alert alert-secondary alert-dismissible fade show" role="alert">
					  <strong>Trial Version</strong> Please Upgrade to View More Tenders.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
			<?php }elseif($subs == 'expired'){ ?>
				<div class="container mt-3">
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Subscription Expired </strong> Please Renew Your Subscription to access further services.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
			<?php }else{ ?>
				<div class="container mt-3">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Paid Membership !</strong> Your Membership Expires on <?= $exp_date; ?>.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
			<?php }
		endif;

		else: ?>
		<div class="container mt-3">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Subscribe TenderNepal !</strong> Please Sign Up to View More Tenders.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		</div>
		<?php endif;
	?>

<div class="container mt-4">
		<div class="row">';
			<div class="col-md-3 tax-heading">
				<h4>List All Tenders</h4>
			</div>
		</div>
</div>

	<div class="container card">
	<?php
	if( is_user_logged_in() ) : 
		echo '<div class="row p-3">';
			get_template_part( 'template-parts/content', 'listall-normal' );
		echo '</div>';
	else:
		echo '<div class="row p-3">';
			get_template_part( 'template-parts/content', 'home-list' );
		echo '</div>';
	endif;

	?>
	</div>
</section>

<?php get_footer(); ?>