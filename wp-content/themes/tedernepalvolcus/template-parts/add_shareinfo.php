<?php
/**
 * Template Name: Add Share Form
 *
 */

if( ! is_super_admin() )
{
 auth_redirect();
}

get_header('user');

?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Entry form</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Google Fonts -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<br><br><br>
<div class="container tender-form">
  <div class="row">
    <div class="col-sm-10 col-md-10 col-md-offset-1" >
    <?php 
      if (isset($_POST['share_submit'])) {
        
        $orgid = $_POST['org']; 
        $notice = $_POST['description']; 
         
        $published_date = $_POST['published_date']; 
        $voucher = $_FILES['voucher']['name']; 

        global $wpdb;
        if ( $_FILES['voucher']['size'] ) {

          $img_type = strrpos($_FILES['voucher']['type'], '/');
          
          $n = rand(0,10000);
          $filename = $n.$voucher;
          //file location specification to upload
          $file_local = 'wp-content/uploads/reports/' . $filename;
          $file_path = ABSPATH . $file_local;
          $file_name = $filename;
          $imgupload = move_uploaded_file($_FILES['voucher']['tmp_name'], $file_local);

      }
        $sql = "SELECT * FROM `wp_org` WHERE orgid='$orgid'";

          $org = $wpdb->get_results($sql,ARRAY_A);
          // print_r($org);
          $org = $org[0];
          $org = $org['orgname'];

        $insert = $wpdb->insert('wp_sharereport', 
                                    array(
                                          'organization' => $org,
                                          'notice' => $notice,
                                          'org_id' => $orgid,
                                          'published_date' => $published_date,
                                          'file' => $filename
                                                ) 
                                  );
        
       if(!is_wp_error($insert)){
        echo "<div class='alert alert-success' style='margin-top: 25px;'>SUCCESFULLY UPDATED</div>";
        /************************************************************************
        *************************START OF EMAIL NOTIFICATION*********************/
        //$org
        $subscriptions = (array) $wpdb->get_results("SELECT * FROM wp_subscription");
        if(count($subscriptions)){
            foreach ($subscriptions as $sub) {
              $entry = (array) $sub;

              $email = $entry['email'];
              $subs = $entry['subscriptions'];
              $subs = explode(',', $subs);

              if (in_array($org, $subs)){
                $to = $email;
                $subject = "Share Info Subscription Alert";
                $text = "     

                Dear User,
                
                This is to notify that a New notice has been published of ".$org.". Please click/open the link http://encoderslab.com/tendernepalvolcus/sharebazaar/  
                        
                Thanks for Subscribing,
                Elagani Team
                " ;
                $header = "From: nickarsenal007@gmail.com"."\r\n";

                mail($to, $subject, $text, $headers);
            }
          }
        }
        /************************************************************************
        *************************END OF EMAIL NOTIFICATION*********************/
       }



      }

      if (isset($_POST['orgsubmit'])) {
        $ins = $wpdb->insert('wp_org', array(
                                          'orgname' => $_POST['orgnm'],
                                          'symbol' => $_POST['symbol'],
                                            ));

        if(!is_wp_error($ins)){
        echo "<div class='alert alert-success' style='margin-top: 40px;'>SUCCESFULLY ADDED</div>";
       }
      }


    ?>
      <form class="form-horizontal" action="" method="post" style="margin-top:80px; margin-bottom: 10px; height: auto; padding-left: 90px; padding-right:10px; background-color:lightgrey; color:black">
        <h2 align="center" style="color:#0c1401; padding-top: 15px; padding-right: 30px;"> Add Organization</h2>
        <div class="form-group" style="width:85%">
          <div class="row">
            <div class="col-md-3">
              <label class="control-label">Organization Name:</label>
            </div>
            <div class="col-md-9">
              <input class="form-control" type="text" name="orgnm" required>
            </div>
            
          </div>
          <div class="row" style="margin-top: 15px;">
            <div class="col-md-3">
              <label class="control-label">SYMBOL:</label>
            </div>
            <div class="col-md-5">
              <input type="text" name="symbol" class="form-control" required>
            </div>
            <div class="col-md-4">
              <input type="submit" name="orgsubmit" class="btn btn-info btn-block" value="Add" style="margin-bottom: 30px;">
            </div>
          </div>
        </div>
      </form>



      <form class="form-horizontal" action="" enctype="multipart/form-data" method="post" style="margin-top:20px; margin-bottom: 10px; height: auto; padding-left: 90px; padding-right:10px; background-color:lightgrey; color:black">
        <h2 align="center" style="color:#0c1401; padding-top: 45px; padding-right: 30px;"> Share Info Entry Form</h2>
        <hr>

        <div class="form-group" style="width:85%">
          <div class="row">
            <div class="col-md-6">
              <label>Organization Name:</label>
              <select class="form-control" name="org" required>
                <?php 
                $res = $wpdb->get_results('SELECT * FROM wp_org',ARRAY_A);
                foreach ($res as $data) { ?>
                  <option value="<?= $data['orgid'] ?>"><?= $data['orgname'] ?></option>
              <?php  }
              ?>
              </select>
              
              <!-- <input name="org" type="text" value="" class="form-control" style="width:100%; background:white; color:black;" required /> -->
            </div>
            <div class="col-md-6">
              <label>Published Date:</label>
            <input name="published_date" type="date" class="form-control" required />
              
            </div>
          </div>  
          
          
        </div>


        <div class="form-group" style="width:85%">
          <div class="row">
            <div class="col-md-12">
              <label>Notice:</label>
              <textarea name="description" type="text" class="form-control" rows="4" required>
                
              </textarea>
             
              <!-- <label>Doc Type:</label>
              <select name="doc" type="text" class="form-control" required />
                <option value="First Quarter">First Quarter</option>
                <option value="Second Quarter">Second Quarter</option>
                <option value="Third Quarter">Third Quarter</option>
                <option value="Fourth Quarter">Fourth Quarter</option>
              </select> -->
            </div>
            
          </div>
        </div>

        <div class="form-group" style="width:85%">
        <div class="row">
          <div class="col-md-6">
            <input type="file" name="voucher" style="background-color: lightseagreen; width: 300px; padding: 3px; border: 1px solid black; margin-top: 20px;">
          </div>

          <div class="col-md-6">
             <input class="btn btn-primary form-control pull-right" style="color:white; width: 300px; margin-top: 20px;" name="share_submit" type="submit" value="Upload">
          </div>
        </div>
          
        </div>

        
    <hr>
        
    </form>
</div>
</div>
</div>
<br><br><br><br>




</body>
</html>

<?php get_footer();
