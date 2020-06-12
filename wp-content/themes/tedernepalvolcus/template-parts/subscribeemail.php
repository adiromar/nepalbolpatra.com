<?php /* Template Name: Share Subscribe */
?>
<?php get_header('user'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Google Fonts -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

label{
	position: relative;
	cursor: pointer;
	color: #666;
	font-size: 18px;
}

input[type="checkbox"], input[type="radio"]{
	position: absolute;
	right: 9000px;
}

/*Check box*/
input[type="checkbox"] + .label-text:before{
	content: "\f096";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 5px;
}

input[type="checkbox"]:checked + .label-text:before{
	content: "\f14a";
	color: #2980b9;
	animation: effect 250ms ease-in;
}

input[type="checkbox"]:disabled + .label-text{
	color: #aaa;
}

input[type="checkbox"]:disabled + .label-text:before{
	content: "\f0c8";
	color: #ccc;
}

/*Radio box*/

input[type="radio"] + .label-text:before{
	content: "\f10c";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 5px;
}

input[type="radio"]:checked + .label-text:before{
	content: "\f192";
	color: #8e44ad;
	animation: effect 250ms ease-in;
}

input[type="radio"]:disabled + .label-text{
	color: #aaa;
}

input[type="radio"]:disabled + .label-text:before{
	content: "\f111";
	color: #ccc;
}

/*Radio Toggle*/

.toggle input[type="radio"] + .label-text:before{
	content: "\f204";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 10px;
}

.toggle input[type="radio"]:checked + .label-text:before{
	content: "\f205";
	color: #16a085;
	animation: effect 250ms ease-in;
}

.toggle input[type="radio"]:disabled + .label-text{
	color: #aaa;
}

.toggle input[type="radio"]:disabled + .label-text:before{
	content: "\f204";
	color: #ccc;
}


@keyframes effect{
	0%{transform: scale(0);}
	25%{transform: scale(1.3);}
	75%{transform: scale(1.4);}
	100%{transform: scale(1);}
}


</style>
<?php if (!is_user_logged_in()) {
	?>
	<section class="inner-page blog-page">
		<div class="container">
			<div class="row">
				<?php 
						$class='col-md-12';
				?>

				
				<div class="<?php echo esc_attr($class);?>" style="margin-top: 100px; margin-bottom: 90px;">
					<div class="not-found">
						<h3><?php esc_html_e( 'OOPS, This page could not be found!', 'engager' ); ?></h3>
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links on the menu or You dont have access. Thanks.', 'engager' ); ?></p>

					</div><!-- .page-content -->
				</div>

				

			</div><!-- row -->
		</div><!-- container -->
	</section><!-- section -->
<?php
get_footer();
exit; 
}
?>

<?php 
	global $current_user;
      get_currentuserinfo();
      $useremail = $current_user->user_email;
      $userid = $current_user->ID;
      $sql = "SELECT * FROM `wp_subscription` WHERE user_id='$userid' ORDER BY id DESC";

 					$subs = $wpdb->get_results($sql,ARRAY_A);
 					$subs = $subs[0];
 					$subscribed = $subs['subscriptions'];
 					global $uid;
 					$uid = $subs['user_id'];
 					$subscribed = explode(',', $subscribed);
?>
<section>
<div class="container">
	<div class="row">
		<div class="col col-md-10 col-md-offset-1">
						<?php 
					global $wpdb;
					
					
 			?>
			
		<div class="row">
			<div class="col-md-12" style="margin-top: 120px; ">
				
				<?php 
				if ($_POST['subscribe']) { 
					if (isset($_POST['check'])) {

					$orgnames = $_POST['check'];
					$orgs = implode(',', $orgnames);
					
					if ($userid == $uid) {
						$insert = $wpdb->update('wp_subscription',
											array(
													'subscriptions' => $orgs,
											), array('user_id' => $userid));
					}else{
						$insert = $wpdb->insert('wp_subscription', 
											array(
													'email' => $useremail,
													'subscriptions' => $orgs,
													'user_id' => $userid
												));
					}
					sleep(1);
					}
					
					?>
					<div class="msg" style="width: 100% !important;border: 1px solid #fff;background: #ddeeff; padding: 1%; margin-bottom: 14px;">
					<h4 style="margin-left: 20px;">Thank you! <?php echo $useremail; ?></h4>
					<p style="margin-left: 25px">You have succesfully subscribed. We will email you very soon.</p>
					</div>
				<?php }
				// if (in_array('Mega Bank', $subscribed)) {
					
				// }
				?>
				
				<div class="panel panel-default">
				  <div class="panel-heading" style="border: 1px solid blue; background-color: #31708f; padding: 10px; color: white; font-size: 20px;">Choose your Organizations:<br>
				  <small style="color: #FFC107; font-size: 14px;">We will send you email when your subscribed corporation publishes any notices.</small>
				  </div>
				  <div class="panel-body">
				  <div>
				  	<form action="" method="post" style="margin-top: 30px;">
				  	<?php
				  	$sql = "SELECT * FROM `wp_subscription` WHERE user_id='$userid' ORDER BY id DESC";

 					$subs = $wpdb->get_results($sql,ARRAY_A);
 					$subs = $subs[0];
 					$subscribed = $subs['subscriptions'];
 					global $uid;
 					$uid = $subs['user_id'];
 					$subscribed = explode(',', $subscribed);
				  	$result = (array) $wpdb->get_results(
 						'SELECT DISTINCT orgname FROM `wp_org`'
 					); 
					if (count($result)) {
					$i = 1;
					foreach ($result as $value_obj) {
						$entry = (array) $value_obj;
						if (in_array($entry['orgname'], $subscribed)){ 
							$checked = "checked";?>
								
					<?php	}else{
								$checked = null;
							}
					?>
						<div class="form-check col-md-4">
						<label>
							<input type="checkbox" name="check[]" value="<?php echo $entry['orgname'] ?>" <?php echo $checked;?>><span class="label-text"><?php echo $entry['orgname'] ?></span>
						</label>
						</div>

					<?php 
						 } }
					?>
					</div>
					<input type="submit" name="subscribe" value="SUBSCRIBE" class="pull-right" style="background-color: #31708f; padding: 10px; width: 300px; color: white; font-size: 18px; margin-top: 50px;">
					</form>
				  </div>
				</div>
			</div>
		</div>
		</div>
		</div>
	</div>
</section>
</div>


<?php get_footer(); ?>