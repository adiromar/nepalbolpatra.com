<?php
/**
 * Template Name: Add Product
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
<div class="container product-form" style="margin-top: 100px;">
  <div class="row">

<?php 

if(isset($_POST['submit']))
{
  global $wpdb;

  $product = $_POST['product'];
  $table = "wp_addproduct";
  $wpdb->insert($table,array('product_name'=>$product),array('%s'));
  echo '<div class="alert alert-success"><h4>Product added successfully.</h4></div>';
}?>
    <div class="col-md-4 col-sm-6">
      <h4>Current Product/Services:</h4>

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
 
  $myrows = $wpdb->get_results( "SELECT product_name FROM wp_addproduct" );
  
  $res = wp_list_pluck($myrows, 'product_name');
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
    <div class="col-md-8 col-sm-6">

      <form class="form-horizontal" action="" enctype="multipart/form-data" method="post" style="" id="forminsert">
       <h4 align="center" style="color:#0c1401; margin-left: -40px;" > Add Product/Service </h4>
          <hr>

        <div class="form-group" >
          <label>New Product/Service</label>
          <input name="product" type="text" value="" class="form-control" style="background:white; color:black; width:70%" required />
        </div>
        <div class="form-group">
         
          <input name="submit" type="submit" value="Add Product" class="form-control" style="margin-left:2px; width:50%; background:lightgray;"/>
        </div>
      </form>
</div>
</div>
</div>

<br><br><br><br><br><br><br><br><br>
<div class="footer">
    <?php
    get_footer();
    ?>
</div>