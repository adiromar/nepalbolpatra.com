<!-- Custom Login/Register/Password Code @ https://digwp.com/2010/12/login-register-password-code/ -->
<!-- Theme Template Code -->

<div id="login-register-password">

	<?php 
	
	global $user_ID, $user_identity;
	// echo wp_upload_dir()['baseurl'] . '/GIT.png';
	// var_dump( wp_upload_dir()['baseurl'] );
	// var_dump( get_stylesheet_directory_uri() );
	if ( !$user_ID ) { ?>

	<ul class="tabs_login">
		<li class="active_login"><a href="#tab1_login">Login</a></li>
		<li><a href="#tab2_login">Register</a></li>
		<li><a href="#tab3_login">Forgot?</a></li>
	</ul>
	<div class="tab_container_login">
		<div id="tab1_login" class="tab_content_login" style="">

			<?php $register = $_GET['register']; $reset = $_GET['reset']; if ($register == true) { ?>

			<h3>Success!</h3>
			<p>Check your email for the password and then return to log in.</p>

			<?php } elseif ($reset == true) { ?>

			<h3>Success!</h3>
			<p>Check your email to reset your password.</p>

			<?php } else { ?>

			<h3>Have an account?</h3>
			<p>Log in or sign up! It&rsquo;s fast &amp; <em>free!</em></p>

			<?php } ?>

			<form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username'); ?>: </label>
					<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" />
				</div>
				<div class="password">
					<label for="user_pass"><?php _e('Password'); ?>: </label>
					<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
				</div>
				<div class="login_fields">
					<div class="rememberme">
						<label for="rememberme">
							<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me
						</label>
					</div>
					<?php do_action('login_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Login'); ?>" tabindex="14" class="user-submit" />
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
		<div id="tab2_login" class="tab_content_login" style="display:none;">
			<h3>Register for this site!</h3>
			<p>Sign up now for the good stuff.</p>
			<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('Username'); ?>: </label>
					<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
				</div>
				<div class="password">
					<label for="user_email"><?php _e('Your Email'); ?>: </label>
					<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
				</div>
				<div class="login_fields">
					<?php do_action('register_form'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Sign up!'); ?>" class="user-submit" tabindex="103" />
					
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
		<div id="tab3_login" class="tab_content_login" style="display:none;">
			<h3>Lose something?</h3>
			<p>Enter your username or email to reset your password.</p>
			<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
					<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" name="user-submit" value="<?php _e('Reset my password'); ?>" class="user-submit" tabindex="1002" />
					<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
	</div>

	<?php } else { // is logged in ?>

	<div class="sidebox">
		<h3>Welcome, <?php echo $user_identity; ?></h3>
		<div class="usericon">
			<?php global $userdata; echo get_avatar($userdata->ID, 60); ?>

		</div>
		<div class="userinfo">
			<p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p>
			<p>
				<a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> |
				<?php if (current_user_can('manage_options')) {
					echo '<a href="' . admin_url() . '">' . __('Admin') . '</a>'; } else {
					echo '<a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>'; } ?>

			</p>
		</div>
	</div>

	<?php } ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	jQuery(document).ready(function($) {
		$(".tab_content_login").hide();
		$("ul.tabs_login li:first").addClass("active_login").show();
		$(".tab_content_login:first").show();
		$("ul.tabs_login li").click(function() {
			$("ul.tabs_login li").removeClass("active_login");
			$(this).addClass("active_login");
			$(".tab_content_login").hide();
			var activeTab = $(this).find("a").attr("href");
			$(activeTab).show();
			return false;
		});
	});
</script>

<style type="text/css">
ul.tabs_login {
	padding: 0; margin: 20px 0 0 0;
	position: relative;
	list-style: none;
	font-size: 14px;
	z-index: 1000;
	float: left;
	}
ul.tabs_login li {
	border: 1px solid #E7E9F6;
	 -webkit-border-top-right-radius: 10px;
	 -khtml-border-radius-topright: 10px;
	 -moz-border-radius-topright: 10px;
	border-top-right-radius: 10px;
	 -webkit-border-top-left-radius: 10px;
	 -khtml-border-radius-topleft: 10px;
	 -moz-border-radius-topleft: 10px;
	border-top-left-radius: 10px;
	line-height: 28px; /* = */ height: 28px;
	padding: 0; margin: 0 5px 0 0;
	position: relative;
	background: #fff;
	overflow: hidden;
	float: left;
	}
ul.tabs_login li a {
	text-decoration: none;
	padding: 0 10px;
	display: block;
	outline: none;
	}
html ul.tabs_login li.active_login {
	border-left: 1px solid #E7E9F6;
	border-bottom: 1px solid #fff;
	 -webkit-border-top-right-radius: 10px;
	 -khtml-border-radius-topright: 10px;
	 -moz-border-radius-topright: 10px;
	border-top-right-radius: 10px;
	 -webkit-border-top-left-radius: 10px;
	 -khtml-border-radius-topleft: 10px;
	 -moz-border-radius-topleft: 10px;
	border-top-left-radius: 10px;
	background: #fff;
	color: #333;
	}
html body ul.tabs_login li.active_login a { font-weight: bold; }
.tab_container_login {
	background: #fff;
	position: relative;
	margin: 0 0 20px 0;
	border: 1px solid #E7E9F6;
	 -webkit-border-bottom-left-radius: 10px;
	 -khtml-border-radius-bottomleft: 10px;
	 -moz-border-radius-bottomleft: 10px;
	border-bottom-left-radius: 10px;
	 -webkit-border-bottom-right-radius: 10px;
	 -khtml-border-radius-bottomright: 10px;
	 -moz-border-radius-bottomright: 10px;
	border-bottom-right-radius: 10px;
	 -webkit-border-top-right-radius: 10px;
	 -khtml-border-radius-topright: 10px;
	 -moz-border-radius-topright: 10px;
	border-top-right-radius: 10px;
	z-index: 999;
	float: left;
	width: 100%;
	top: -1px;
	}
.tab_content_login {
	padding: 7px 15px 15px 15px;
	padding-top: 10px;
	}
	.tab_content_login ul {
		padding: 0; margin: 0 0 0 15px;
		}
		.tab_content_login li { margin: 5px 0; }
/* global styles */
#login-register-password {}
	#login-register-password h3 {
		border: 0 none;
		margin: 10px 0;
		padding: 0;
		}
	#login-register-password p {
		margin: 0 0 15px 0;
		padding: 0;
		}
/* form elements */
.wp-user-form {}
	.username, .password, .login_fields {
		margin: 7px 0 0 0;
		overflow: hidden;
		width: 100%;
		}
		.username label, .password label { float: left; clear: none; width: 25%; }
		.username input, .password input {
			font: 12px/1.5 "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif;
			float: left; clear: none; width: 200px; padding: 2px 3px; color: #777;
			}
.rememberme { overflow: hidden; width: 100%; margin-bottom: 7px; }
#rememberme { float: left; clear: none; margin: 4px 4px -4px 0; }
.user-submit { padding: 5px 10px; margin: 5px 0; }
.userinfo { float: left; clear: none; width: 75%; margin-bottom: 10px; }
	.userinfo p {
		margin-left: 10px;
		}
.usericon { float: left; clear: none; width: 15%; margin: 0 0 10px 22px; }
	.usericon img {
		border: 1px solid #F4950E;
		padding: 1px;
		}
</style>
