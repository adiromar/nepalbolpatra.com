<?php
/**
 * Template Name: Pricing
 *
 */

if( ! is_super_admin() )
{
 auth_redirect();
}

get_header();

?>

<section class="hero-section-1 main-pg-section">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			<div id="form" style="border-radius: 200; border: 2px solid grey; margin-top: 150px; padding: 15px;"> 
				<form class="form" action="" method="post"> 
					<h3>Add Pricing</h3>	
					<label class="control-label">Title/Type:</label>
					<input type="text" name="title" class="form-control" required>
					<label class="control-label">Subtitle:</label>
					<input type="text" name="subtitle" class="form-control">
					<label class="control-label">Total Price:</label>
					<input type="text" name="price" class="form-control" required>
					<label class="control-label">Monthly Price:</label>
					<input type="text" name="month_price" class="form-control" required>
					<hr>
					<input type="submit" name="pricesubmit" class="form-control btn btn-success" value="Add Pricing">
				</form>
			</div>
		</div>
		</div>
	</div>

	</div>	
</div>

<?php 

if(isset($_POST['pricesubmit']))
{
  global $wpdb;

  $title = $_POST['title'];
  $subtitle = $_POST['subtitle'];
  $price = $_POST['price'];
  $monthly = $_POST['month_price'];

  $wpdb->insert('wp_pricing',
  			array(
  				'title'=>$title,
  				'sub'=>$subtitle,
  				'price'=>$price,
  				'monthly'=>$monthly,
  				),array('%s'));
  echo '<div class="well" style="margin-top:325px;"><h3 style="text-align:center;font-size:25px;color:green;"> New Pricing added successfully.</h3></div>';
}
?>

</section>

<?php get_footer(); ?>