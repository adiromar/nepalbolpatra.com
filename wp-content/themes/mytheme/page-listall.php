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

<style type="text/css">
input[disabled] {
	cursor: no-drop;
}
</style>
<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<div class="col-md-8 col-sm-12">
					<span><a href="<?= home_url(); ?>">Home/</a></span>
					<span>List All</span>
				</div>
				

				<div class="col-md-4 col-sm-12">
					<?php get_search_form(); ?>
				</div>
				
			</div>
		</div>
	</div>


<?php
if( is_user_logged_in() ) : 
if($_GET['login'] == 'true') : ?>
<script>

var snackbar = function() {
  $("#foobar1").click();
}
setTimeout(snackbar, 2000); 

// load message
function myFunction1() {
	
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}
// myFunction();
</script>

		<!-- toast -->
		<button id="foobar1" style="display: none;" onclick="myFunction1()">Show Snackbar</button>
		<div id="snackbar">
			<div class="alert alert-success"><strong>Successfully  Logged In</strong>
			</div>
		</div>
<?php endif;
endif; 


// check if subscriber
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
			  <strong>Subscribe TenderNepal !</strong> Please Sign Up to View More Tenders.<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#register_Modal" style="color: #155724;"><strong><u>Register Here</u></strong></a> 
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		</div>
		<?php endif; ?>



<?php //echo do_shortcode( '[searchandfilter fields="search,category,post_tag,post_format,taxonomyone,taxonomytwo" types=",radio,checkbox,select,radio,select" hierarchical=",1" headings=",Categories,Tags,Post Format,Taxonomy One,Taxonomy Two" submit_label="Filter"]' );

if(isset($_GET['adv'])) :
	if($_GET['adv'] == 'search') :
		$showw = 'show';
	else:
		$showw = '';
	endif;
endif;
 ?>


<div class="container mt-3 mb-3">
		<div class="row">
			<div class="offset-10 col-md-2 ">
				<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Advanced Search</button>
			</div>
		</div>

		<div class="collapse <?= $showw; ?> mt-3" id="collapseExample">
		<div class="row">
			  <div class="cards card-bodys">
			  	<div class="row mt-3 mb-1 ml-2">
						<div class="col-md-4">
							<label><input type="radio" name="cal" id="bs_nep" onclick="bs_nep()" value="0"> Nepali (B.S.)</label>
							<label><input type="radio" name="cal" id="ad_eng" onclick="ad_eng()" value="1" checked="checked"> English (A.D.)</label>
						</div>
					</div>

			  	<div class="col-md-12">
				
				<!-- #efeded -->
			    <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter" style="background: #fff;padding: 20px 15px;border: 1px solid lightgrey;">

			    	

			    	<div class="row mt-3">
						<div class="col-md-3" id="english">
							<label><input type="checkbox" id="pub_date_flag" checked="checked" onclick="disable_pub_date()"> Search By Published Date (A.D.)</label>

								<div class="mb-3">
									<div class="">
									<medium>From:</medium><br>
									<input type="text" name="pub_date_from" id="pub_date_from" class="form-control" autocomplete="off">
									</div>
									
									<div class="mt-3">
									<medium>To:</medium><br>
									<input type="text" name="pub_date_to" id="pub_date_to" class="form-control" autocomplete="off">
									</div>
								</div>

							<label><input type="checkbox" id="sub_date_flag" unchecked="unchecked" onclick="disable_sub_date()"> Search By Submission Date (A.D.)</label>

								<div class="mb-3">
									<div class="">

									<medium>From:</medium><br>
									<input type="text" name="sub_date_from" id="sub_date_from" class="form-control" autocomplete="off" disabled>
									</div>
									
									<div class="mt-3">
									<medium>To:</medium><br>
									<input type="text" name="sub_date_to" id="sub_date_to" class="form-control" autocomplete="off" disabled>
									</div>
								</div>
						</div>
						<div class="col-md-3" id="nepali" style="display: none;">
							<label><input type="checkbox" id="pub_date_flag1" checked="checked" onclick="disable_pub_date1()"> Search By Published Date (B.S.)</label>

								<div class="mb-3">
									<div class="">
									<medium>From:</medium><br>
									<input type="text" name="pub_date_from1" id="pub_date_from1" class="form-control nepali-calendar" autocomplete="off">
									</div>
									
									<div class="mt-3">
									<medium>To:</medium><br>
									<input type="text" name="pub_date_to1" id="pub_date_to1" class="form-control nepali-calendar" autocomplete="off">
									</div>
								</div>

							<label><input type="checkbox" id="sub_date_flag1" unchecked="unchecked" onclick="disable_sub_date1()"> Search By Submission Date (B.S.)</label>

								<div class="mb-3">
									<div class="">

									<medium>From:</medium><br>
									<input type="text" name="sub_date_from1" id="sub_date_from1" class="form-control nepali-calendar" autocomplete="off" disabled>
									</div>
									
									<div class="mt-3">
									<medium>To:</medium><br>
									<input type="text" name="sub_date_to1" id="sub_date_to1" class="form-control nepali-calendar" autocomplete="off" disabled>
									</div>
								</div>
						</div>
						<div class="col-md-4">
							<div class="mt-2">
								<div class="row">
									<div class="col-md-5">
										<a href="#" class="btn btn-info btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#not_cat_modal" data-backdrop="false">Notice Category</a>
									</div>
									<div class="col-md-7">
										<div class="notice_p_length">0 Selected</div>
									</div>
								</div>
	<!-- notice category modal -->
