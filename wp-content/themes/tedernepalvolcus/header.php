<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * 
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<?php 
		$result = (array) $wpdb->get_results(
 			'SELECT publisher,description FROM `wp_tender` ORDER BY `created_at` DESC LIMIT 10'
 				);
		if (count($result)) 
				{
					foreach ($result as $value_obj) 
					{
						$entry = (array) $value_obj;
						$values .= $entry['publisher'].','.$entry['description'].', ';
					}
				}
	?>
	<meta name="keywords" content="<?= $values ?>">
	<title>Nepalbolpatra</title>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/stylenew.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/hover-min.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

	<script
	  src="https://code.jquery.com/jquery-3.2.1.js"
	  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
	  crossorigin="anonymous">
	</script>
	<style type="text/css">
		#myNavbar a{
			cursor: pointer;
		}
				/* Dropdown Button */
.dropbtn {
    background-color: #364043;
    color: white;
    padding: 16px;
    border: none;
    cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    color: orange;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}


	</style>
	<?php	wp_head(); ?>
</head>

<body>
	<?php $uid = get_current_user_id();
 $user = get_user_meta($uid, 'user_type');
 $user = $user[0]; ?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
  	<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php //if ( ! is_super_admin() ): ?>
      <a class="navbar-brand" href="<?php echo home_url() ?>">Nepalbolpatra</a>
  <?php //endif; ?>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar" style="margin-left: -11px;">
      <ul class="nav navbar-nav">
      	<?php 
    			global $post;
    			$post_slug=$post->post_name;
		?>
        	<?php  if($user == 'paid'): ?>
        	<li><a href="<?php echo home_url( '/show-table' ) ?>" <?php if ($post_slug == 'show-table'){ echo "style='color: red'";} ?>>TENDERS</a></li>
        <?php endif; ?>
				<?php if ( ! is_super_admin() ): ?>
	        <li><a href="<?php echo home_url( '/pricing' ) ?>" <?php if ($post_slug == 'pricing'){ echo "style='color: red'";} ?>>PRICING</a></li>
	        <!-- <li><a href="<?php echo home_url( '/features' ) ?>" <?php if ($post_slug == 'features'){ echo "style='color: red'";} ?>><i class="fa fa-fire" aria-hidden="true" style="color: orange;"></i> FEATURED NOTICES</a></li> -->
	        <!-- <li><a href="<?php echo home_url( '/sharebazaar' ) ?>" <?php if ($post_slug == 'sharebazaar'){ echo "style='color: red'";} ?>><img src="<?php bloginfo('template_url') ?>/assets/images/arrow.png" width="20" height="20">  SHARE BAZAAR</a></li> -->
				<?php endif; ?>
				<?php if ( is_super_admin() ): ?>
					<li><a href="<?php echo home_url( '/add-pricing' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;PRICING</a></li>
					<!-- <li>
					<div class="dropdown">
					  <button onMouseOver="myFunction()" class="dropbtn">ADD CATEGORIES <i class="fa fa-caret-down" aria-hidden="true"></i></button>
					  <div id="myDropdown" class="dropdown-content">
					  	<a href="<?php echo home_url( '/addproduct' ) ?>">&nbsp;PRODUCT/SERVICE</a>
					    <a href="<?php echo home_url( '/addnewspaper' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;NEWSPAPER</a>
					    <a href="<?php echo home_url( '/addindustry' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;INDUSTRY</a>
					    <a href="<?php echo home_url( '/addnotice-category' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;NOTICE</a>
					    <a href="<?php echo home_url( '/add-pricing' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;PRICING</a>
					  </div>
					</div>
					</li> -->
					<li><a href="<?php echo home_url( '/show-tenders' ) ?>" <?php if ($post_slug == 'show-tenders'){ echo "style='color: red'";} ?>>TENDERS</a></li>
					<!-- <li><a href="<?php echo home_url( '/form' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;TENDER</a></li> -->
					<li></li>
					<!-- <li><a href="<?php echo home_url( '/add-shareinfo' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;SHARE INFO</a></li> -->
					<!-- <li><a href="<?php echo home_url( '/add-featured' ) ?>"><i class="fa fa-plus" aria-hidden="true" style="color:green"></i>&nbsp;FEATURED</a></li> -->
					
				<?php endif; ?>
      </ul>
			<?php if( !is_user_logged_in() ) : ?>
      <div class="member_area">
      	<p id="register_mod_link" style="padding-left: 25px;" data-toggle="modal" data-target="#myModal" onclick="show_register();return false;" >REGISTER</p>
      	<p id="signin_mod_link" data-toggle="modal" data-target="#myModal" onclick="show_login();return false;">SIGN IN</p>
				<p style="display:none" id="lostpass_mod_link" data-toggle="modal" data-target="#myModal" onclick="show_forgot();return false;">Lost Password</p>
      </div>
			<?php else : ?>
				<div class="member_area">
					<p style="padding-left: 5px;">
						<a href="<?php echo wp_logout_url( home_url() ) ?>" class="btn btn-info btn-xs">
							<i class="fa fa-power-off" aria-hidden="true"></i>
							LOGOUT
						</a>
					</p>
					<?php if ( is_super_admin() ): ?>
						<p style="padding-left: 0px;">
						<a href="<?php echo home_url( '/notify' ) ?>" style="color: #2de417; font-size: 15px; margin-right: 20px; margin-bottom: 10px;">
							<i class="fa fa-bell" aria-hidden="true"></i>&nbsp;Vouchers
						</a>
					</p>


					<?php endif; ?>
	      			<p style="padding-left: 0px;">
						<a href="<?php echo home_url( '/user' ) ?>" style="color: orange; font-size: 15px; margin-right: 20px; margin-bottom: 10px;">
							<i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile
						</a>
					</p>
					<!-- <p style="padding-left: 25px;">
						<?php
							echo get_avatar( wp_get_current_user()->{'ID'}, 30, "user" );
						?>
					</p> -->
	      </div>
			<?php endif; ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
		<div class="login tab_content_login" id="tab1_login" style="display: block;">
			<form id="accesspanel" action="<?php bloginfo('url') ?>/wp-login.php" method="post" style="height:360px; margin-top:20px; width: 300px;">
				<!-- ********LOGIN*******
					********************* -->

				<h1 id="litheader" ><a href="" >LOG IN</a></h1>
				<?php  
			    if (isset($_GET['action'])){
			    $login = $_GET['action'];  
			    if($login) { 
                        echo '<p style="color:white; margin-left:15px;">Verify your email and password!</p>'; 
                        } }?>
                        
				<div class="inset">
				  <p>
				    <input style="margin-left: -5px; width: 250px;" type="text" name="log" id="email" placeholder="Email address" value="<?php echo (isset($user_login)) ? esc_attr(stripslashes($user_login)) : ''; ?>" required >
				  </p>
				  <p>
				    <input type="password" style="margin-left: -5px; width: 250px;" name="pwd" id="password" placeholder="Access code" required>
				  </p>
				  <div style="margin-top: -10px; text-align: center; margin-bottom: 5px;">
				    <div class="checkboxouter">
				      <input type="checkbox" name="rememberme" id="remember" value="forever">
				      <label class="checkbox"></label>
				    </div>
				    <label for="remember">Remember me</label>
				  </div>
					<?php do_action('login_form'); ?>
				  <input class="loginLoginValue" type="hidden" name="service" value="login" />
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI'] . '#content'; ?>" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
				<p class="p-container">
				  <input type="submit" style="margin-left: -5px; width: 250px;" name="user-submit" id="go" value="Authorize">
				</p>
			  <p class="f_login" style="color:#FFbb00; text-align:center; font-size:12px;">
					<a href="#" onclick="show_register();return false;">Register</a>
					<span style="color:white; padding:0 5px 0 5px;" >|</span>
					<a href="#" onclick="show_forgot();return false;"> Lost your password ?</a>
				</p>
			</form>
		</div>
		<!--****************************************
		**************REGISTER*********************-->
		<div class="register tab_content_login" id='tab2_login' style="display: none">
		  <form id="accesspanel" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post" style="height:350px; margin-top:20px; width: 300px;" >
			  <h1 id="litheader">REGISTER</h1>
			  <div class="inset">
			    <p style="margin-left:-6px;">
			      <input type="text" name="user_login" style="width: 250px;" id="email" placeholder="Username" value='<?php echo (isset($user_login)) ? esc_attr(stripslashes($user_login)) : '';?>' required>
			    </p>
             
			    <p style="margin-left:-6px; margin-bottom:-25px;">
			    	<input type="text" name="user_email" style="width: 250px;" id="email" placeholder="Email address" value="<?php echo (isset($user_email)) ? esc_attr(stripslashes($user_email)) : '';?>" required>
			    </p>
			    <input class="loginLoginValue" type="hidden" name="service" value="register" />
			  </div>
			  <br>
				<p class="p-container">
					<?php do_action('register_form'); ?>
					<input type="submit" style="margin-left: -3px; width: 250px;" name="user-submit" id="go" value="Register">
				</p>
				<!-- Check your email alert -->
				<?php // $register = $_GET['register']; if($register == true) { echo '<p>Check your email for the password!</p>'; } ?>
				<!--  -->
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
				<input type="hidden" name="user-cookie" value="1" />
		    <p class="f_login" style="color:#FFbb00; text-align:center; font-size:12px;">
					<a href="#" onclick="show_login();return false;">Log In</a>
					<span style="color:white; padding:0 5px 0 5px;" >|</span>
					<a href="#" onclick="show_forgot();return false;"> Lost your password ?</a>
		  	</p>
			</form>
		</div>
		<!--/****************************************
		*******************************************/-->

		<!--/****************LOST PASSWORD**************
		*******************************************/-->
		<div class="forgot_password tab_content_login" id="tab3_login" style="display: none; ">
		  <form id="accesspanel" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post">
			  <h1 id="litheader" >Forgot Password</h1>
			  <div class="inset">
			    <p  style="margin-left:-20px;">
			      <input type="text" name="user_login" id="forgot_password" placeholder="Username or Email Address" required>
			    </p>
				  <p class="p-container" style="margin-left:-20px;">
						<?php do_action('login_form', 'resetpass'); ?>
				    <input type="submit" name="user-submit" id="go" value="Get New password">
					</p>
					<!-- Email has been sent: ALERT -->
					  <?php 
					  // $reset = isset($_GET['action']) ? $_GET['action'] : ''; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } 
					  ?>
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />

			<!-- ******LOST PASSWORD ENDS HERE******
				************************************ -->

					



					<input type="hidden" name="user-cookie" value="1" />
					<!--  -->
			    <p class="f_login" style="color:#FFbb00; text-align:center; font-size:12px;">
						<a href="#" onclick="show_login();return false;">Log In</a>
						<span style="color:white; padding:0 5px 0 5px;" >|</span>
						<a href="#" onclick="show_register();return false;"> Register</a>
				  </p>
				</div>
			</form>
		</div>
	</div>
</div>

asdasd
<script type="text/javascript">
	/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}



</script>