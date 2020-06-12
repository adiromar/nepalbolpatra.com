


<div class="modal bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        <h5 class="modal-title" id="ModalLongTitle"></h5>
      </div>
      <div class="modal-body">
          
        <img src="" class="tender_image_preview" style="width: 100%;" > 
       
        
      </div>
      <div class="modal-footer">
        <a id="OpenInNew" href="" target="_blank"><button type="button" class="btn btn-primary">Open in New Tab</button></a>
        
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<?php
/**
 * The front page template file

 */

get_header();

 $uid = get_current_user_id();
 // $user = get_user_meta($uid, 'user_type');
 // $user = $user[0];
 $userw = get_user_meta($uid);
 $count = count($userw);
 global $wpdb;
 // if ($uid > 0) {
 // 	$result = (array) $wpdb->get_results(
 // 	'SELECT * FROM `wp_tender` ORDER BY `created_at` DESC LIMIT 10'
 // 	);
 // }else{
 // 	$result = (array) $wpdb->get_results(
 // 	'SELECT * FROM `wp_tender` ORDER BY `created_at` DESC LIMIT 5'
 // );
 // }

$args = array(
'post_type'=> 'post',
'orderby'    => 'ID',
'post_status' => 'publish',
'order'    => 'DESC',
'posts_per_page' => 5, // this will retrive all the post that is published 
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
  'tax_query' => array(
    array(
      'taxonomy' => 'products',
      'field' => 'slug',
      'terms' => $grp, 
      'include_children' => true
    )
  )
);
 
$the_query = new WP_Query( $args );
} else {
  $paged = get_query_var('paged');
  $args = array(
'post_type'=> 'post',
'orderby'    => 'ID',
'post_status' => 'publish',
'order'    => 'DESC',
'posts_per_page' => 20,
'paged' => $paged,
);

$the_query = new WP_Query( $args );
}

?>

<!--
  /*
		=======================================
    Start of Page Content
  	=======================================
	*/
-->
<?php if(!is_user_logged_in()){ ?>
<style type="text/css">
	.pop img{
		width: 50px;
		height: 55px;
	}
</style>
<header class="jumbotron">
	<div class="container ">
		<div class="row">
			<div class="col-md-12 main_content ">
			    <?php  
			    if (isset($_GET['register'])){
			    $register = $_GET['register'];  
			    if($register == true) { 
                        echo '<div class="alert alert-success">Check your email and set the password!</div>'; 
                        } }?>
      
      			
      
     
      
				<h2 style="color:#ff4223;">You Are at Right Path</h2>
			<p class="first_para">We provide an affordable, flexible and successful </p>
			<p class="second_para">solution to outsource bid support</p>
			<?php if ( ! is_user_logged_in() ): ?>
				<a data-toggle="modal" data-target="#myModal" onclick="show_register();return false;" class="btn btn-info btn-lg">JOIN US</a>
			<?php endif; ?>
			<div class="imag" style="margin-top: 20px; margin-left: 28px;">
				<img src="http://icx1-map21x.lan.511nj.org/mapwidget/images/d-arrow.png" style="height: 70px; width: 70px; cursor: pointer; border: 1px solid brown; min-width: 85px; border-radius: 10%;" class="scroll" target="content">
			</div>
			 <!-- <p>JOIN US</p>  -->
			</div>
		</div>
	</div>
</header>
<!-- //Jumbotron  -->
<?php } ?>
<div id="content" style="margin-top: 20px;"></div>
<div class="table_content" style="margin-top: -29px;">
<div class="container ">
	<div class="clearfix"></div>
	<?php if(is_user_logged_in()){ ?>
	<?php if($count < 18){ ?>
	<div class="alert alert-default alert-dismissible" role="alert" id="alert" style="margin-top: 60px; background-color: #6cbada; margin-top: 80px;">
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><p class="btn btn-xs btn-warning" style="background-color: black;">Close</p></button>
  		<strong>Notice!</strong> Please choose your preferred <strong>CATEGORY</strong> in your profile to get regular email notifications related to your interest.<br><br>
  		<div class="clearfix"></div>
  		<a href="<?php echo home_url( '/user' ) ?>#interests" style="align-items: right;"><button class="btn btn-warning">Go to Profile</button></a>
	</div>
	<?php } }  ?>
		<h3 style="margin-top:100px">Latest Tenders / Notice</h3>
		<hr style="width: 22%;border-top: 3px solid #ec4707">