<div class="modal fade" id="not_cat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1000;">
  <div class="modal-dialog" role="document" style="top: 200px;">
    <div class="modal-content mdl-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notice Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<?php 
if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) ) ) :

foreach ( $terms as $term ) :
	echo '<div class="col-md-6">';

	echo '<label>'.$term->name.'  '.'<input type="checkbox" name="categoryfilter[]" class="notice_cat_checkbox" value="'.$term->term_id.'"></label>';
	echo '</div>';

endforeach; endif; ?>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- notice category modal ends  -->
</div>


<div class="mt-3">
	<div class="row">
		<div class="col-md-5">
			<a href="#" class="btn btn-info btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#not_news_modal" data-backdrop="false">Newspaper Category</a>
		</div>
		<div class="col-md-7">
			<div class="notice_news_length">0 Selected</div>
		</div>
	</div>
	

	<!-- newspaper category modal -->
<div class="modal fade" id="not_news_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1000;">
  <div class="modal-dialog modal-lg" role="document" style="top: 120px;">
    <div class="modal-content mdl-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Newspaper Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<?php 
if( $papers = get_terms( array( 'taxonomy' => 'newspapers', 'orderby' => 'name' ) ) ) :
			 
foreach ( $papers as $news ) :
	
	echo '<div class="col-md-4">';
	// echo '<label>'.$news->name.'</label>';
	echo '<label>'.$news->name.'  '.'<input type="checkbox" name="papers[]" class="notice_news_checkbox" value="'.$news->term_id.'"></label>';
	echo '</div>';

endforeach; endif; ?>
        </div>
      </div>

      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>

    </div>
  </div>
