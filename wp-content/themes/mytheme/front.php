	<?php
if($_GET['s']){
	$search = $_GET['s'];

	echo '<div style="min-height: 200px">';
	// echo $search;

	echo '</div>';
}else{
	// echo "other";
}
	?>
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


<style type="text/css">
	.nav-link{
		color: #fff;
    	background: #7d8c9f;
    	border-bottom: 1px solid #fff;
	}
	.nav-link:hover{
		color: #fff;
	}
	.p_list span{
		color: black;
		font-weight: 600;
	}
</style>
	<section class="hero-section-1 bg-image-section full-banner visible-lg" style="background-image: url('<?php bloginfo('template_url') ?>/img/hero-slider/1.jpg');">
		
		<div class="container">
				<h4 class="mt-4" style="color: #fff;text-align: center;">नेपालको <span class='numscroller' data-min='1' data-max='52' data-delay='5' data-increment='10'>52</span> पत्रिका मा प्रकाशित टेण्डर हेर्न <a href="#" data-toggle="modal" data-target="#register_Modal" data-dismiss="modal">subscribe</a> गर्नु होला ।</h4>

				<div class="row mt-5 main-sr-box">
					<div class="col-md-12">
						
						<!-- <span class="sp-title"><a href="<?= home_url(); ?>/tender-by-category#newspapers">NEWSPAPERS</a></span>
						<span class="sp-title ml-1"><a href="<?= home_url(); ?>/tender-by-category#industries">INDUSTRY</a></span>
						<span class="sp-title ml-1"><a href="<?= home_url(); ?>/tender-by-category#products">PRODUCTS</a></span> -->

						<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left: -15px;">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#newspapers" role="tab" aria-controls="home" aria-selected="true">NEWSPAPERS</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#industries" role="tab" aria-controls="home" aria-selected="false">INDUSTRIES </a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#products" role="tab" aria-controls="home" aria-selected="false">Products </a>
						  </li>
						</ul>
					</div>
					<div class="tabcontents" id="myTabContent">
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
		<?php  
          if (isset($_GET['register'])){
          $register = $_GET['register'];  
         
          if($register == true) { 
                        echo '<div class="alert alert-success">Check your email and set the password!</div>'; 
                        }else{
                        	echo '<div class="alert alert-warning">Please provide a unique username or email address!</div>';
                        }
                       }
                      //    else {

                      //   echo '<div class="alert alert-warning">Please provide a unique username or email address!</div>';
                      // }
                      ?>



		<div class="container">

			<?php
			// $user_id = get_current_user_id();
			// $user = get_user_meta( $user_id );
			// // echo '<pre>';
			// // print_r($user);

			// $email_list = get_user_meta( $user_id, 'schedule_email', true );
			// $email_list_string = implode( $email_list, ', ' );

			// echo $email_list_string;
			// echo '</pre>';

			?>
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
        'parent' => 0
        // 'post__in'       => [2,3,7],
    	// 'orderby'        => 'post__in',
    	// 'order'          => 'ASC'
    )
);

// Check if any term exists
if ( ! empty( $terms ) && is_array( $terms ) ) {
    // Run a loop and print them all
    foreach ( $terms as $parent ) { 
    	// $cat_image = get_field('category_image', $term); ?>


<?php $terms1 = get_terms(
array(
'taxonomy'   => 'newspapers',
'hide_empty' => false,
'parent' => $parent->term_id 

)
);

foreach ($terms1 as $term) {
	
?>
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="icon-box-item">
						<div class="row">
						<div class="ib-icon">
							<!-- <i class="flaticon-012-24-hours"></i> -->
							<?php 
							if ( z_taxonomy_image_url($term->term_id) ){
							?>
							<a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><img src="<?= z_taxonomy_image_url($term->term_id); ?>" width="180" height="120" style="padding: 15px"></a>
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
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#list_view" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list"></i> </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#card_view" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-th-large"></i> </a>
				  </li>
			</ul>
			</div>

			<div class="row card tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="list_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="row p-3">
					<?php
					get_template_part( 'template-parts/content', 'home-list' );
					?>
					</div>
				</div>

				<div class="tab-pane fade" id="card_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="row p-3">
					<?php
					get_template_part( 'template-parts/content', 'home-card' );
					?>
					</div>
				</div>
			</div>
		
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
			$im = 1;
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
					<figure> <a href="" data-toggle="modal" data-target="#image_modal<?= $im;?>"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
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
							<small><?php //echo mb_strimwidth(get_the_content(), 0, 40, '...'); ?></small>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6" style="overflow: hidden;">
							<div class="row">

						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-list-ul "></i></span>
							<span class="ml-4 float-left"><span><?= wp_trim_words($cat_names, 15, '..') ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-paper-plane"></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($paper_names, 0, 25, '...'); ?></span></span>	
						</p></div>

						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-calendar"></i></span>
							<span class="ml-4 float-left"><span><?= $published_date; ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-calendar" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span><?= $expiry; ?></span></span>	
						</p></div>
</div>
</div>
<div class="col-md-6" style="border-left: 1px dashed lightgrey;">
	<?php echo mb_strimwidth(get_the_content(), 0, 110, '...'); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="image_modal<?= $im;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= the_title(); ?></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php
        if ( has_post_thumbnail() ) {
				    the_post_thumbnail( 'full' );
				}else{
					echo "No Image Found";
				}

				?>


      </div>
    </div>
  </div>
</div>

<?php if (current_user_can('administrator')) 
{
edit_post_link( esc_html__( 'Edit', 'oria' ), '<span class="edit-link">', '</span>' ); 
} ?>
					</div> <!-- main row -->
					
				</div>
			
			
				</div>
			</div> 

		<?php $im++; endwhile;endif; ?>
			</div>

			<div class="text-center pt-3">
				<a href="<?= home_url()?>/listall" class="site-btn sb-big">More Tenders</a>
			</div>


		</div>
	</section>
	<!-- CTA Section end -->


	


	<!-- Help Section -->
	<section class="why-section mt-4 mb-4">
		<div class="container">
			<div class="text-center mb-5 pb-4">
				<h2><strong>Categories</strong></h2>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm">
					<label>By Category</label>
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

				<div class="col-md-3 col-sm">
					Newspaper
				</div>

				<div class="col-md-3 col-sm">
					Products
				</div>

				<div class="col-md-3 col-sm">
					Products
				</div>

			</div>
		</div>
	</section>
	<!-- Help Section end -->



<?php } ?>