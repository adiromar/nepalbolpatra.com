<?php get_header();


global $wpdb;
	if (isset($_POST['submitvoucher'])){
		$email = $_POST['email'];
		// echo "<br><br><br><br>";
		// echo "<pre>";
		// print_r($_FILES);
		if ( $_FILES['voucher']['size'] ) {

			$img_type = strrpos($_FILES['voucher']['type'], '/');
			$extn = $img_type === false ? $_FILES['voucher']['type'] : substr($_FILES['voucher']['type'], $img_type + 1);
			$image_name = "voucher" . $_FILES['voucher']['size'] . '.' . $extn;

			//file location specification to upload
			$file_local = 'wp-content/uploads/vouchers/' . $image_name;
			$file_path = ABSPATH . $file_local;
			$file_name = $image_name;
			$imgupload = move_uploaded_file($_FILES['voucher']['tmp_name'], $file_local);

			//finally insert into database
			$ins = $wpdb->insert('wp_voucher', array('email' => $email, 'voucher' => $file_name));
			if ($ins) {
					$to = "nickarsenal007@gmail.com";
					$subject = "Notification of Voucher Upload!";
					$txt = "A user with email address ".$email." has uploaded payment voucher. Please check administration. http://encoderslab.com/tendernepalvolcus/notify/";
					$headers = "From: nickarsenal007@gmail.com" . "\r\n";

					mail($to,$subject,$txt,$headers);
				echo "<div class='alert alert-success' style='margin-top: 80px;'>Sucessfully Uploaded! Please wait upto a day for confirmation. Thank you.</div>";
				}	

			}else{
?>
<div class="alert alert-warning" style="margin-top: 80px;">File Not Found! Please upload your voucher copy for further processing.</div>
			<?php }
		
	}
?>


<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home</a></span> /
					<span>Pricing</span> /
					<span>Order</span>
					
			</div>
		</div>
	</div>


	<div class="container">
		<div class="card p-3 mt-3">
		<div class="row">
			<div class="col-md-12 col-sm">
				<h3 style="margin-top: 50px; color: #1b691b;"> Bank Deposit:</h3>
				<p>Please <span style="font-size: 16px; font-weight: 200; color: blue;"><strong>Email Us OR Contact Us</strong></span> for further payment. Please upload a copy of your deposit voucher after succesful transaction. Thank you for your time!</p>
			</div>
			
			

<form class="form" action="" method="post" enctype="multipart/form-data" style="margin: 50px; border: 2px solid lightblue; padding: 20px; padding-left: 35px;">
	<label class="control-label">Your Contact E-mail:</label>
	<input type="text" name="email" class="form-control" style="width: 300px; margin-top: 10px;" placeholder="Ex. example@gmail.com">
	<label class="control-label" style="margin-top: 20px;">Upload Copy of Your Payment Voucher:</label>
	<input type="file" name="voucher" style="background-color: lightseagreen; width: 300px; padding: 3px; border: 1px solid black; margin-top: 20px;">
	<input type="submit" name="submitvoucher" value="Upload" class="btn btn-success" style="margin-top: 10px;">

</form>

<div class="col-md-12 col-sm">
	<h3 style="color: #1b691b;">Cash Payment:</h3>
	<p>You can deposit cash at Volcussoft Private Limited. Please contact +977- 987654234, 01-4456785 for further details.</p>
</div>


		</div>
		</div>
	</div>
	


</section>


<?php get_footer(); ?>