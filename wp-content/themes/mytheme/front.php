<?php
if (isset($_GET['register'])){
    $register = $_GET['register'];  
         
	if($register == 'true') { 
		get_template_part( 'register/register-success' );
 
 	}else{ 
		get_template_part( 'register/register-fail' );
 
  } 
} // isset register ends
elseif(isset($_GET['reset'])){
	$reset = $_GET['reset'];  
         
    if($reset == 'true') { 
		get_template_part( 'register/register-reset' );
	}
}else{ ?>


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
		font-size: 12px;
	}
</style>


<section class="hero-section-2 bg-image-section full-banner visible-lg" >
<?php
// show login errors message
if(isset($_GET['a'])) :
	if($_GET['a'] == 'login-error') : 
		if( !is_user_logged_in() ) : 
		?>

		<script>
// $(document).ready(function(){
//     $("#foobar").click();
// });
var snackbar = function() {
  // $("#snackbar").fadeOut().empty();
  $("#foobar").click();
}
setTimeout(snackbar, 1500); 

// load message
function myFunction() {
	// alert('clicked');
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3500);
}
// myFunction();
</script>

		<!-- toast -->
		<button id="foobar" style="display: none;" onclick="myFunction()">Show Snackbar</button>
		<div id="snackbar">
			<div class="alert alert-danger"><strong>Login Error </strong> Your Login Credentials do not match.
			</div>
		</div>

	<?php endif;
endif;
endif;
?>



<!-- <div id="snackbar1">Some text some message..</div>

