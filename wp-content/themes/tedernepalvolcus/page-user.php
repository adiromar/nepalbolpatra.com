<?php get_header('user'); ?>
<html>
<br><br><br>

<div class="container">
  <div class="row">
  
    
  <?php

 global $current_user;
 wp_get_current_user();

 require_once( ABSPATH . WPINC . '/registration.php' );

if ( !empty($_POST) && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
  // echo '<pre>';
// print_r($_POST);die;
  //  Update user password
  if ( !empty($_POST['current_pass']) && !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {

    if ( !wp_check_password( $_POST['current_pass'], $current_user->user_pass, $current_user->ID) ) {
      $error = 'Your current password does not match. Please retry.';
    } elseif ( $_POST['pass1'] != $_POST['pass2'] ) {
      $error = 'The passwords do not match. Please retry.';
    } elseif ( strlen($_POST['pass1']) < 4 ) {
      $error = 'A bit short as a password, don\'t you think?';
    } elseif ( false !== strpos( wp_unslash($_POST['pass1']), "\\" ) ) {
      $error = 'Password may not contain the character "\\" (backslash).';
    } else {
      $error = wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );

      if ( !is_int($error) ) {
        $error = 'An error occurred while updating your profile. Please retry.';
      } else {
        $error = false;
      }
    }
    
  }

  //  Update User Info
  $s = wp_update_user( array(
    'ID'          =>  "{$current_user->ID}",
    'first_name'  =>  "{$_POST['firstname_new']}",
    'last_name'   =>  "{$_POST['lastname_new']}",
    // 'nickname'   =>  "{$_POST['nickname_new']}",
    'user_email'  =>  "{$_POST['email_new']}",
    'user_url'    =>  "{$_POST['website_new']}",
    'description' =>  "{$_POST['description_new']}"
  ) );

  //  Update User Interest-field 
  do_action( 'personal_options_update', $current_user->ID );
  if ( is_wp_error( $s ) ) {
  // There was an error, probably that user doesn't exist.
    echo "<div class='alert alert-warning' style='margin-top: 50px;'>There was an error updating your profile. Please Try again.</div>";
} else {
  // Success!
   echo "<div class='alert alert-success' style='margin-top: 50px;'>You have successfully updated your profile info.</div>";
}
}
$user_info = get_user_meta($current_user->ID);
?>

  <div class="col-md-12">

    <div class="content" style="margin-top: 20px;">
      
      <?php if ( !empty($error) ): ?>
      
        <?php echo '<div class="alert alert-warning">'.$error.'</div>'; ?>
     
<?php endif; ?>
 <?php 
      switch ($error) {
        case 'success':
          echo "<div class='alert alert-success' style='margin-top: 100px;'>You have successfully update your profile</div>";
          break;
        
        default:
          echo "";
          break;
      }

 ?>

      <?php while ( have_posts() ) : the_post(); ?>

        <div class="container">
    <h4 style="margin-top: 40px;">Edit Profile: <?php echo esc_html($current_user->nickname); ?></h4>
    <hr>
    <div class="row">
      <!-- left column -->
      <div class="col-md-1">
        
      </div>
      
      <!-- edit form column -->
      <div class="col-md-8 personal-info col-md-offset-1">
      <?php if ( !empty($_GET['success']) ): ?>

        <div class="alert alert-info">
          
          <strong>Profile updated successfully!</strong>
        </div>
      <?php endif; ?>

        
          <!--alert box starts here-->


<div class="alert" id="mydiv">
  <br><br>
 <h4 style="color:blue;"><strong>Choose your interest fields to get regular email notifications.</strong> </h4> 
</div>
  <!--alert box ends here-->
      <div class="form-wrapper" style="border:2px solid black; border-radius:8px; padding-top: 30px; background:#e6e6e6; padding-left: 10px; padding-right: 10px;">
        <form class="form-horizontal" method="post" id="adduser" action="<?php echo site_url();?>/user/" role="form" style="backgroundr:light green; ">
            <h4 style="padding-left:25%; color:green;">Personal info:</h4>
        <div class="form-group">
          <label class="col-md-3 control-label">Username*:</label>
          <div class="col-md-6">
            <input class="form-control" type="text" value="<?php echo $current_user->{'user_login'} ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">First Name:</label>
          <div class="col-md-6">
            <input class="form-control" name="firstname_new" type="text" placeholder="Firstname" value="<?php echo $user_info['first_name'][0] ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Last name:</label>
          <div class="col-md-6">
            <input class="form-control" placeholder="Lastname" name="lastname_new" type="text" value="<?php echo $user_info['last_name'][0] ?>">
          </div>
        </div>
        <h4 style="padding-left:25%; color:green;">Contact Details:</h4>
        <div class="form-group">
          <label class="col-md-3 control-label">Email*:</label>
          <div class="col-md-6">
            <input class="form-control" name="email_new" type="text" value="<?php echo $current_user->{'user_email'} ?>" required>
          </div>
        </div>
        
       <!--  <div class="form-group">
          <label class="col-md-3 control-label">Website:</label>
          <div class="col-md-6">
            <input class="form-control" name="website_new" type="email" placeholder="Website" value="<?php echo $current_user->{'user_url'} ?>">
          </div>
        </div> -->
        
        <h4 style="padding-left:25%; color:green;">About Yourself:</h4>
        <div class="form-group">
          <label class="col-md-3 control-label">Description</label>
          <div class="col-md-6">
            <textarea class="form-control" name="description_new" rows="4"><?php echo $user_info['description'][0] ?></textarea>
          </div>
        </div>
     
      <h4 style="color:green; padding-left:25%">Your Interest Fields:</h4>
       <div class="form-group">
          <div class="col-md-3"></div>
          <div class="col-md-6">
          <?php
              // action hook for plugin and extra fields
              do_action('edit_user_profile', $current_user);

            ?>
            </div>
          </div>
       
        <br><br>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-6">
            <input name="updateuser" type="submit" id="updateuser" class="btn btn-primary btn-block" value="Update Profile">
            <span></span>
            <input name="action" type="hidden" id="action" value="update-user">
          </div>
        </div>
      </form>
      </div>
        
      </div>
    </div>
  </div>

<hr>
      <?php endwhile; ?>        
      
    </div>
  </div>

  </div>
</div>
  
<script>
   var fade_out = function() {
  $("#mydiv").fadeOut().empty();
}

setTimeout(fade_out, 5000); 
</script>


<?php get_footer(); ?>