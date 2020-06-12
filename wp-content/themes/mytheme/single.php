<?php
 get_header(); 

$post_id = get_the_ID();
$cat = get_the_category();
 
global $wpdb;
if(isset($_POST['proposal_submit']))
{
// echo '<pre>';
// print_r($_POST);die;

  $company_name = $_POST['company_name'];
  $contact_name = $_POST['contact_name'];
  $email = $_POST['email'];
  $phone_no = $_POST['contact_number'];
  // $tender_name = $_POST['tender_name'];
  $proposal_link = $_POST['proposal_link'];
  $baseline = $_POST['baseline'];
  $budget_volume = $_POST['budget_volume'];
  $pages_number = $_POST['pages_number'];

   $table = "wp_proposal_writing_support";
  $insert = $wpdb->insert('wp_proposal_writing_support',array(
  	'company_name' => $company_name,
  	'contact_name' => $contact_name,
  	'email' => $email,
  	'contact_number' => $phone_no,
  	'baseline' => $baseline,
  	'proposal_link' => $proposal_link,
  	'budget_volume' => $budget_volume,
  	'pages_number' => $pages_number,
  ),array(
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  ));

  // print_r($insert);die;
  // echo '<div class="alert alert-success"><h4>New Industry added successfully.</h4></div>';

  if($insert){ ?>

  	<script>
var snackbar = function() {
  $("#message").click();
}
setTimeout(snackbar, 1500); 

// load message
function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3500);
}
</script>

<?php  }else{ ?>
	<script>
  	var snackbar = function() {
  $("#message2").click();
}
setTimeout(snackbar, 1500); 

// load message
function myFunction() {
  var x = document.getElementById("snackbar11");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3500);
}
</script>
  <?php }
}
?>
<style type="text/css">
	th{
		font-weight: 600;
	}
	.brd-crm span{
		font-size: 14px;
		color: var(--blue);
	}
	.quote-btn-supprt{
		background: #223645;
	    color: #fff;
	    padding: 12px 34px;
	    border-radius: 5px;
	}
	.quote-btn-supprt:hover{
		background-color: darkorange !important;
		color: #ddd;
	}
</style>

		<!-- toast -->
		<button id="message" style="display: none;" onclick="myFunction()">Show Snackbar</button>
		<button id="message2" style="display: none;" onclick="myFunction2()">Show Snackbar</button>
		<div id="snackbar">
			<div class="alert alert-success"><strong>Details Submitted </strong> to Admin.
			</div>
		</div>
		<div id="snackbar11" style="display: none;">
			<div class="alert alert-danger"><strong>Submit Error</strong> Please Try Again.
			</div>
		</div>

<section class="hero-section-1 main-pg-section">

	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home</a></span> /
					<span><?= $cat[0]->name; ?></span> /
					<span><?= get_the_title(); ?></span>
			</div>
		</div>
	</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$cat_id = get_the_ID();
	$meta = get_post_meta($cat_id);
	// echo '<pre>';
	// print_r($meta);


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