</div>
<!-- newspaper category modal ends  -->
</div>
						</div>
						<div class="col-md-2">

							<label>
								<input type="radio" name="date" value="ASC" /> ASC
							</label>
							<label>
								<input type="radio" name="date" value="DESC" selected="selected" /> DESC
							</label>

							<hr>
							<div class="">
								<label><input type="radio" name="expired" value="0" checked /> Show All Expired</label>
								<label><input type="radio" name="expired" value="1" /> Not Expired</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="">
								<span><b>Advanced Tender Search</b></span>
								<p class="mt-3">You can search tender notices by selecting either the published date range, submission date range or both.</p>
							</div>
							<button id="apply_filter" class="btn btn-info btn-sm">Apply filter</button>
							<input type="hidden" name="action" value="myfilter">
							<a class="btn btn-danger btn-sm" data-toggle="collapse" data-target="#collapseExample" style="color: #fff;">Cancel</a>

							<input type="hidden" id="list_view_name" name="list" value="1">
							<input type="hidden" id="card_view_name" name="card" value="1" disabled>

							<hr>
							<a href="<?= site_url()?>/listall" class=" mt-2" style=""><i class="fa fa-back"></i> Refresh Page</a>

							
						</div>
			    	</div>

			    	<!-- old search filter -->
					<!-- <div class="row">
			    	<div class="col-md-3">
			    		<a href="#" class="btn btn-secondary"  data-toggle="collapse" data-target="#cat_group" aria-expanded="false" aria-controls="collapseExample">Category</a>

			    		<div class="collapse show mt-3" id="cat_group" style="background-color: #efeded;padding: 12px 4px;">
			    			<?php 
			    			if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) ) ) :
			 
				 			
							// echo '<select name="categoryfilter" id="category">
							// <option value="">Select category...</option>';
							foreach ( $terms as $term ) :
								// echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; 
								echo '<div class="col-md-12">';
							
								echo '<label>'.$term->name.'  '.'<input type="checkbox" name="categoryfilter[]" value="'.$term->term_id.'"></label>';
								echo '</div>';
							endforeach;
							// echo '</select>';
						endif;

			    			?>
			    		</div>
			    	</div>
			    	<div class="col-md-3">
			    		<a href="#" class="btn btn-secondary"  data-toggle="collapse" data-target="#news_group" aria-expanded="false" aria-controls="collapseExample">Newspapers</a>

			    		<div class="collapse show mt-3" id="news_group" style="background-color: #efeded;padding: 12px 4px;">
			    			<?php 
			    			if( $papers = get_terms( array( 'taxonomy' => 'newspapers', 'orderby' => 'name' ) ) ) :
			 
							foreach ( $papers as $news ) :
								
								echo '<div class="col-md-12">';
								// echo '<label>'.$news->name.'</label>';
								echo '<label>'.$news->name.'  '.'<input type="checkbox" name="papers[]" value="'.$news->term_id.'"></label>';
								echo '</div>';
							endforeach;
						endif;

			    			?>
			    		</div>
			    	</div>
			    	<div class="col-md-3">
			    		<a href="#" class="btn btn-secondary"  data-toggle="collapse" data-target="#date_group" aria-expanded="false" aria-controls="collapseExample">Date</a>

			    		<div class="collapse show mt-3" id="date_group" style="background-color: #efeded;padding: 12px 4px;">
			    			<label>Published Date From:</label>
							<input type="date" name="pub_date_from">
							<hr>
							<label>Published Date To:</label>
							<input type="date" name="pub_date_to">
			    		</div>
			    	</div>
			    	<div class="col-md-1">
			    		<a href="#" class="btn btn-secondary"  data-toggle="collapse" data-target="#dates_group" aria-expanded="false" aria-controls="collapseExample">Sort</a>
			    		
						<div class="collapse show mt-3" id="dates_group" style="background-color: #efeded;padding: 12px 4px;">
							<label>
								<input type="radio" name="date" value="ASC" /> ASC
							</label>
							<label>
								<input type="radio" name="date" value="DESC" selected="selected" /> DESC
							</label>
			    		</div>
			    	</div>
			    	<div class="col-md-2">
			    		<button id="apply_filter" class="btn btn-success">Apply filter</button>
						<input type="hidden" name="action" value="myfilter">
						<a class="btn btn-danger mt-2" data-toggle="collapse" data-target="#collapseExample" style="color: #fff;">Cancel</a>
						<hr>
						<a href="<?= site_url()?>/listall" class=" mt-2" style=""><i class="fa fa-back"></i> Refresh Page</a>
			    	</div>
			    </div> -->
	<?php
	// echo '<div class="col-md-4">';
	// 	if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) ) ) :
			 
 // 			echo '<label>Select Category</label>';
	// 		// echo '<select name="categoryfilter" id="category">
	// 		// <option value="">Select category...</option>';
	// 		foreach ( $terms as $term ) :
	// 			// echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; 
	// 			echo '<label>'.$term->name.'</label>';
	// 			echo '<input type="checkbox" name="categoryfilter[]" value="'.$term->term_id.'">';
	// 		endforeach;
	// 		// echo '</select>';
	// 	endif;
	// echo '</div>';
	?>
	
	<!-- <button id="btn_sub" class="btn btn-primary">Apply filter 1</button> -->
	<!-- <input type="button" id="btn_subs" name="actions" value="myfilter 1"> -->

	
</form>
<!-- <div class="resp" id="response">ss</div> -->


<!-- <button id="" class="btn btn-primary btn_sub">Test Button</button> -->
			    </div>
			  </div>
			</div>
		</div>
</div>

<div class="response">
	res
</div>
	<div class="container cards" id="scroll_id">
		<div class="row">
			<div class="col-md-3 tax-heading">
				<h4>List All Tenders</h4>
			</div>
			<div class="offset-7 col-md-2">
			<ul class="nav nav-tabs" id="myTab2" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#listall_view" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list"></i> </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#listall_card" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-th-large"></i> </a>
				  </li>
			</ul>
			</div>
		</div>
		<div class="row card tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="listall_view" role="tabpanel" aria-labelledby="home-tab1">
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
				<div class="tab-pane fade show" id="listall_card" role="tabpanel" aria-labelledby="home-tab1">
				<?php
				if( is_user_logged_in() ) : 
					echo '<div class="row p-3 resp_card" id="outer1">';
						// get_template_part( 'template-parts/content', 'home-card' );
					echo '</div>';
				else:
					echo '<div class="row p-3 resp_card" id="outer1">';
						// get_template_part( 'template-parts/content', 'home-card' );
						
					echo '</div>';
				endif;

				?>
				</div>
		</div>
	
	</div>
