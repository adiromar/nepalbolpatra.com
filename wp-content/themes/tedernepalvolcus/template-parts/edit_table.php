<?php
/**
 * Template Name: EDIT TABLE
 *
 */

get_header();

global $wpdb;

if ($_GET['tender_id']) {
	$id = $_GET['tender_id'];
} else {
	$obj = $wpdb->get_results( "SELECT MAX(id) FROM wp_tender" );
	$id_obj = (array)$obj['0'];
	$id = $id_obj['MAX(id)'];
}
$result = $wpdb->get_results( "SELECT * FROM wp_tender WHERE id = {$id}" );
$result = (array) $result['0'];
?>
<!-- <br><br>
<html>
<head>
	<title>Entry form</title>
	<meta charset="utf-8">

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</head>

	<body>
		<br><br> -->
	<div class="container-edit-form" style="margin-top: 50px;">
		<div class="row">
			<div class="col-sm-9 col-md-3">

				<form class="form-horizontal" action="" enctype="multipart/form-data" method="post" style="margin-top: 10px; margin-bottom: 25px; margin-left:100%; width:600px; height: 1060px; padding-left: 90px; padding-right:10px; background-color:#68778e; color:black">
					<h2 align="center"style="color:#0c1401;" > Edit Tender </h2>
					<hr>

					<div class="form-group" style="width:85%;">
						<label>Notice Publisher</label>
						<input style="background:white; color:black; width:100%" name="publisher" type="text" class="form-control" value="<?php echo $result['publisher'] ?>" />
					</div>

					<div class="form-group" style="width:85%;">
						<label>Description</label>
						<textarea name="description" class="form-control"><?php echo $result[ 'description'] ?></textarea>
					</div>

					<div class="form-group" style="width:85%;">
						<label>Published Date</label>
						<input style="background:white; color:black;" id="datepicker1" name="published_date" type="text" value="<?php echo $result['published_date'] ?>" class="form-control nepali-calendar" />
					</div>

					<div class="form-group" style="width:85%;">
						<label>Last Date of Submission</label>
						<input style="background:white; color:black;" id="nepaliDate" name="submission_date" type="text" value="<?php echo $result['submission_date'] ?>" class="form-control nepali-calendar" autocomplete="off" />
						<input type="text" id="englishDate" name="submission_date_eng" value="<?= $result['submission_date_eng'] ?>">
					</div>

					<div class="form-group" style="width:85%;">
						<label>Notice Category (saved:
						<?php echo ucfirst($result[ 'notice']) ?>)</label>
						<select name="notice" class="form-control">
							<!--<option value="tender">Tender</option>-->
							<!--<option value="auction">Auction</option>-->
							<optgroup label="Saved as: <?php echo ucfirst($result['notice']) ?>">
							    <?php
							    global $wpdb;
							    $res = $wpdb->get_results("SELECT * FROM wp_addnotice",ARRAY_A);
							    foreach($res as $data)
							    {?>
							    <option value="<?php echo $data['notice_name'];?>"><?php echo $data['notice_name'];?></option>
							    <?php
							    }
							    ?>
							</optgroup>
						</select>
					</div>

					<div class="form-group" style="width:85%;">
						<label>Industry (saved:
						<?php echo ucfirst($result[ 'industry']) ?>)</label>
						<select name="industry" class="form-control">
							<!--<option value="govt">Government/ Ministries/ Departments</option>-->
							<!--<option value="bank">Banking/ Finance /Insurance</option>-->
							<!--<option value="hydro">Hydro Power/ Energy</option>-->
							<optgroup label="Saved as: <?php echo ucfirst($result['industry']) ?>">
							    <?php
							    global $wpdb;
							    $res = $wpdb->get_results("SELECT * FROM wp_addindustry",ARRAY_A);
							    foreach($res as $data)
							    {?>
							    <option value="<?php echo $data['industry_name'];?>"><?php echo $data['industry_name'];?></option>
							    <?php
							    }
							    ?>
							</optgroup>
						</select>
					</div>

					<div class="form-group" style="width:85%;">
						<label>Product/ Service (saved:
						<?php echo ucfirst($result[ 'product']) ?>)</label>
						<select name="product" class="form-control">
							<optgroup label="Saved as: <?php echo ucfirst($result['product']) ?>">
							    <?php
							    global $wpdb;
							    $res = $wpdb->get_results("SELECT * FROM wp_addproduct",ARRAY_A);
							    foreach($res as $data)
							    {?>
							    <option value="<?php echo $data['product_name'];?>"><?php echo $data['product_name'];?></option>
							    <?php
							    }
							    ?>
							</optgroup>
						</select>
					</div>

					
					<div class="form-group" style="width:85%;">
						<!-- <label>Newspaper</label>
						<input style="background:white; color:black;" name="newspaper" type="text" class="form-control" value="<?php echo $result['newspaper'] ?>" /> -->
							<label>Newspaper (saved:
						<?php echo ucfirst($result[ 'newspaper']) ?>)</label>
						<select name="newspaper" class="form-control">
							<optgroup label="Saved as: <?php echo ucfirst($result['newspaper']) ?>">
								<?php
								global $wpdb;
								 $res = $wpdb->get_results("SELECT * FROM wp_addnewspaper",ARRAY_A);
     							 foreach($res as $data)
             						 { ?>
								<option value="<?php echo $data['newspaper_name'];?>"><?php echo $data['newspaper_name'];?></option>
								<?php }?>
							</optgroup>
						</select>
					</div>

					<div class="form-group" style="width:85%;">
						<label>Notice Image</label>
						<input style="background:white; color:black;" name="image" type="file" class="form-control" />
						<?php if($result['image']){?>
						<img src="<?php echo '../wp-content/uploads/'.$result['image']; ?>" width="60">
						<input type="hidden" name="image" value="<?php echo $result['image'] ;?>">
						<?php }
						
						
						 ?>
					</div>

					<div class="form-group" style="width:85%;">
						<button name="tender_edit_submit" type="submit" value="EDIT" style="color:white; background:blue;" >Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<!-- </body> -->
<!-- </html> -->
<!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->


<script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/nepali/js/jquery.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/nepali/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/nepali/nepali.datepicker.v2.2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/nepali/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/nepali/nepali.datepicker.v2.2.min.css" />
  <script>

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
<div class="footer" style="margin-top: 200px;">
	<?php // get_footer();?>
</div>
