	<?php
if (isset($_GET['register'])){
          $register = $_GET['register'];  
         
          if($register == 'true') { 
?>
<section class="hero-section-1 main-pg-section">
	<div class="container card">
		<div class="row p-3">
			<h4>User Registration</h4>
			<div class="col-md-12 col-sm-12 mt-4">
				<div class="alert alert-success">Please Check your email and set the password!</div>
			</div>
			
		</div>
	</div>
</section>

<?php }else{ ?>
	<section class="hero-section-1 main-pg-section">
	<div class="container card">
		<div class="row p-3">

			<h4>User Registration</h4>
			<div class="col-md-12 col-sm-12 mt-4">
				<div class="alert alert-warning">Please provide a unique username or email address!</div>
			</div>

			
			
		</div>
	</div>
</section>
<?php } }else{ ?>

	<section class="hero-section-1 bg-image-section full-banner visible-lg" style="background-image: url('<?php bloginfo('template_url') ?>/img/hero-slider/1.jpg');">
		
		<div class="container">
				<h4 class="mt-4" style="color: #fff;text-align: center;">नेपालको 52 पत्रिका मा प्रकाशित टेण्डर हेर्न <a href="#" data-toggle="modal" data-target="#register_Modal" data-dismiss="modal">subscribe</a> गर्नु होला ।</h4>

				<div class="row mt-5 main-sr-box">
					<div class="col-md-12">
						
						<span class="sp-title"><a href="<?= home_url(); ?>/tender-by-category#newspapers">NEWSPAPERS</a></span>
						<span class="sp-title ml-1"><a href="<?= home_url(); ?>/tender-by-category#industries">INDUSTRY</a></span>
						<span class="sp-title ml-1"><a href="<?= home_url(); ?>/tender-by-category#products">PRODUCTS</a></span>
					</div>
					<div class="tabcontents">
						<div id="search-box">
							<form action="<?= home_url(); ?>/search" method="get">
							<input type="text" name="s" class="col-md-8" placeholder="Enter Keyword For Ex. Tender Name ">
							<button onclick="submitSearchForm('1');"><i class="fa fa-search"></i> <span class="searchbtn">Search</span></button>
						</form>
						</div>
					</div>
					
					<div class="col-md-12">
						<a href="<?= site_url() ?>/filter" class="float-right adv_search pt-2">Advance Search</a>
					</div>
				</div>

		</div>
		<div class="hero-sliders owl-carouselss">
			<!-- <div class="hs-item set-bg" data-setbg="img/hero-slider/1.jpg"></div>
			<div class="hs-item set-bg" data-setbg="img/hero-slider/2.jpg"></div>
			<div class="hs-item set-bg" data-setbg="img/hero-slider/3.jpg"></div> -->
		</div>
	</section>
	<!-- Hero Section end -->

	<!-- Why Section end -->
	<section class="why-section pb-4">
		<div class="container">
			<div class="text-center mb-4 pb-2">
				<h2>Newspapers</h2>
			</div>
			<div class="row">

<?php
// Get the taxonomy's terms
$terms = get_terms(
    array(
        'taxonomy'   => 'newspapers',
        'hide_empty' => false,
        'order'         => 'desc',
    )
);

// Check if any term exists
if ( ! empty( $terms ) && is_array( $terms ) ) {
    // Run a loop and print them all
    foreach ( $terms as $term ) { 
    	// $cat_image = get_field('category_image', $term);
?>
				<div class="col-md-2">
					<div class="icon-box-item">
						<div class="row">
						<div class="ib-icon">
							<!-- <i class="flaticon-012-24-hours"></i> -->
							<?php 
							if ( z_taxonomy_image_url($term->term_id) ){
							?>
							<a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><img src="<?= z_taxonomy_image_url($term->term_id); ?>" ></a>
						<?php }else{ ?>
							<i class="flaticon-012-24-hours"></i>
						<?php } ?>
						</div>
						<div class="ib-text">
							<h5><a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?= $term->name; ?></a></h5>
						</div>
						</div>
					</div>
				</div>

<?php
 		}
	}
?>

				
			
			</div>

			<div class="text-center pt-3">
				<a href="<?= home_url()?>/tender-by-category" class="site-btn sb-big">View More</a>
			</div>
		</div>
	</section>
	<!-- Why Section end -->


	<!-- CTA Section end -->
	<section class="cta-section set-bg" data-setbg="<?php bloginfo('template_url') ?>/img/cta-bg.jpg">
		<div class="container">
			<h2>Latest <strong>Tenders</strong> Online </h2>
			<div class="row">
			<?php 
			$args = array (
					    'cat' => array(),
					    'orderby' => 'date',
					    'posts_per_page' => 6					    		
					 	);
			$cat_posts= new WP_query($args);

			// echo '<pre>';
			// 	print_r($cat_posts);
			// echo '</pre>';
			if ( $cat_posts->have_posts() ) : while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
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
			<!-- <div class="col-md-6 col-sm card mt-3 mb-3 posts ">
				<div class="row">
				<div class="col-md-6 col-sm-8">
					<div class="row">
						<div class="col-md-12">
							<h5><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></h5>
						</div>
						<div class="col-md-12">
							<small><?= the_excerpt(); ?></small>
						</div>
					</div>
					
					
				</div>
			
				<div class="col-md-6">
					<table class="table" style="line-height: 0.8px;">
						<tr>
							<th class="tbl-name">Category</th>
							<td class="tbl-data"><?= $cat_names; ?></td>
						</tr>
						<tr>
							<th class="tbl-name">Newspapers</th>
							<td class="tbl-data"><?= $paper_names; ?></td>
						</tr>
						<tr>
							<th class="tbl-name">Industry</th>
							<td class="tbl-data"><?= $ind_names; ?></td>
						</tr>
						<tr>
							<th class="tbl-name">Published</th>
							<td class="tbl-data"><?= $published_date; ?></td>
						</tr>
						<tr>
							<th class="tbl-name">Expiry</th>
							<td class="tbl-data"><?= $expiry; ?></td>
						</tr>
					</table>
					
					<a href="<?= the_permalink(); ?>" class=""><u>View Notice</u></a>
				</div>
			
			
				</div>
			</div> -->

						<div class="col-md-6 col-sm card mt-3 mb-3 posts p-3">
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

				<!-- <a href="<?= the_permalink(); ?>" class="btn btn-primary btn-sm"><u>View Notice</u></a> -->
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

		<?php endwhile;endif; ?>
			</div>

			<div class="text-center pt-3">
				<a href="<?= home_url()?>/listall" class="site-btn sb-big">More Tenders</a>
			</div>
			
		</div>
	</section>
	<!-- CTA Section end -->


	


	<!-- Help Section -->
	<section class="why-section spad">
		<div class="container">
			<div class="text-center text-white mb-5 pb-4">
				<h2>Categories</h2>
			</div>
			<div class="row">
				<?php
		$categories = get_categories();

		foreach ($categories as $category) {
			
				?>
				<div class="col-md-4">
					<ul class="help-list">
						<li><a href="<?= get_category_link($category->term_id) ?>"><?= $category->name ?></a></li>
						
					</ul>
				</div>

		<?php } ?>

			</div>
		</div>
	</section>
	<!-- Help Section end -->



<?php } // end of register ?>