</section>

<!-- for nepali datepicker scripts  -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/nepali/nepali.datepicker.v2.2.min.css" />

<!-- <script defer type="text/javascript" src="<?php bloginfo('template_url') ?>/nepali/js/jquery.js"></script> -->
  <script defer type="text/javascript" src="<?php bloginfo('template_url') ?>/nepali/js/bootstrap.min.js"></script>
  <script defer type="text/javascript" src="<?php bloginfo('template_url') ?>/nepali/nepali.datepicker.v2.2.min.js"></script>
  <!-- ends  -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script> -->
<script type="text/javascript">
	$(document).ready(function() {
	    $(".submit_btn").click( function(){
	    	alert('hello');
    	// val = $(this).val();
    	// alert(val);
    	var values = {
            'post_id' : val
        };

        // $('#img_modal').modal('show');
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_info_by_id.php",
          
          // dataType: 'JSON',
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $(".filter_response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('.filter_response').html(errorMsg);
			}
         });
   	});




	$('#btn_sub').click(function(){
	    alert("hello world !!");
	    // var filter = $('#filter');
    	// val = $(this).data("img");

    	// var category = $('#category').val();

    	// var values = {
     //        'category' : category
     //    };
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_posts.php",
          // dataType: 'JSON',
          // data:filter.serialize(), // form data
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $("#response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('#response').html(errorMsg);
			}
         });
   	});

   	$('.notice_cat_checkbox').change(function(){
		var chk_len = $('input.notice_cat_checkbox:checked').length+' Selected';
		$(".notice_p_length").text(chk_len);
   	});
   	$('.notice_news_checkbox').change(function(){
		var chk_len = $('input.notice_news_checkbox:checked').length+' Selected';
		$(".notice_news_length").text(chk_len);
   	});
});

function disable_pub_date(){
	// alert('btn clicked');
	var pub_date = $('#pub_date_flag').attr('checked');
	var chk = $('#pub_date_from').attr('disabled');
	// alert(chk);
    
    if (chk == "disabled") {
    	// alert("enabled");
    	desabledSelectedTag('pub_date_from', 'pub_date_to');
    	enabledSelectedTag_main('sub_date_flag','');

    	// enabledSelectedTag('sub_date_from','sub_date_to');
     //    enabledSelectedTag_main('#sub_date_flag','');
    }else{
        enabledSelectedTag('pub_date_from','pub_date_to');
        // enabledSelectedTag_main('sub_date_flag','');
        // desabledSelectedTag('sub_date_from', 'sub_date_to');
        changestate('#pub_date_flag', '');

     //    desabledSelectedTag('sub_date_from', 'sub_date_to');
    	// disableSelectedTag_main('sub_date_flag');
    }
}

function changestate(item, msg){
	// alert('change sta'+msg);
	// document.getElementById(item).checked=msg;
	$(item).data('checked').text("checked");
}
function disable_sub_date(){
	var pub_date = $('#sub_date_flag').attr('checked');
	var chk = $('#sub_date_from').attr('disabled');
	// alert(pub_date);
    
    if (chk == "disabled") {
    	// alert("enabled");
    	desabledSelectedTag('sub_date_from', 'sub_date_to');
    	// enabledSelectedTag_main('pub_date_flag','');

    	// enabledSelectedTag('pub_date_from','pub_date_to');
        // enabledSelectedTag_main('pub_date_flag','');
    }else{
        enabledSelectedTag('sub_date_from','sub_date_to');
        // enabledSelectedTag_main('pub_date_flag','');
        // desabledSelectedTag('pub_date_from', 'pub_date_to');
        changestate('#sub_date_flag', '');

     //    desabledSelectedTag('pub_date_from', 'pub_date_to');
    	// disableSelectedTag_main('pub_date_flag');
    }
}

