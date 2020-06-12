

 
<!DOCTYPE html>
<html>
<head>
<style>
.alert {
    padding:20px;
    color:black;
    background-color:rgba(255, 99, 71, 0.5);
    width: 100%;
}
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>
</head>
<body>



<?php
/**
 * The front page template file

 */

get_header();
 
 global $wpdb;
 $result = (array) $wpdb->get_results(
 	'SELECT * FROM `wp_tender` ORDER BY `created_at` DESC LIMIT 5'
 );
//define(ROOTPATH, ABSPATH);

?>

<!--
  /*
		=======================================
    Start of Page Content
  	=======================================
	*/
-->
<header class="jumbotron">
	<div class="container ">
		<div class="row">
			<div class="col-md-12 main_content ">
			 
      
     

			 <?php  
			    if (isset($_GET['reset'])){
			    $reset = $_GET['reset'];  
			    if($reset == 'true') { 
                        echo '<div class="alert alert-success">Check your email for reseting your password!</div>'; 
                        } }else{

                        echo '<div class="alert alert-warning">Your username or email could not be found.</div>'; 	
                        }?>
      

    
				<h2 style="color:#ff4223;">You Are at Right Path</h2>
			<p class="first_para">We provide an affordable, flexible and successful </p>
			<p class="second_para">solution to outsource bid support</p>
			<?php if ( ! is_user_logged_in() ): ?>
				<a data-toggle="modal" data-target="#myModal" onclick="show_register();return false;" class="btn btn-info btn-lg">JOIN US</a>
			<?php endif; ?>
			<!--<p>JOIN US</p>-->
			</div>
		</div>
	</div>
</header>
<!-- //Jumbotron  -->

<div id="content" class="table_content">
<div class="container ">
	<div class="clearfix"></div>
		<h3 style="margin-top:70px">Latest Tenders / Notice</h3>
		<hr style="width: 22%;border-top: 3px solid #ec4707">
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
		    <th style="width:72px">Days remaining</th>
		    <th style="width:90px">Notice Image</th>
		  </thead>
		<tbody class="table_body">

			<?php
				if (count($result)) {
					$i = 1;
					foreach ($result as $value_obj) {
						$entry = (array) $value_obj;
				?>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $entry['publisher'] ?></td>
							<td><?php echo $entry['description'] ?></td>
							<td><?php echo $entry['published_date'] ?></td>
							<td><?php echo $entry['submission_date'] ?></td>
							<td>
								<?php
									echo ucfirst($entry['notice']);
								?>
							</td>
							<td>
								<?php
								echo ucfirst($entry['industry']);
								// 	switch ($entry['industry']) {
								// 		case 'govt':
								// 			echo "Government/ Ministries/ Departments";
								// 		break;
								// 		case 'bank':
								// 			echo "Banking/ Finance /Insurance";
								// 		break;
								// 		case 'hydro':
								// 			echo " Hydro Power/ Energy";
								// 		break;
								// 	}
								?>
							</td>
							<td>
								<?php
								echo $entry['product']
								// 	switch ($entry['product']) {
								// 		case 'auto':
								// 			echo "Automotive / Vehicles";
								// 		break;
								// 		case 'build':
								// 			echo "Building / Construction";
								// 		break;
								// 		case 'auction':
								// 			echo "Auction";
								// 		break;
								// 		case 'architectural':
								// 			echo "Architectural / Interior";
								// 		break;
								// 		case 'estate':
								// 			echo "Real Estate";
								// 		break;
								// 		case 'electronic':
								// 			echo "Electronics / Electric Utilities";
								// 		break;
								// 		case 'health':
								// 			echo "Health / Medical";
								// 		break;
								// 	}
								?>
							</td>
							<td><?php echo $entry['newspaper'] ?></td>
							<td>
								<?php
									$today = new DateTime(date("Y-m-j"));
									$sd = DateTime::createFromFormat( "Y-m-j", $entry['submission_date'] )->settime(0,0);
									$diff = $today->diff($sd)->format("%R%a");
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
								?>
							</td>
							<td>
								<?php if ($entry['image']) { ?>
									<a href="<?php echo wp_upload_dir()['baseurl'] . '/' . $entry['image'] ?>">
										<img src="<?php echo wp_upload_dir()['baseurl'] . '/' . $entry['image'] ?>"
											alt="<?php echo $entry['notice'] . ' image' ?>"
											style="max-height: 100px; max-width: 50px;">
									</a>
								<?php } else { ?>
									&nbsp;n/a
								<?php } ?>
							</td>
						</tr>
				<?php }
			} else {
				echo "</table>";
				echo "There are no Tenders at the Moment.";
			}
			?>
		</tbody>
		</table>
		<a href="<?php echo home_url( '/show-table' ) ?>" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a>
		<?php if(is_user_logged_in()){
		   echo "<strong>Note:</strong> Go to your profile and update your interest fields to get the regular email notifications related to your interest.";
		}
		
		?>
	</div>
	</div>
</div>
</div>
<!-- //.Tender Table -->

<div id="tendor-sector">
	<div class="container">
		<div class="row">
			<header>
				<h3>Tender Categories</h3>
			</header><!-- /header -->
			<hr style="width: 20%; border-top: 3px solid #ec4707">
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
	        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/building.jpg" class="img img-responsive" />
	        	        	<div class="cat_name">
								Building
							</div>

					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/agriculture.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Agriculture
						</div>

					</div>
        		</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/roadways.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Roadways
						</div>

					</div>

        		</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
				<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/medical.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
						Medical
						</div>

						</div>
			</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/chemical.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Chemical
						</div>

					</div>
        		</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/bridges.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Bridges & Tunnels
						</div>
  					</div>
        		</div>
			</div>
		</div>
	</div>
</div>
<!-- //.tender sector -->

<!--
  /*=======================================
    Start of Page Content
  */=======================================
 -->

<?php get_footer();
