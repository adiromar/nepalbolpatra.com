<?php get_header(); 
global $current_user;
 wp_get_current_user();

 require_once( ABSPATH . WPINC . '/registration.php' );

 if ( !empty($_POST) && !empty( $_POST['action'] ) && $_POST['action'] == 'change-password' ) {
 	print_r($_POST);

 if ( !empty($_POST['current_pass']) && !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {

    // if ( !wp_check_password( $_POST['current_pass'], $current_user->user_pass, $current_user->ID) ) {
    if ( $current_user->user_pass == wp_hash_password( $_POST['current_pass'] ) ) {
      $error = '<div class="alert alert-danger"><strong>Your current password does not match. Please retry.</strong></div>';
    } elseif ( $_POST['pass1'] != $_POST['pass2'] ) {
      $error = '<div class="alert alert-danger"><strong>The passwords do not match. Please retry.</strong></div>';
    } elseif ( strlen($_POST['pass1']) < 4 ) {
      $error = '<div class="alert alert-info"><strong>A bit short as a password, don\'t you think?</strong></div>';
    } elseif ( false !== strpos( wp_unslash($_POST['pass1']), "\\" ) ) {
      $error = '<div class="alert alert-danger"><strong>Password may not contain the character "\\" (backslash).</strong></div>';
    } else {
    	 global $rp_cookie, $rp_path;
    // if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
    	 echo "here u are";
        reset_password( $current_user, $_POST['pass1'] );
        setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), false );
        wp_set_current_user( $current_user->ID );
        wp_set_auth_cookie( $current_user->ID );
        do_action( 'wp_login', $current_user->user_login );//`[Codex Ref.][1]
        wp_redirect( home_url() );
        exit;
    // }
// if ( wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) ) == true){
// 	echo "die";die;
// }
      $error = wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );

      if ( !is_int($error) ) {
        $error = '<div class="alert alert-danger"><strong>An error occurred while updating your profile. Please retry.</strong></div>';
      } else {
        // if($error = false){
        	// wp_redirect( home_url( '/?a=resetsuccess' ) );
        	// exit();
        // }

      }
    }
    
  }
 } // ends

?>



<?php 
if(isset($error)) : 
$status = $error;
  ?>
<script>
var snackbar = function() {
  $("#foobar").click();
}
setTimeout(snackbar, 1500); 

function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3500);
}
</script>

<?php endif; ?>

    <!-- toast -->
    <button id="foobar" style="display: none;" onclick="myFunction()">Show Snackbar</button>
    <div id="snackbar">
      <?= $status ?>
    </div>
<!-- Message Toast ends -->
<section class="hero-section-1 main-pg-section pt-5"> 
	<div class="container card pt-5 mt-4">
		<div class="row">

			<form class="form-horizontal pt-5" method="post" id="adduser" action="<?php echo site_url();?>/changepassword/" role="form" style="">
				<h4>Change Password</h4>
				<?php
				if(isset($error)) :
				 echo $error; 
				endif;
				 ?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="row">
		                    <div class="col-md-4 col-sm-12">
		                        <label><i class="fa fa-user"></i> Username*:</label>
		                    </div>
		                    <div class="col-md-8 col-sm-12">
		                      <input class="form-control" type="text" value="<?php echo $current_user->{'user_login'} ?>" readonly>
		                    </div>
		                 </div>
					</div>

					<div class="col-md-12 col-sm-12">
						<div class="row">
		                    <div class="col-md-4 col-sm-12">
		                        <label><i class="fa fa-user"></i> Password*:</label>
		                    </div>
		                    <div class="col-md-8 col-sm-12">
		                      <input class="form-control" name="pass1" type="password" value="" autocomplete="off" required>
		                    </div>
		                 </div>
					</div>

					<div class="col-md-12 col-sm-12">
						<div class="row">
		                    <div class="col-md-4 col-sm-12">
		                        <label><i class="fa fa-user"></i>Confirm Password*:</label>
		                    </div>
		                    <div class="col-md-8 col-sm-12">
		                      <input class="form-control" name="pass2" type="password" value="" autocomplete="off" required>
		                    </div>
		                 </div>
					</div>

					<div class="col-md-12 col-sm-12">
						<input class="form-control" name="current_pass" type="text" value="<?php echo $current_user->{'user_pass'} ?>">


						<input name="updateuser" type="submit" id="updateuser" class="btn btn-primary btn-block col-md-4 col-sm-12" value="Update Profile">
               	 		<input name="action" type="hidden" id="action" value="change-password">
					</div>
				</div>
				
			</form>
		</div>
	</div>
</section>


<?php get_footer('other'); ?>