function disable_pub_date1(){
	// alert('btn clicked');
	var pub_date = $('#pub_date_flag1').attr('checked');
	var chk = $('#pub_date_from1').attr('disabled');
    
    if (chk == "disabled") {
    	desabledSelectedTag('pub_date_from1', 'pub_date_to1');
    	enabledSelectedTag_main('sub_date_flag1','');
    }else{
        enabledSelectedTag('pub_date_from1','pub_date_to1');
        changestate('#pub_date_flag1', '');
    }
}

function disable_sub_date1(){
	var pub_date = $('#sub_date_flag1').attr('checked');
	var chk = $('#sub_date_from1').attr('disabled');
	// alert(pub_date);
    
    if (chk == "disabled") {
    	// alert("enabled");
    	desabledSelectedTag('sub_date_from1', 'sub_date_to1');
    }else{
        enabledSelectedTag('sub_date_from1','sub_date_to1');
        changestate('#sub_date_flag1', '');
    }
}

function desabledSelectedTag(val, val1) {
        // val.attr('disabled', 'true');
        // alert(val);
        // $('input[name="'+val+'"]').prop('disabled', false);
        document.getElementById(val).disabled=false;
        document.getElementById(val1).disabled=false;
    }

function enabledSelectedTag(val, val1) {
    document.getElementById(val).disabled='disabled';
    document.getElementById(val1).disabled='disabled';
}

function enabledSelectedTag_main(val){
	document.getElementById(val).disabled=false;
}
function disableSelectedTag_main(val){
	document.getElementById(val).disabled='disabled';
}

function bs_nep(){
	document.getElementById('english').style.display='none';
	$("#english :input").attr("disabled", true);

	document.getElementById('nepali').style.display='block';
	enabledSelectedTag('pub_date_from', 'pub_date_to');
	$("#nepali :input").attr("disabled", false);

	$("#sub_date_from1").attr("disabled", true);
	$("#sub_date_to1").attr("disabled", true);
}
function ad_eng(){
	document.getElementById('nepali').style.display='none';
	$("#nepali :input").attr("disabled", true);

	document.getElementById('english').style.display='block';
	$("#english :input").attr("disabled", false);

	$("#sub_date_from").attr("disabled", true);
	$("#sub_date_to").attr("disabled", true);
}
/*
================================================
			Min Jquery Ajax
===============================================
*/

