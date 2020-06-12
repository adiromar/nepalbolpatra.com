<?php get_header(); 

if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	if( is_super_admin() ) : 
		// super admin
		$max = '3';
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
	$max = '2';
endif;

// category
$currCat = get_category(get_query_var('cat'));
$cat_name = $currCat->name;
$cat_slug = $currCat->slug;
$cat_id   = get_cat_ID( $cat_name );

$current_page = get_queried_object();
$category     = $current_page->post_name;

// print_r($current_page);
$tag_id = $current_page->term_id;
// echo $currCat->taxonomy;
// echo $cat_slug;
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
	// echo '<div class="container mt-4">';
	// 	echo '<div class="row">';
	// 		echo '<div class="col-md-3 tax-heading ml-3">';
	// 			echo '<h4>'.$cat_name.'</h4>';
	// 		echo '</div>';
	// 	echo '</div>';
	// echo '<div>';

	?>
	<div class="container cards mb-4" style="min-height: 200px;">
		<div class="row mt-4">
			<div class="col-md-3 tax-heading">
				<h4><?= $currCat->name; ?></h4>
			</div>
			<div class="col-md-7">
				
			</div>
			<div class="col-md-2">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#cat_list_view" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list"></i> </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#cat_card_view" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-th-large"></i> </a>
				  </li>
			</ul>
			</div>
		</div>

		<div class="row card tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="cat_list_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="row p-3">
					<?php
					get_template_part( 'template-parts/content', 'taxonomy-list' );
					?>
					</div>
				</div>

				<div class="tab-pane fade" id="cat_card_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="row resp_card p-3">
					<?php
					// get_template_part( 'template-parts/content', 'taxonomy-card' );
					?>
					</div>
				</div>
			</div>

	</div>
</section>

<script type="text/javascript">
	
	$(window).on("load", function () {
		
		var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = 1;
    // $(".more_posts").attr("disabled",true); 
    	taxonomy = <?= $cat_slug; ?>
    	console.log('tax is: '+taxonomy);
        // id = $(this).data("id");

   		$('.loading_img').show();
		var data = {
			'action': 'load_posts_by_cat_ajax',
			'page': page,
			'taxonomy': taxonomy,
		};

		$.post(ajaxUrl, data, function(response){
			$('.resp_card').html(response).hide().fadeIn(1500);
			// $('.loading_img').hide();
			page++;
		});
});
</script>
<?php get_footer(); ?>