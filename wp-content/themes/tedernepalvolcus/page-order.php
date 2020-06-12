<?php
if (!is_user_logged_in()) {
	auth_redirect();
}
 get_header('user');
 
?>

<body>
<div class="container">
<?php 

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
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="border: 1px solid white; margin-top: 80px;">
			

			<h3 style="margin-top: 50px; color: #1b691b;"> Bank Deposit:</h3>
<!-- 			<p>You can deposit in the following bank accounts for placing your orders and email us at sales@tendernepal.com with the copy of scanned payment copy.</p>
 <table class="table table-striped table-bordered ">
	<tr>
	    <th>S. No.</th>
	    <th>BANK NAME</th>
	    <th>A/C NAME</th>
	    <th>A/C NO.</th>

	</tr>

	<tr>
		<td>1</td>
		<td>Machhapuchre Bank Ltd.</td>
		<td>Volcussoft Private Limited.</td>
		<td>123456789</td>
	</tr>

	<tr>
		<td>2</td>
		<td>GlobalIme Bank Ltd.</td>
		<td>Volcussoft Private Limited.</td>
		<td>73468682</td>
	</tr>

	<tr>
		<td>3</td>
		<td>Everest Bank Ltd.</td>
		<td>Volcussoft Private Limited.</td>
		<td>987896878</td>
	</tr>

	<tr>
		<td>4</td>
		<td>Sanima Bank Ltd.</td>
		<td>Volcussoft Private Limited.</td>
		<td>8798403434</td>
	</tr>

	<tr>
		<td>5</td>
		<td>Himalayan Bank ltd.</td>
		<td>Volcussoft Private Limited.</td>
		<td>13452423</td>
	</tr>


</table> -->
<p>Please <span style="font-size: 16px; font-weight: 200; color: blue;"><strong>Email Us OR Contact Us</strong></span> for further payment. Please upload a copy of your deposit voucher after succesful transaction. Thank you for your time!</p>

<form class="form" action="" method="post" enctype="multipart/form-data" style="margin: 50px; border: 2px solid lightblue; padding: 20px; padding-left: 35px;">
	<label class="control-label">Your Contact E-mail:</label>
	<input type="text" name="email" class="form-control" style="width: 300px; margin-top: 10px;" placeholder="Ex. example@gmail.com">
	<label class="control-label" style="margin-top: 20px;">Upload Copy of Your Payment Voucher:</label>
	<input type="file" name="voucher" style="background-color: lightseagreen; width: 300px; padding: 3px; border: 1px solid black; margin-top: 20px;">
	<input type="submit" name="submitvoucher" value="Upload" class="btn btn-success" style="margin-top: 10px;">

</form>

<h3 style="color: #1b691b;">Cash Payment:</h3>
<p>You can deposit cash at Volcussoft Private Limited. Please contact +977- 987654234, 01-4456785 for further details.</p>
		</div>

	</div>
</div>
</body>
</html>

<?php get_footer();?>