<script>
function myFunction() {
	// alert("hello");
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 300000);
}
</script> -->


		<div class="container">
		<div class="row pt-4">
			<aside class="col-md-3 sidebar">
				<div class="block block-account">
					<div class="block-title">
						Our Services
					</div>
					<div class="block-content primemenu">
					<div class="nano has-scrollbar">
						<div class="overthrow nano-content description">
							<ul>
						<?php
						$categories = get_categories();
						foreach ($categories as $category) {
							$first = substr($category->name, 0, 1);
							
						?>
						<li class="aside"><a href="<?= get_category_link($category->term_id) ?>"><span class="first_letter"><?= $first; ?></span><?= $category->name; ?></a></li>

						<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				</div>
				
			</aside>
			<div class="col-md-9 p-4 mt-3" style="background-image: url('<?php bloginfo('template_url') ?>/img/hero-slider/1.jpg');height: 358px;">
		<div class="containers">
				<h4 class="mt-4" style="color: #fff;text-align: center;">नेपालको <span class='numscroller' data-min='1' data-max='52' data-delay='5' data-increment='10'>52</span> पत्रिका मा प्रकाशित टेण्डर हेर्न <a href="#" data-toggle="modal" data-target="#register_Modal" data-dismiss="modal">subscribe</a> गर्नु होला ।</h4>

				<div class="row mt-5 main-sr-boxx" style="padding: 0px 25px;">
					<div class="col-md-12">
						
						

						<!-- <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left: -15px;">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#newspapers" role="tab" aria-controls="home" aria-selected="true">NEWSPAPERS</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#industries" role="tab" aria-controls="home" aria-selected="false">INDUSTRIES </a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="home-tab3" data-toggle="tab" href="#products" role="tab" aria-controls="home" aria-selected="false">Products </a>
						  </li>
						</ul> -->
					</div>
					<div class="tabcontents tab-display" id="myTabContent">
						<!-- <div id="search-box" class="search-box">
							<form action="<?= home_url(); ?>/search" method="get">
							<input type="text" name="s" class="col-md-8" placeholder="Enter Keyword For Ex. Tender Name ">
							<button onclick="submitSearchForm('1');"><i class="fa fa-search"></i> <span class="searchbtn">Search</span></button>
							</form>
						</div> -->

						<div class="tab-pane search-box fade show active" id="newspapers" role="tabpanel" aria-labelledby="home-tab1">
							<form action="<?= home_url(); ?>/search" method="get" >
							<input type="text" name="s" class="col-md-8" placeholder="Enter Keyword For Ex. Tender Name ">
							<input type="hidden" name="tax" value="newspapers">
							<button onclick="submitSearchForm('1');"><i class="fa fa-search"></i> <span class="searchbtn">Search in Newspapers</span></button>
							</form>
						</div>

						<div class="tab-pane search-box fade" id="industries" role="tabpanel" aria-labelledby="home-tab2">
							<form action="<?= home_url(); ?>/search" method="get" style="display: none;">
							<input type="text" name="s" class="col-md-8" placeholder="Enter Keyword For Ex. Tender Name ">
							<input type="hidden" name="tax" value="industries">
							<button onclick="submitSearchForm('1');"><i class="fa fa-search"></i> <span class="searchbtn">Search in Industries</span></button>
							</form>
						</div>

						<div class="tab-pane search-box fade" id="products" role="tabpanel" aria-labelledby="home-tab3">
							<form action="<?= home_url(); ?>/search" method="get" style="display: none;">
							<input type="text" name="s" class="col-md-8" placeholder="Enter Keyword For Ex. Tender Name ">
							<input type="hidden" name="tax" value="products">
							<button onclick="submitSearchForm('1');"><i class="fa fa-search"></i> <span class="searchbtn">Search in Products</span></button>
							</form>
						</div>


					</div>
					
					<!-- <div class="col-md-12"> -->
						<a href="<?= site_url() ?>/listall/?adv=search" class="adv_search offset-md-6">Advance Search</a>
					<!-- </div> -->
				</div>

		</div>
	</div>
</div>
</div>
		<!-- <div class="hero-sliders owl-carouselss">
			<div class="hs-item set-bg" data-setbg="img/hero-slider/1.jpg"></div>
			<div class="hs-item set-bg" data-setbg="img/hero-slider/2.jpg"></div>
			<div class="hs-item set-bg" data-setbg="img/hero-slider/3.jpg"></div>
		</div> -->
	</section>
	<!-- Hero Section end -->


<!-- slider Section -->
	<section class="why-section pt-4" style="background-color: #3895bc;">
	
	
	<div class="container">
		<div class="slider owl-carousel row">
	    <?php
		// $categories = get_categories();
		// foreach ($categories as $category) {

			$terms = get_terms(
    array(
        'taxonomy'   => 'newspapers',
        'hide_empty' => false,
        'parent' => 0
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

foreach ($terms1 as $category) {
		?>
		<div class="slide col-md-2ss col-sm-12ss">
			<!-- <div class="card card-header" style="text-align: center;">
			
			<h6><a href="<?= get_category_link($category->term_id) ?>" style="color: #000;"><?= $category->name ?></a></h6>
			</div> -->
			<div class="card card-body">
				<?php if ( z_taxonomy_image_url($category->term_id) ){ ?>
			<a href="<?php echo esc_url( get_term_link( $category ) ) ?>"><img src="<?= z_taxonomy_image_url($category->term_id); ?>" class="img-responsive" width="150" height="120" style="padding: 15px;object-fit: cover;"></a>
				<?php }else{ ?>
			<a href="<?php echo esc_url( get_term_link( $category ) ) ?>"><img src="<?= get_template_directory_uri() ?>/img/loans/3.jpg" class="img-responsive" width="150" height="120" style="padding: 15px;object-fit: cover;"></a>
				<?php } ?>
			</div>
			<div class="card card-footer" style="background-color: #fff;text-align: center;">
				<h6><a href="<?= get_category_link($category->term_id) ?>" style="color: #000;"><?= $category->name ?></a></h6>
			</div>
		</div>
		<?php } } }?>

		</div>

	</div>
	<a href="<?= site_url()?>/allnewspapers" class="btn btn-light float-right" style="margin: 80px 29px 0 0;"><i class="fa fa-eye"></i> View All</a>
	</section>
<!-- slider section ends -->


	


	<!-- CTA Section end -->
	<section class="cta-section set-bg" data-setbg="<?php bloginfo('template_url') ?>/img/cta-bg.jpg">
		<div class="container">
			<h2>Latest <strong>Tenders</strong>  </h2>
			
			<div class="row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link " id="home-tab1" data-toggle="tab" href="#list_view" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list"></i> </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link active"  id="home-tab2" data-toggle="tab" href="#card_view" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-th-large"></i> </a>
				  </li>
			</ul>
			</div>

			<div class="row card tab-content" id="myTabContents">
				<div class="tab-pane fade " id="list_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="container">
					<div class="row p-3">
					<?php
					get_template_part( 'template-parts/content', 'home-list' );
					?>
					</div>
				</div>
				</div>

				<div class="tab-pane fade show active" id="card_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="row resp_card p-3" id="outer1">
					<?php
					// get_template_part( 'template-parts/content', 'home-card' );
					// get_template_part( 'parts/loadmore_home_card');
					?>
					

					<!-- <div class="row resp_card1w" id="scroll_div">
						
					</div>
					
					<div class="row" id="outer" style="margin: 0 auto;">
						<div class="col-md-12 col-sm-12">
						<p class="loading_img" style="display: none;">
							 ...
						</p>
						</div>
					
						<div class="col-md-12 col-sm-12">
							<a href="#" class="more_posts btn btn-info btn-sm">Load More</a>
						</div>
					</div> -->

					</div>
				</div>
			</div>


			<div class="text-center pt-3">
				<a href="<?= home_url()?>/listall" class="site-btn sb-big">More Tenders</a>
			</div>


		</div>
	</section>
	<!-- CTA Section end -->


	<!-- newspaper Section end -->
	<section class="why-section pb-4">
		<?php  
          // if (isset($_GET['register'])){
          // $register = $_GET['register'];  
         
          // if($register == true) { 
          //               echo '<div class="alert alert-success">Check your email and set the password!</div>'; 
          //               }else{
          //               	echo '<div class="alert alert-warning">Please provide a unique username or email address!</div>';
          //               }
          //              }
                      //    else {

                      //   echo '<div class="alert alert-warning">Please provide a unique username or email address!</div>';
                      // }
                      ?>



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


	<!-- Help Section -->
	<section class="why-section mt-4 mb-4" style="background-image: url(http://localhost:8080/tender/wp-content/themes/mytheme/img/cta-bg.jpg);">
		<div class="container news-sec">
			<div class="text-center mb-5 pb-4 mt-3">
				<h2><strong>Newspaper By Cluster</strong></h2>
			</div>
			<div class="row mb-5">

				<div class="col-md-4 news-cluster">
					<a href="<?= site_url()?>/allnewspapers/#paper_1">
					<div class="job-cat-inner news-card">
					<i class="fa fa-paper-plane"></i>
					<h3>Central</h3>
					<p>The jobs that have been recently published are listed on the Latest Jobs. Recruiters post new jobs daily and update them regularly.</p>
					</div>
					</a>
				</div>

				<div class="col-md-4 news-cluster">
					<a href="<?= site_url()?>/allnewspapers/#paper_2">
					<div class="job-cat-inner news-card">
					<i class="fa fa-star"></i>
					<h3>Pradesh</h3>
					<p>The jobs that have been recently published are listed on the Latest Jobs. Recruiters post new jobs daily and update them regularly.</p>
					</div>
					</a>
				</div>
				<div class="col-md-4 news-cluster">
					<a href="<?= site_url()?>/allnewspapers/#paper_3">
					<div class="job-cat-inner news-card">
					<i class="fa fa-paper-plane"></i>
					<h3>Local</h3>
					<p>The jobs that have been recently published are listed on the Latest Jobs. Recruiters post new jobs daily and update them regularly.</p>
					</div>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Help Section end -->

<section class="info-section p-4">
	<div class="container">
		<h2 style="text-align:center;">Our Features</h2>
		<p style="text-align: center;">Do More With nepalbolpatra.com</p>
		<div class="row">
			<div class="col-md-4 col-sm-12 mb-5">
				<div class="feature-section row">
					<div class="col-md-3 col-sm-12">
						<!-- <img src="<?=  bloginfo('template_url')?>/img/add.jpg" class="img-rounded"> -->
						<i class="fa fa-newspaper-o fa-bg"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<h4>Tenders From Newspaper & Authentic Sites</h4>

						<p>View all tender notices published in various newspapers & authentic sites.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12  mb-5">
				<div class="feature-section row">
					<div class="col-md-3 col-sm-12">
						<!-- <img src="<?=  bloginfo('template_url')?>/img/add.jpg" class="img-rounded"> -->
						<i class="fa fa-filter fa-bg"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<h4>Category Wise Tender Filter</h4>

						<p>Filter tender notices from list of various categories.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 mb-5">
				<div class="feature-section row">
					<div class="col-md-3 col-sm-12">
						<!-- <img src="<?=  bloginfo('template_url')?>/img/add.jpg" class="img-rounded"> -->
						<i class="fa fa-list-ul fa-bg"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<h4>Newspaper Collection</h4>

						<p>Complete Collection of Newspapers from National Daily, States Daily & Local Newspapers.</p>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-12 mb-5">
				<div class="feature-section row">
					<div class="col-md-3 col-sm-12">
						<!-- <img src="<?=  bloginfo('template_url')?>/img/add.jpg" class="img-rounded"> -->
						<i class="fa fa-envelope fa-bg"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<h4>Tender Email Alert</h4>

						<p>Get notices Updates From e-mail from your selected categories.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12  mb-5">
				<div class="feature-section row">
					<div class="col-md-3 col-sm-12">
						<!-- <img src="<?=  bloginfo('template_url')?>/img/add.jpg" class="img-rounded"> -->
						<i class="fa fa-pencil fa-bg"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<h4>Proposal Writing Service</h4>

						<p>Get expert help for writing your proposal from  us.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 mb-5">
				<div class="feature-section row">
					<div class="col-md-3 col-sm-12">
						<!-- <img src="<?=  bloginfo('template_url')?>/img/add.jpg" class="img-rounded"> -->
						<i class="fa fa-search fa-bg"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<h4>Business Research</h4>

						<p>Gain Knowlwdge as part of your business research.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php } ?>
<script src="<?php bloginfo('template_url') ?>/js/owl.carousel.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
	var owl = $('.owl-carousel');
owl.owlCarousel({
    items:4,
    loop:true,
    margin:10,
    // autoplayDelay: 6000,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
    nav: true,
    // dots: true,	
    responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 4
    },

    1366: {
      items: 4
    }
  }
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})
});

	$(window).on("load", function () {
    $(".more_posts").attr("disabled",true); // Disable the button, temp.
        id = $(this).data("id");
        // alert(id);
        // alert(ajaxUrl);
		// $('html, body').animate({
	 //        scrollTop: $("#card_view").offset().top -270
	 //    }, 'slow'); // scroll to div

   		$('.loading_img').show();
		var data = {
			'action': 'load_posts_by_ajax',
			'page': page,
			// 'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
		};

		$.post(ajaxUrl, data, function(response){
			// $('.my-posts').append(response);
			$('.resp_card').html(response).hide().fadeIn(1500);
			$('.loading_img').hide();
			page++;
			

		});
});
</script>