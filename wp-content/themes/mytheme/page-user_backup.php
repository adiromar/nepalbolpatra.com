<?php get_header(); 

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
    $msg = "<div class='alert alert-warning' >There was an error updating your profile. Please Try again.</div>";
} else {
  // Success!
   $msg = "<div class='alert alert-success' style=''>You have successfully updated your profile info.</div>";
}
}
$user_info = get_user_meta($current_user->ID);

// echo '<pre>';
// print_r($user_info);die;
?>

<style type="text/css">
  
</style>


<section class="hero-section-1 main-pg-section">
    <div class="containersss">
    <div class="card p-3">
      <div class="row ml-5 brd-crm">
        <div class="col-md-6 col-sm">
          <span><a href="">Home</a>/</span>
          <span>Profile/</span>
          <span>Update Profile</span>
        </div>
        <div class="col-md-6 col-sm">
          <?php
          if(isset($msg)){
            echo $msg;
          }
          ?>
        </div>
        
      </div>
    </div>
  </div>


  <div class="container">  
    <div class="row">
      <div class="content card">
        <?php 
        if ( !empty($error) ): 
         echo '<div class="alert alert-warning">'.$error.'</div>'; 
        endif; 
 
      switch ($error) {
        case 'success':
          echo "<div class='alert alert-success' >You have successfully update your profile</div>";
          break;

        default:
          echo "";
          break;
      }
 ?>
      </div>

    </div> <!-- end of row -->
</div>



<?php while ( have_posts() ) : the_post(); ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 mt-3">

        <div class="col-md-4 col-sm-12 tax-heading">
          <h4 >Edit Profile: <?php echo esc_html($current_user->nickname); ?></h4>
        </div>

        <div class="card p-3 mb-4">
          <div class="col-md-12 col-sm-12">
        
          <?php if ( !empty($_GET['success']) ): ?>

            <div class="alert alert-info">
              <strong>Profile updated successfully!</strong>
            </div>
          <?php endif; ?>

          <div class="alert" id="mydiv">
            <h4 style="color:#267cb4;"><strong>Choose your interest fields to get regular email notifications.</strong> </h4> 
          </div>
        </div>

        <div class="col-md-12 col-sm-12">
          <form class="form-horizontal" method="post" id="adduser" action="<?php echo site_url();?>/user/" role="form" style="backgroundr:light green; ">
        
            <!-- <h4 style="color:green;">Personal info:</h4> -->
              
                
                <fieldset>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 profile-hf-left">
                      <div class="row">
                        <legend><u>Personal Information</u></legend>
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

                <div class="col-md-12 col-sm-12 mt-3">
                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label><i class="fa fa-address-card"></i> First Name:</label>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <input class="form-control" name="firstname_new" type="text" placeholder="Firstname" value="<?php echo $user_info['first_name'][0] ?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 mt-3">
                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label><i class="fa fa-address-card"></i> Last Name:</label>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <input class="form-control" placeholder="Lastname" name="lastname_new" type="text" value="<?php echo $user_info['last_name'][0] ?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 mt-3">
                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label><i class="fa fa-envelope"></i> Email*:</label>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <input class="form-control" name="email_new" type="text" value="<?php echo $current_user->{'user_email'} ?>" required>
                    </div>
                  </div>
                </div>

                      </div>
                    </div>

                    <div class="col-md-6 col-sm-12 profile-hf-right">
                      <div class="row pl-2">
                        <legend><u>About Yourself</u></legend>

                          <div class="col-md-12 col-sm-12 mt-3">
                            <div class="row">
                              <div class="col-md-12 col-sm-12">
                                <label><i class="fa fa-book"></i> Description</label>
                                <textarea class="form-control" name="description_new" rows="6"><?php echo $user_info['description'][0] ?></textarea>
                              </div>
                            </div>
                          </div>

                      </div>
                    </div>
                  </div>
                  
              </fieldset>

                <div class="row mt-3">                

                <legend><u>Your Interest Fields:</u></legend>
                <div class="col-md-12 col-sm-12 mt-3">
                  <div class="row">
                    
                    <div class="col-md-12 col-sm-12">
                      <?php
                      // action hook for plugin and extra fields

                      do_action('edit_user_profile', $current_user);

                      ?>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 mt-3">
                  <div class="row">

                    <div class="col-md-6 col-sm-12">
                      <input name="updateuser" type="submit" id="updateuser" class="btn btn-primary btn-block col-md-4 col-sm-12" value="Update Profile">
                      <input name="action" type="hidden" id="action" value="update-user">

                    </div>
                  </div>
                </div>

              </div>
          </form>
        </div>

      </div>

      </div>


    </div> <!-- end of row -->


    
  </div>

<?php endwhile; ?>

  </div>
</section>


<?php
// $post_id = 144;

// $papers = wp_get_post_terms( $post_id, 'newspapers'); 
//   $papc = count($papers);
//   $ppnames = array();
//   for ($i=0; $i < $papc; $i++) { 
//     $papname = $papers[$i]->slug;
//     $ppnames[] = $papname;
//   }
//   $paper_names = implode(', ', $ppnames);

//   $paper_names = explode(', ', $paper_names);

// foreach ($paper_names as $paper) {
//   echo $paper;echo $post_id;
//   add_to_schedule_email( $paper, $post_id );
// }

?>


<script>
   var fade_out = function() {
  $(".alert").fadeOut().empty();
}

setTimeout(fade_out, 5000); 
</script>

<?php get_footer('other'); ?>