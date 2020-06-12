<?php get_header(); 

if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
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

// 
$args = array(
'post_type'=> 'post',
'orderby'    => 'ID',
'post_status' => 'publish',
'order'    => 'DESC',
'posts_per_page' => $max, // this will retrive all the post that is published 
);

$the_query = new WP_Query( $args ); 

 if(isset($_GET['cat'])){
$filter_string = $_GET['cat'];
}
else{
    $filter_string='';
}
$filter_array = explode( ",", $filter_string );
$filter_arg = '\'' . implode( $filter_array, '\' , \'' ) . '\'';
$grp = explode(',', $filter_string);

if( $filter_string )
{
  $args = array(
'post_type'=> 'post',
'posts_per_page' => $max,
  'tax_query' => array(
    array(
      'taxonomy' => 'newspapers',
      'field' => 'slug',
      'terms' => $grp, 
      'include_children' => true
    )
  )
);
 
$the_query = new WP_Query( $args );
} else { // if  no category checked or at page start
  $paged = get_query_var('paged');
  $args = array(
'post_type'=> 'post',
'orderby'    => 'ID',
'post_status' => 'publish',
'order'    => 'DESC',
'posts_per_page' => $max,
'paged' => $paged,
);

$the_query = new WP_Query( $args );
}
?>

<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home /</a></span>
					<span>Tender Listing</span>
			</div>
		</div>
	</div>

	<div class="container">

	<div class="row">
		<div class="col-md-3 col-sm-12 col-xs-12 pl-4">
			<div class="card p-3">
				<span><i class="fa fa-search"></i> Filter By:</span>
				<hr>

				<label>Newspapers</label>

				<?php
				$terms = get_terms(
					array(
						'taxonomy' => 'newspapers',
						'hide_empty' => false,
					)
				);

				foreach ($terms as $data) {
				?>
				<label class="form-check-label">
      <input type="checkbox" name="category" value="<?php echo $data->slug;?>" <?php  if( in_array( $data->slug, $filter_array ) ) { echo "checked"; } ?>>
      &nbsp;<?php echo $data->name;?>&nbsp;
    </label>
      <?php
      }
      ?>
		
	  <hr>
      <label>Industry</label>

				<?php
				$indust = get_terms(
					array(
						'taxonomy' => 'industries',
						'hide_empty' => false,
					)
				);

				foreach ($indust as $ind) {
				?>
				<label class="form-check-label">
      <input type="checkbox" name="industry" value="<?php echo $ind->slug;?>" <?php  if( in_array( $ind->slug, $filter_array ) ) { echo "checked"; } ?>>
      &nbsp;<?php echo $ind->name;?>&nbsp;
    </label>
      <?php
      }
      ?>

<!-- filter data -->
<div class="mt-3">
<a id="filter" href="#">
  <button class="btn btn-outline-primary btn-sm" style="">Filter Result</button></a>
