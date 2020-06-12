<?php
/**
 * Template Name: Add Tender Form
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
  <title>Entry form</title>
  <meta charset="utf-8">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>
<br><br>
<div class="container">
<div class="row">
  <div class="col-md-2"></div>
<div class="col-md-8 col-sm-4">
<form class="form-horizontal" action="" enctype="multipart/form-data" method="post" style="padding: 20px 20px 5px 5px; border-style: solid; border-width: medium; background-color: #b8dcd0; margin-top: 100px;">
<fieldset>
<h3 align="center">Tender Entry Form:</h3>
<hr>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="publisher">Notice Publisher:</label>  
  <div class="col-md-8 col-sm-4">
  <input id="textinput" name="publisher" type="text" placeholder="Enter your personal/company name:" class="form-control input-md" required>
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="description">Description:</label>
  <div class="col-md-8 col-sm-4">                     
    <textarea name="description" class="form-control" id="textarea" name="textarea" rows="10" required></textarea>
  </div>
</div>

<!-- Appended Input-->
<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="published_date">Published Date:</label>
  <div class="col-md-8 col-sm-4">
    <div class="input-group">
      <input id="datepicker1" name="published_date" class="form-control nepali-calendar" type="text" placeholder="Published Date" autocomplete="off" required>
    </div>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="submission_date">Last Date of Submission:</label>
  <div class="col-md-8 col-sm-4">
    <div class="input-group">
      <input id="nepaliDate" name="submission_date" class="form-control nepali-calendar" placeholder="Nepali Date" type="text" autocomplete="off" required>
      <input type="text" name="submission_date_eng" id="englishDate" class="form-control" placeholder="English Date" readonly>
    </div>
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Notice Category:</label>
  <div class="col-md-4">
    <select id="selectbasic" name="notice" class="form-control" required>
      
      <?php global $wpdb;
             $table="wp_addnotice";
             $res = $wpdb->get_results("SELECT*FROM wp_addnotice",ARRAY_A);
             foreach($res as $data)
             {
                 ?>
             <option value="<?php echo $data['notice_name'] ;?>"><?php echo $data['notice_name'] ;?></option>
             <?php
             } 
             ?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="industry">Industry:</label>
  <div class="col-md-8 col-sm-4">
    <select id="selectbasic" name="industry" class="form-control" required>
      
      <?php global $wpdb;
             $table="wp_addindustry";
             $res = $wpdb->get_results("SELECT*FROM wp_addindustry",ARRAY_A);
             foreach($res as $data)
             {
                 ?>
             <option value="<?php echo $data['industry_name'] ;?>"><?php echo $data['industry_name'] ;?></option>
             <?php
             } 
             ?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="product">Product/Service:</label>
  <div class="col-md-8 col-sm-4">
    <select id="selectbasic" name="product" class="form-control" required>
      
      <?php global $wpdb;
             $table="wp_addproduct";
             $res = $wpdb->get_results("SELECT*FROM wp_addproduct",ARRAY_A);
             foreach($res as $data)
             {
                 ?>
             <option value="<?php echo $data['product_name'] ;?>"><?php echo $data['product_name'] ;?></option>
             <?php
             } 
             ?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="newspaper">Newspaper:</label>
  <div class="col-md-8 col-sm-4">
    <select id="selectbasic" name="newspaper" class="form-control" required>
      <?php global $wpdb;
              $table="wp_addnewspaper";
              $res = $wpdb->get_results("SELECT * FROM wp_addnewspaper",ARRAY_A);
              foreach($res as $data)
              {
                  ?>
                  <option value ="<?php echo $data['newspaper_name'] ;?>"><?php echo $data['newspaper_name'] ;?></option>
                  <?php
              }
              ?>
    </select>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 col-sm-2 control-label" for="image">Notice Image:</label>
  <div class="col-md-8 col-sm-4">
    <input id="filebutton" name="image" class="input-file" type="file">
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button id="submit" type="submit" name="tender_submit" class="btn btn-warning btn-block">Submit</button>
  </div>
</div>

</fieldset>
</form>
</div>
</div>
</div>


<script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/nepali/js/jquery.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/nepali/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/nepali/nepali.datepicker.v2.2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/nepali/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/nepali/nepali.datepicker.v2.2.min.css" />

<script>
  // $( function() {
  //   $( "#datepicker1" ).datepicker({
  //     dateFormat: 'yy-mm-dd',
  //     changeMonth: true,
  //     changeYear: true
  //   });
  //   $( "#datepicker2" ).datepicker({
  //     dateFormat: 'yy-mm-dd',
  //     changeMonth: true,
  //     changeYear: true
  //   });
  // } );
  $(document).ready(function(){
$('#nepaliDate').nepaliDatePicker({
      ndpEnglishInput: 'englishDate'
    });
$('#datepicker1').nepaliDatePicker({
      npdMonth: true,
      npdYear: true,
    });

  $('#nepaliDate').nepaliDatePicker({
    ndpEnglishInput: 'englishDate'
});

  $('#englishDate').change(function(){
      $('#nepaliDate').val(AD2BS($('#englishDate').val()));
    });

 });
  </script>
</body>
</html>


<?php get_footer();
