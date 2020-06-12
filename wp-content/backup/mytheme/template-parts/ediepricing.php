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


if(isset($_POST['pricesubmit']))
{
  global $wpdb;
  $id = $_POST['id'];
  $title = $_POST['title'];
  $subtitle = $_POST['subtitle'];
  $price = $_POST['price'];
  $monthly = $_POST['month_price'];

  $wpdb->update('wp_pricing', array(
  								'title' => $title,
  								'sub' => $subtitle,
  								'price' => $price,
  								'monthly' => $monthly,
  									), array('id'	=>	"{$id}"));
  echo '<div class="alert alert-success" style="margin-top:100px;"><h3 style="text-align:center;font-size:25px;color:black;"> New Pricing Updated successfully.</h3></div>';
}
?>
<?php 
global $wpdb;
	$result1 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '1'",ARRAY_A );
	$result1 = $result1['0'];

	$result2 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '2'" , ARRAY_A);
	$result2 = $result2['0'];

	$result3 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '3'" , ARRAY_A );
	$result3 = $result3['0'];
?>

<section class="hero-section-1 main-pg-section">
	<div class="container">
			<div class="row">
		<div class="col-md-4">
			<div id="form" style="border-radius: 200; border: 2px solid grey; margin-top: 150px; padding: 15px;"> 
				<form class="form" action="" method="post"> 
					<h3>Pricing 1</h3>	
					<input type="hidden" name="id" value="1">
					<label class="control-label">Title/Type:</label>
					<input type="text" name="title" class="form-control" value="<?= $result1['title'] ?>" required>
					<label class="control-label">Subtitle:</label>
					<input type="text" name="subtitle" class="form-control" value="<?= $result1['sub'] ?>">
					<label class="control-label">Total Price:</label>
					<input type="text" name="price" class="form-control" value="<?= $result1['price'] ?>" required>
					<label class="control-label">Monthly Price:</label>
					<input type="text" name="month_price" class="form-control" value="<?= $result1['monthly'] ?>" required>
					<hr>
					<input type="submit" name="pricesubmit" class="form-control btn btn-success" value="Update Pricing">
				</form>
			</div>
		</div>

			<div class="col-md-4">
			<div id="form" style="border-radius: 200; border: 2px solid grey; margin-top: 150px; padding: 15px;"> 
				<form class="form" action="" method="post"> 
					<h3>Pricing 2</h3>	
					<input type="hidden" name="id" value="2">
					<label class="control-label">Title/Type:</label>
					<input type="text" name="title" class="form-control" value="<?= $result2['title'] ?>" required>
					<label class="control-label">Subtitle:</label>
					<input type="text" name="subtitle" class="form-control" value="<?= $result2['sub'] ?>">
					<label class="control-label">Total Price:</label>
					<input type="text" name="price" class="form-control" value="<?= $result2['price'] ?>" required>
					<label class="control-label">Monthly Price:</label>
					<input type="text" name="month_price" class="form-control" value="<?= $result2['monthly'] ?>" required>
					<hr>
					<input type="submit" name="pricesubmit" class="form-control btn btn-success" value="Update Pricing">
				</form>
			</div>
		</div>

			<div class="col-md-4">
			<div id="form" style="border-radius: 200; border: 2px solid grey; margin-top: 150px; padding: 15px;"> 
				<form class="form" action="" method="post"> 
					<h3>Pricing 3</h3>	
					<input type="hidden" name="id" value="3">
					<label class="control-label">Title/Type:</label>
					<input type="text" name="title" class="form-control" value="<?= $result3['title'] ?>" required>
					<label class="control-label">Subtitle:</label>
					<input type="text" name="subtitle" class="form-control" value="<?= $result3['sub'] ?>">
					<label class="control-label">Total Price:</label>
					<input type="text" name="price" class="form-control" value="<?= $result3['price'] ?>" required>
					<label class="control-label">Monthly Price:</label>
					<input type="text" name="month_price" class="form-control" value="<?= $result3['monthly'] ?>" required>
					<hr>
					<input type="submit" name="pricesubmit" class="form-control btn btn-success" value="Update Pricing">
				</form>
			</div>
		</div>
	</div>	
	</div>
</section>

<?php get_footer(); ?>