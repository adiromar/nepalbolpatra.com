<?php
/**
 * Template Name: Industry
 *
 */
?>
<style type="text/css">
  #forminsert{
    margin-bottom: 10px; 
    width:50%; 
    height: 300px; 
    padding-left: 50px; 
    color: black; 
    background-color:#68778e;
  }
  @media only screen and (max-width: 500px) {
    #forminsert{
      width: 100%;
    }
}
</style>
<?php
if( ! is_super_admin() )
{
 auth_redirect();
}

get_header();

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
<div class="container industry-form" style="margin-top: 100px;">
  <div class="row">
  <?php 
global $wpdb;
if(isset($_POST['submit']))
{
  

  $industry = $_POST['industry'];
   $table = "wp_addindustry";
  $wpdb->insert('wp_addindustry',array('industry_name'=>$industry),array('%s'));
  echo '<div class="alert alert-success"><h4>New Industry added successfully.</h4></div>';
}
?>
  <div class="col-md-4">
      <h4>Current Industries Added:</h4>

  <table class="table">
    <thead>
      <tr>
        <th style="width: 50px;">SN.</th>
        <th>Name</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      
        <?php 
 
  $myrows = $wpdb->get_results( "SELECT industry_name FROM wp_addindustry" );
  
  $res = wp_list_pluck($myrows, 'industry_name');
$count = 1;
  foreach ($res as $key) {
    ?>
    <tr>
      <td><?php echo $count.'.'; $count++; ?></td>
      <td><?php echo $key; ?></td>
      <td><?php  ?></td>
    </tr>
    <?php
  }
?>
        
    </tbody>
  </table>
    </div>
    <div class="col-md-8 col-sm-12" >

      <form class="form-horizontal" action="" enctype="multipart/form-data" method="post" id="forminsert">
        <h2 align="center" style="color:black;"> Add Industry </h2>
        <hr>

        <div class="form-group">
          <label>Industry Name</label>
          <input name="industry" type="text" value="" class="form-control" style="background:white; color:black; width:70%" required />
        </div>
        <div class="form-group">
         
          <input name="submit" type="submit" value="submit" class="form-control" style="margin-left:2px; width:25%; background:lightgray;"/>
        </div>
    </form>
</div>
</div>
</div>
<!--query for inserting data into db-->

<br><br><br><br><br><br><br><br><br>
<div class="footer">
    <?php
    get_footer();
    ?>
</div>