</div>
			</div>
		</div>

		<div class="col-md-9 col-xs-12 col-sm-12">
			<div class="card p-3">
				<medium class="" style="color: black;">Filter Details</medium><hr>
				<?php
				
				if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
				$cat_id = get_the_ID();
				$category = wp_get_post_terms( $cat_id, 'category');
				$cc = count($category);
				$cnames = array();
				for ($i=0; $i < $cc; $i++) { 
					$cname = $category[$i]->name;
					$cnames[] = $cname;
				}
				$cat_names = implode(', ', $cnames);

				$prod = wp_get_post_terms( $cat_id, 'products');
				$pc = count($prod);
				$pnames = array();
				for ($i=0; $i < $pc; $i++) { 
					$pname = $prod[$i]->name;
					$pnames[] = $pname;
				}
				$pro_names = implode(', ', $pnames);

				$ind = wp_get_post_terms( $cat_id, 'industries'); 
				$ic = count($ind);
				$inames = array();
				for ($i=0; $i < $ic; $i++) { 
					$iname = $ind[$i]->name;
					$inames[] = $iname;
				}
				$ind_names = implode(', ', $inames);

				$papers = wp_get_post_terms( $cat_id, 'newspapers'); 
				$papc = count($papers);
				$ppnames = array();
				for ($i=0; $i < $papc; $i++) { 
					$papname = $papers[$i]->name;
					$ppnames[] = $papname;
				}
				$paper_names = implode(', ', $ppnames);

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
				<div class="row">
				<div class="col-md-3 col-sm-12 col-xs-12 mb-4">
					<?php if (has_post_thumbnail()) : ?>
					<figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
				<?php else:
					echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main" width="200" height="150">';
				endif; ?>
				<a href="<?= the_permalink(); ?>" class="btn btn-primary btn-sm"><u>View Notice</u></a>
				</div>
				
				<div class="col-md-9 col-sm-12 col-xs-12">
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

				
				<hr>
				<?php endwhile; else:
				echo '<h4>No Posts Found for this category.</h4>';
			endif;

			// subscription
			if($user){
			if($subs == 'trial'){
			echo '<div class="col-md-12 col-sm-12 info-trial pt-2">';
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
				echo '<div class="col-md-12 col-sm-12 info-trial-free pt-2">';
					echo '<p><b>Please Sign Up to View More Tenders</b></p>';
				echo '</div>';
			}
			 ?>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card p-3">
				<div class="row">
								<div class="col-md-12 col-sm-12 mt-3">
				<h6>Category</h6>
				<?php
				$category = get_categories();

				echo '<ul style="list-style: none;">';
				foreach ($category as $cat) {
					echo '<li><a href="'.get_category_link($cat->term_id).'">By '.$cat->name . ' ( '. $cat->category_count. ' )'.'</a></li>';
				}
				echo '</ul>';

				?>
				<hr>
			</div>

			<div class="col-md-12 col-sm-12 mt-3">
				<h6>Newspapers</h6>

				<?php 
				$tax = array('newspapers');

				$terms = get_terms( $tax, $args = array(
					  'hide_empty' => false, // do not hide empty terms
					));

				echo '<ul style="list-style: none;">';
				foreach ($terms as $term) {
					$term_link = get_term_link( $term );

					echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . ' ( ' . $term->count. ' )' .'</a></li>';
				}
				echo '</ul>';
				?>
			</div>

			<div class="col-md-12 col-sm-12 mt-3">
				<h6>Industries</h6>

				<?php 
				$tax = array('industries');

				$terms = get_terms( $tax, $args = array(
					  'hide_empty' => false, // do not hide empty terms
					));

				echo '<ul style="list-style: none;">';
				foreach ($terms as $term) {
					$term_link = get_term_link( $term );

					echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . ' ( ' . $term->count. ' )' .'</a></li>';
				}
				echo '</ul>';
				?>
			</div>

			<div class="col-md-12 col-sm-12 mt-3">
				<h6>Products</h6>

				<?php 
				$tax = array('products');

				$terms = get_terms( $tax, $args = array(
					  'hide_empty' => false, // do not hide empty terms
					));

				echo '<ul style="list-style: none;">';
				foreach ($terms as $term) {
					$term_link = get_term_link( $term );

					echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . ' ( ' . $term->count. ' )' .'</a></li>';
				}
				echo '</ul>';
				?>
			</div>

			
	</div>
	</div>
</section>

<script src="<?php bloginfo('template_url') ?>/js/jquery-3.2.1.min.js"></script>
<script>
$( document ).ready(function() {
	$("input[type=checkbox][name=category]").on("change", function() {
		// console.log('checkbox clicked');
    var arr = [];
    $(":checkbox").each(function() {
      if ($(this).is(":checked")) {
        arr.push($(this).val());
      }
    });
    var vals = arr.join(",");
    var str = "<?php echo site_url(); ?>/filter/?cat=" + vals;
    // console.log(str);

    if (vals.length > 0) {
      $("#filter").attr("href", str);
    } else {
      $("#filter").attr("href", "<?php echo site_url(); ?>/filter");
    }
  });

	// $("input[type=checkbox][name=industry]").on("change", function() {
 //    console.log('industry checkbox clicked');
 //    var arr1 = [];
 //    $(":checkbox").each(function() {
 //      if ($(this).is(":checked")) {
 //        arr1.push($(this).val());
 //      }
 //    });
 //    var vals1 = arr1.join(",");
 //    var str1 = "<?php echo site_url(); ?>/filter/?ind=" + vals1 + "?cat=";
 //    console.log(str1);

 //    if (vals1.length > 0) {
 //      $("#filter").attr("href", str1);
 //    } else {
 //      $("#filter").attr("href", "<?php echo site_url(); ?>/filter");
 //    }
 //  });

});

</script>
<?php get_footer(); ?>