jQuery(function($){
	var resp = '.resp';
// toggle search result from list view to card view, ajax append
$( "#home-tab2" ).click(function() {
	    var list = 'list_view_name';
	    var card = 'card_view_name';
		// alert(list);
	    document.getElementById(list).disabled='disabled';
	    document.getElementById(card).disabled=false;
	    var resp = '.resp_card';
	    // alert(resp);
});
$( "#home-tab1" ).click(function() {
	    var list = 'list_view_name';
	    var card = 'card_view_name';
		// alert(list);
	    document.getElementById(list).disabled=false;
	    document.getElementById(card).disabled='disabled';
	    var resp = '.resp';
});

	$('#filter').submit(function(){
		var filter = $('#filter');
		
		$.ajax({
			url:filter.attr('action'),
			data:filter.serialize(), // form data
			type:filter.attr('method'), // POST
			// format: 'json';
			beforeSend:function(xhr){
				filter.find('#apply_filter').text('Processing...'); // changing the button label
			},
			success:function(data){
				filter.find('#apply_filter').text('Apply filter'); // changing the button label back
				// $(resp).html(data); // insert data
				console.log(data);
				$(".resp").empty();
				$(".resp_card").empty();

				var tbl = $(".resp");
				var grid = $(".resp_card");

				// var myJSON = JSON.stringify(data);
				const data1 = JSON.parse(data);
				console.log(data1);

				var l = 1;
				$.each(data1, function(key, val){
					
					// append in table/list view
		            $("table.table").append("<tr>"+
		            	"<td>" + l + "</td>"+
		            	"<td>" + val.publisher + "</td>"+
		            	"<td><a href='"+val.link+"'>" + val.title + "</a></td>"+
		            	"<td>" + val.published_date + "</td>"+
		            	"<td>" + val.expiry_date + "</td>"+
		            	"<td>" + val.category + "</td>"+
		            	"<td>" + val.paper_names + "</td>"+
		            	"<td>" + val.ind_names + "</td>"+
		            	"<td>" + val.status + "</td>"+
		            	"<td><figure><a class='btn_clk' data-img='"+val.post_id+"'><img src='"+ val.img +"' class='post-thumbnail-mains wp-post-image' width='50' height='50'></a></figure></td>"+
		            	"</tr>");


		            // append in grid view
		            $(".resp_card").append("<div class='col-md-4 mt-3 mb-3 pb-3' style='border-bottom: 1px solid darkgrey;''>"+
		            	"<div class='row'>"+
		            		"<div class='col-md-4'><figure><a href='#' class='btn_clk' data-img='"+val.post_id+"'><img src='"+val.img+"' class='post-thumbnail-main wp-post-image' width='80' height='80' /></a></figure></div>"+
		            		"<div class='col-md-8'>"+
		            			"<div class='row'>"+
		            			"<div class='col-md-12'>"+
		            				"<h5><a href='"+ val.link +"'>" + val.title + "</a></h5>"+
		            			"</div></div>"+
		            			"<div class='row'>"+
		            			"<div class='col-md-12'>"+
		            			"<div class='row'>"+

		            			"<div class='col-md-12'>"+
									"<p class='p_list'>"+
										"<span class='float-left'><i class='fa fa-address-card'></i> "+ val.publisher +"</span>"+
										"<span class='ml-4 float-left'><span></span></span>"+	
									"</p>"+
		            			"</div>"+

		            			"<div class='col-md-12'>"+
									"<p class='p_list'>"+
										"<span class='float-left'><i class='fa fa-list-ul'></i> "+ val.category +"</span>"+
										"<span class='ml-4 float-left'><span></span></span>"+	
									"</p>"+
		            			"</div>"+

		            			"<div class='col-md-12'>"+
									"<p class='p_list'>"+
										"<span class='float-left'><i class='fa fa-paper-plane'></i> "+ val.paper_names +"</span>"+
										"<span class='ml-4 float-left'><span></span></span>"+	
									"</p>"+
		            			"</div>"+

		            			"<div class='col-md-12'>"+
									"<p class='p_list'>"+
										"<span class='float-left'><i class='fa fa-calendar'></i> "+ val.published_date +"</span>"+
										"<span class='ml-4 float-left'><span></span></span>"+	
									"</p>"+
		            			"</div>"+

		            			"<div class='col-md-12'>"+
									"<p class='p_list'>"+
										"<span class='float-left'><i class='fa fa-hourglass-end' style='color: red;'></i> "+ val.status +"</span>"+
										"<span class='ml-4 float-left'><span></span></span>"+	
									"</p>"+
		            			"</div>"+

		            			"</div>"+
		            			"</div>"+
		            			"</div>"+
		            			"</div>"+
		            			"</div>"+
		            			"</div>");


		            l++;
        		});  

$(".btn_clk").click( function(){
    	val = $(this).data("img");
    	var values = {
            'post_id' : val
        };

        $('#img_modal').modal('show');
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_info_by_id.php",
          // dataType: 'JSON',
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $(".response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('.response').html(errorMsg);
			}
         });
    });

				// $('.resp').append(tbl);
				// $('.resp_card').html(data); // insert data
				$('html, body').animate({
			        scrollTop: $("#scroll_id").offset().top -130
			    }, 'slow'); // scroll to div
			}
			
		});
		return false;
	});
});
</script>

<script>
  $( function() {
    $( "#pub_date_from" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      setDate: new Date()
    });

    $( "#pub_date_to" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });

    $( "#sub_date_from" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });

    $( "#sub_date_to" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });

  } );

  $(document).ready(function(){
$('#pub_date_from1').nepaliDatePicker({
      npdMonth: true,
      npdYear: true,
    });
$('#pub_date_to1').nepaliDatePicker({
      npdMonth: true,
      npdYear: true,
    });
$('#sub_date_from1').nepaliDatePicker({
      npdMonth: true,
      npdYear: true,
    });
$('#sub_date_to1').nepaliDatePicker({
      npdMonth: true,
      npdYear: true,
    });
});

  $(document).ready(function() {
$(".btn_clk").click( function(){
    	val = $(this).data("img");
    	// alert(val);
    	var values = {
            'post_id' : val
        };

        $('#img_modal').modal('show');
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_info_by_id.php",
          // dataType: 'JSON',
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $(".response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('.response').html(errorMsg);
			}
         });
   	});
});


$(window).on("load", function () {
    $(".more_posts").attr("disabled",true); 
        id = $(this).data("id");
       
		var data = {
			'action': 'load_posts_by_ajax',
			'page': page,
		};

		$.post(ajaxUrl, data, function(response){
			$('.resp_card').html(response).hide().fadeIn(1500);
			page++;
		});
});
  </script>
<?php get_footer(); ?>