<?php
	$terms = get_terms( array(
    'taxonomy' => 'products',
    'hide_empty' => false,
) );

	?>
	<h5>Filter By Category:</h5>
    <div class="col-md-2 col-sm-1"></div>
    <ul class="col-md-10 col-sm-3" style="font-size:12px; list-style:none;">
      <div class="form-check form-check-inline">
        <?php         
        foreach($terms as $data) { ?>
        
   <label class="form-check-label">
      <input type="checkbox" name="category" value="<?php echo $data->slug;?>" <?php  if( in_array( $data->slug, $filter_array ) ) { echo "checked"; } ?>>
      &nbsp;<?php echo $data->name;?>&nbsp;
    </label>
      <?php
      }
      ?>
    </div>
   </ul>
   		<a id="filter" href="#">
  <button class="btn btn-outline-primary btn-sm" style="">Filter Result</button></a>


 <div class="container">
	<form class="" action="<?php bloginfo('url') ?>/wp-login.php" method="post">
		<div>
			<label>username</label>
			<input type="text" name="log">

			<label>password</label>
			<input type="password" name="pwd">

					<input class="loginLoginValue" type="hidden" name="service" value="login" />
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI'] . '#content'; ?>" />
					<input type="hidden" name="user-cookie" value="1" />

			<input type="submit" name="user-submit" id="go" value="Authorize">
		</div>
	</form>
</div>


	<div class="row">
	<div class='tender_table col-md-12'>

		<table class="table table-striped table-hover table-bordered table-condensed table-responsive">
		  <thead >
		    <th >S.N</th>
		    <th style="width:175px;">Notice Publisher</th>
		    <th>Description</th>
		    <th style="width:99px">Published Date</th>
		    <th style="width:99px">Last date</th>
		    <th style="width:85px;">Category</th>
		    <th style="width:124px">Industry</th>
		    <th style="width:">Product/Service</th>
		    <th>Newspaper</th>
		    <th style="width:72px">Days Remaining</th>
		    <th style="width:90px">Notice Image</th>
		  </thead>
		<tbody class="table_body">
<?php
			$ij = 1; 

if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
$cat_id = get_the_ID();
// $cat_name = get_cat_name( $cat_id );

// $category = get_the_term_list( $cat_id, 'category', '', ', ' ); 
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
$sd = DateTime::createFromFormat( "Y-m-j", $p_date )->settime(0,0);
$diff = $today->diff($sd)->format("%R%a");
?>
	<tr>
		<td><?= $ij ?></td>
		<td><?= $publisher ?></td>
		<th><a href="<?= the_permalink() ?>"><?= get_the_title(); ?></a></th>
		<td><?= $published_date ?></td>
		<td><?= $expiry ?></td>
		<th><?= $cat_names ?></th>
		<td><?= $ind_names ?></td>
		<th><?= $pro_names ?></th>
		
		<td><?= $paper_names ?></td>
		
		
		<td><?php
			if( $diff >= 0)
									{
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
										echo "<p style='color:red'>Expired</p>";
									}
		 ?></td>
		<th><a href="#" class="pop"><?php the_post_thumbnail('medium-large', ['class' => 'img-responsive']) ;?></a></th>
		<th></th>
	</tr>
<?php $ij++; endwhile; ?>

<?php else : ?>
	<td>No Posts To Show</td>
<?php endif; ?>
</tbody>
</table>

		
		<?php if(is_super_admin() || $user == 'paid') : ?>
		<a href="<?php echo home_url( '/show-tenders' ) ?>" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a>
		<?php else: ?>
		<a href="<?php echo home_url( '/show-tenders' ) ?>" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a>
		<!-- <a href="<?php echo home_url( '/pricing/?action=login' ) ?>" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a> -->
		<!-- <a href="#" id="more_tender" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a> -->

		<?php endif; ?>
		<?php if(is_user_logged_in()){
		   echo "<strong>Note:</strong> <p> Go to your profile and update your interest fields to get the regular email notifications related to your interest.</p>" ;
		}
		
		?>
	</div>
	</div>

	 </div>
</div><!-- endof container-->

</div>
</div>
<!-- //.Tender Table -->



<!-- /*Picture in Modal View*/ -->
<script>
$( document ).ready(function() {
	$("input[type=checkbox][name=category]").on("change", function() {
		console.log('checkbox clicked');
    var arr = [];
    $(":checkbox").each(function() {
      if ($(this).is(":checked")) {
        arr.push($(this).val());
      }
    });
    var vals = arr.join(",");
    var str = "<?php echo site_url(); ?>/?cat=" + vals + "#content";
    console.log(str);

    if (vals.length > 0) {
      $("#filter").attr("href", str);
    } else {
      $("#filter").attr("href", "<?php echo site_url(); ?>");
    }
  });
});

  $(function() {
		$('.pop').on('click', function() {
			$('.tender_image_preview').attr('src', $(this).find('img').attr('src'));

      $('.modal-title').text($(this).find('img').attr('alt'));

      $('#OpenInNew').attr('href', $(this).find('img').attr('src'));

			$('#imagemodal').modal('show');
		});
  });


  $('.scroll').click(function() {
    $('body').animate({
        scrollTop: eval($('#' + $(this).attr('target')).offset().top - 70)
    }, 1000);
});
</script>


<?php get_footer('user');