<div class="container card mt-4" style="min-height: 200px;">
	<div class="row mt-4 mb-4">
		<div class="col-md-12 col-sm">

			<h4><?= the_title(); ?></h4>
			<hr>
			<div class="mt-3 mb-4">
				<h6><b>Specification:</b></h6>
				<table class="table table-hover table-striped" style="line-height: 0.7rem;">
					<tr>
						<th width="5%"><i class="fa fa-list-ul"></i></th>
						<th width="40%">Category</th>
						<td width="5%">:</td>
						<td width="50%"><?= $cat_names; ?></td>
					</tr>
					<?php if($paper_names){ ?>
					<tr>
						<th width="5%"><i class="fa fa-paper-plane"></i></th>
						<th width="40%">Newspaper</th>
						<td width="5%">:</td>
						<td width="50%"><?= $paper_names; ?></td>
					</tr>
					<?php }if($pro_names){ ?>
					<tr>
						<th width="5%"><i class="fa fa-list"></i></th>
						<th width="40%">Products</th>
						<td width="5%">:</td>
						<td width="50%"><?= $pro_names; ?></td>
					</tr>
				<?php }if($ind_names){ ?>
					<tr>
						<th width="5%"><i class="fa fa-building"></i></th>
						<th width="40%">Industry</th>
						<td width="5%">:</td>
						<td width="50%"><?= $ind_names; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<th width="5%"><i class="fa fa-address-card"></i></th>
						<th width="40%">Publisher</th>
						<td width="5%">:</td>
						<td width="50%"><?= $publisher; ?></td>
					</tr>
					<tr>
						<th width="5%"><i class="fa fa-calendar"></i></th>
						<th width="40%">Published Date</th>
						<td width="5%">:</td>
						<td width="50%"><?= $published_date; ?></td>
					</tr>
					<tr>
						<th width="5%"><i class="fa fa-calendar fa-red"></i></th>
						<th width="40%">Expiry Date</th>
						<td width="5%">:</td>
						<td width="50%"><?= $expiry; ?></td>
					</tr>
					<tr>
						<th width="5%"><i class="fa fa-hourglass-end fa-red"></i></th>
						<th width="40%">Days Remaining</th>
						<td width="5%">:</td>
						<td width="50%"><?php
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
						?></td>
					</tr>
				</table>

				
			</div>

<div class="col-md-12 col-sm-12 pt-4 pb-2">
	<div class="row">
		<div class="col-md-6">
			<a href="#" data-toggle="modal" data-target="#support_modal" class="quote-btn-supprt">Need Support on Proposal Writing?</a>
		</div>
		<div class="col-md-6 pull-right" style="text-align: right;">
			<a href="" class="quote-btn-supprt">Request Quotation</a>
		</div>
	</div>
</div><hr>
			<div class="col-md-12 col-sm-12 pt-3" style="text-align: center;">
			<?php
				if ( has_post_thumbnail() ) {
				    the_post_thumbnail( 'medium_large');
				} ?>

				

			</div>
			<div class="col-md-12 col-sm-12 mt-3 mb-3" style="text-align: center;">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				 <i class="fa fa-eye"></i> View Image
				</button>
			</div>
		</div>
		
		<div class="col-md-12 col-sm" >
			<?= the_content(); ?>
		</div>
		

	</div>
</div>

<style type="text/css">
	.zoom {
  /*padding: 50px;*/
  /*background-color: green;*/
  transition: transform .2s;
  width: 200px;
  height: 200px;
  margin: 0 auto;
}

.zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5); 
}
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				    the_post_thumbnail( 'full', array('class' => 'zoom') );
				}else{
					echo "No Image Found";
				}

				?>


      </div>
    </div>
  </div>
</div>


<?php endwhile; 
else :
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );

    endif; ?>

</section>

<div class="modal fade" id="support_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content mdl-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Need Support On Proposal Writing ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="form_proposal">
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12 col-sm-12">
        		<label>Company Name: </label>
        		<input type="text" name="company_name" class="form-control" required>
        	</div>

        	<div class="col-md-6 col-sm-12 mt-3">
        		<label>Contact Name: </label>
        		<input type="text" name="contact_name" class="form-control" required>
        	</div>

        	<div class="col-md-6 col-sm-12 mt-3">
        		<label>Contact Number: </label>
        		<input type="text" name="contact_number" class="form-control" required>
        	</div>

        	<div class="col-md-6 col-sm-12 mt-3">
        		<label>Email</label>
        		<input type="email" name="email" class="form-control">
        	</div>

			<div class="col-md-6 col-sm-12 mt-3">
        		<label>Proposal Link</label>
        		<input type="text" name="proposal_link" class="form-control">
        	</div>

        	<div class="col-md-12 col-sm-12 mt-3">
        		<label>Do You Have Baseline Data: </label>
        		<label class="ml-4"><input type="radio" value="Yes" name="baseline" class="" required>Yes</label>
        		<label class="ml-4"><input type="radio" value="No" name="baseline" class="" required>No</label>
        	</div>

        	<div class="col-md-4 col-sm-12 mt-3">
        		<label>Volume Of Budget: </label>
        		<input type="number" min="0" name="budget_volume" class="form-control">
        	</div>

        	<div class="col-md-4 col-sm-12 mt-3">
        		<label>Number Of Pages: </label>
        		<input type="number" min="0" name="pages_number" class="form-control">
        	</div>

        </div>
      </div>
      <div class="modal-footer">
		<input type="submit" name="proposal_submit" class="btn btn-primary" value="Send">
        <!-- <button type="button" class="btn btn-primary">Send </button> -->
      </div>
  </form>
    </div>
  </div>
</div>

<?php get_footer('other'); ?>