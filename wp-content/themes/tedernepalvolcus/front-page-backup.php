


<div class="modal bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        <h5 class="modal-title" id="ModalLongTitle"></h5>
      </div>
      <div class="modal-body">
          
        <img src="" class="tender_image_preview" style="width: 100%;" > 
       
        
      </div>
      <div class="modal-footer">
        <a id="OpenInNew" href="" target="_blank"><button type="button" class="btn btn-primary">Open in New Tab</button></a>
        
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<?php
/**
 * The front page template file

 */

get_header();
 // $uid = get_current_user_id();
 // $user = get_user_meta($uid, 'user_type');
 // $user = $user[0];
 // $userw = get_user_meta($uid);
 // $count = count($userw);
 global $wpdb;
 // if ($uid > 0) {
 // 	$result = (array) $wpdb->get_results(
 // 	'SELECT * FROM `wp_tender` ORDER BY `created_at` DESC LIMIT 10'
 // 	);
 // }else{
 // 	$result = (array) $wpdb->get_results(
 // 	'SELECT * FROM `wp_tender` ORDER BY `created_at` DESC LIMIT 5'
 // );
 // }

 if(isset($_GET['cat'])){
$filter_string = $_GET['cat'];
}
else{
    $filter_string='';
}
$filter_array = explode( ",", $filter_string );
$filter_arg = '\'' . implode( $filter_array, '\' , \'' ) . '\'';

if( $filter_string )
{
  $query = "SELECT * FROM `wp_tender` WHERE `product` IN ( ${filter_arg} )";
} else {
  $query = "SELECT * FROM `wp_tender`";
}

// define(ROOTPATH, ABSPATH);

/*
  ====================================
    PAGINATION LOGIC
  ====================================
*/
$customPagHTML  = "";
$total_query    = "SELECT COUNT(1) FROM ( ${query} ) AS combined_table";
$total          = $wpdb->get_var( $total_query );
$items_per_page = 10;
$page           = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset         = ( $page * $items_per_page ) - $items_per_page;
$result         = $wpdb->get_results( $query . " ORDER BY `created_at` DESC LIMIT ${offset}, ${items_per_page}" );
$totalPage      = ceil( $total / $items_per_page );

if($totalPage > 1)
{
  $customPagHTML     =  ' <strong>Page ' . $page . ' of ' . $totalPage . '</strong></span>' . paginate_links( array(
      'base' => add_query_arg( 'cpage', '%#%' ),
      'format' => '',
      'prev_text' => __('Previous'),
      'next_text' => __('Next'),
      'total' => $totalPage,
      'current' => $page
    ));
}
//define(ROOTPATH, ABSPATH);

?>

<!--
  /*
		=======================================
    Start of Page Content
  	=======================================
	*/
-->
<?php if(!is_user_logged_in()){ ?>

<header class="jumbotron">
	<div class="container ">
		<div class="row">
			<div class="col-md-12 main_content ">
			    <?php  
			    if (isset($_GET['register'])){
			    $register = $_GET['register'];  
			    if($register == true) { 
                        echo '<div class="alert alert-success">Check your email and set the password!</div>'; 
                        } }?>
      
      			
      
     
      
				<h2 style="color:#ff4223;">You Are at Right Path</h2>
			<p class="first_para">We provide an affordable, flexible and successful </p>
			<p class="second_para">solution to outsource bid support</p>
			<?php if ( ! is_user_logged_in() ): ?>
				<a data-toggle="modal" data-target="#myModal" onclick="show_register();return false;" class="btn btn-info btn-lg">JOIN US</a>
			<?php endif; ?>
			<div class="imag" style="margin-top: 20px; margin-left: 28px;">
				<img src="http://icx1-map21x.lan.511nj.org/mapwidget/images/d-arrow.png" style="height: 70px; width: 70px; cursor: pointer; border: 1px solid brown; min-width: 85px; border-radius: 10%;" class="scroll" target="content">
			</div>
			 <!-- <p>JOIN US</p>  -->
			</div>
		</div>
	</div>
</header>
<!-- //Jumbotron  -->
<?php } ?>
<div id="content" style="margin-top: 20px;"></div>
<div class="table_content" style="margin-top: -29px;">
<div class="container ">
	<div class="clearfix"></div>
	<?php if(is_user_logged_in()){ ?>
	<?php if($count < 18){ ?>
	<div class="alert alert-default alert-dismissible" role="alert" id="alert" style="margin-top: 60px; background-color: #6cbada; margin-top: 80px;">
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><p class="btn btn-xs btn-warning" style="background-color: black;">Close</p></button>
  		<strong>Notice!</strong> Please choose your preferred <strong>CATEGORY</strong> in your profile to get regular email notifications related to your interest.<br><br>
  		<div class="clearfix"></div>
  		<a href="<?php echo home_url( '/user' ) ?>#interests" style="align-items: right;"><button class="btn btn-warning">Go to Profile</button></a>
	</div>
	<?php } }  ?>
		<h3 style="margin-top:100px">Latest Tenders / Notice</h3>
		<hr style="width: 22%;border-top: 3px solid #ec4707">

	<h5>Filter By Category:</h5>
    <div class="col-md-2 col-sm-1"></div>
    <ul class="col-md-10 col-sm-3" style="font-size:12px; list-style:none;">
      <div class="form-check form-check-inline">
        <?php 
        $res = $wpdb->get_results("SELECT * FROM wp_addproduct",ARRAY_A);
        
        foreach($res as $data)
        {
        ?>
        
    <label class="form-check-label">
      <input type="checkbox" name="category" value="<?php echo $data['product_name'];?>" <?php  if( in_array( $data['product_name'], $filter_array ) ) { echo "checked"; } ?> >
      &nbsp;<?php echo $data['product_name'];?>&nbsp;
    </label>
      <?php
      }
      ?>
    </div>
   </ul>
   		<a id="filter" href="#">
  <button class="btn btn-outline-primary btn-sm" style="">Filter Result</button></a>


 


	<div class="row">
	<div class='tender_table col-md-12'>

		<table class="table table-striped table-hover table-bordered table-condensed table-responsive">
		  <thead >
		    <th >S.N</th>
		    <th style="width:175px;">Notice Publisher</th>
		    <th>Description</th>
		    <th style="width:99px">Published Date</th>
		    <th style="width:99px">Last date</th>
		    <th style="width:85px;">Category</th>
		    <th style="width:124px">Industry</th>
		    <th style="width:">Product/Service</th>
		    <th>Newspaper</th>
		    <th style="width:72px">Days Remaining</th>
		    <th style="width:90px">Notice Image</th>
		  </thead>
		<tbody class="table_body">

			<?php
				if (count($result)) {
					$i = 1;
					foreach ($result as $value_obj) {
						$entry = (array) $value_obj;
				?>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $entry['publisher'] ?></td>
							<td><?php echo $entry['description'] ?></td>
							<td><?php echo $entry['published_date'] ?></td>
							<td><?php echo $entry['submission_date'] ?></td>
							<td>
								<?php
									echo ucfirst($entry['notice']);
								?>
							</td>
							<td>
								<?php
								echo ucfirst($entry['industry']);
								
								?>
							</td>
							<td>
								<?php
								echo $entry['product']
								
								?>
							</td>
							<td><?php echo $entry['newspaper'] ?></td>
							<td>
								<?php
								
					if ($entry['submission_date_eng'] == null){
                  				echo "-";
                  		}else{
								$today = new DateTime(date("Y-m-j"));
                  				$sd = DateTime::createFromFormat( "Y-m-j", $entry['submission_date_eng'] )->settime(0,0);
                  				$diff = $today->diff($sd)->format("%R%a");
									if( $diff >= 0)
									{
										switch ( substr( $diff, 1 ) ) {
											case 0:
												echo 'Ending Today';
												break;

											case 1:
												echo substr( $diff, 1 ) . ' day';
												break;

											default:
												// echo $convert;
												echo substr( $diff, 1 ) . ' days';
												break;
											}
									} else {
										echo "<p style='color:red'>Expired</p>";
									}
								}
								?>
							</td>
							<td>
								<?php if ($entry['image']) { ?>

								 <a href="#" class="pop">

									<!-- <a href="<?php echo wp_upload_dir()['baseurl'] . '/' . $entry['image'] ?>"> -->
										<img src="<?php echo wp_upload_dir()['baseurl'] . '/' . $entry['image'] ?>"
											alt="<?php echo $entry['notice'] . ' image' ?>"
											style="max-height: 100px; max-width: 50px;">
									</a>
								<?php } else { ?>
									&nbsp;n/a
								<?php } ?>
							</td>
						</tr>
				<?php }
			} else {
				echo "</table>";
				echo "There are no Tenders at the Moment.";
			}
			?>

			
		</tbody>

		
		</table>
		<?php if(is_super_admin() || $user == 'paid') : ?>
		<a href="<?php echo home_url( '/show-table' ) ?>" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a>
		<?php else: ?>
		<!-- <a href="<?php echo home_url( '/pricing/?action=login' ) ?>" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a> -->
		<a href="#" id="more_tender" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey;">More Tenders</a>

		<?php endif; ?>
		<?php if(is_user_logged_in()){
		   echo "<strong>Note:</strong> <p> Go to your profile and update your interest fields to get the regular email notifications related to your interest.</p>" ;
		}
		
		?>
	</div>
	</div>

	 </div>
</div><!-- endof container-->

</div>
</div>
<!-- //.Tender Table -->

<div id="tendor-sector">
	<div class="container">
		<div class="row">
			<header>
				<h3>Tender Categories</h3>
			</header><!-- /header -->
			<hr style="width: 20%; border-top: 3px solid #ec4707">
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
	        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/building.jpg" class="img img-responsive" />
	        	        	<div class="cat_name">
								Construction/Building
							</div>

					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/agriculture.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Agriculture
						</div>

					</div>
        		</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/edu.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Education
						</div>

					</div>

        		</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
				<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/medical.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
						Medical
						</div>

						</div>
			</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/techh.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Technology & Softwares
						</div>

					</div>
        		</div>
			</div>
			<div class="col-md-2">
				<div class="[ c-example__tilt ] js-tilt" data-tilt-glare="false" data-tilt-perspective="1000" data-tilt-scale="1" data-tilt-speed="400" data-tilt-max="10">
					<div class="c-example__tilt-inner">
        	        	<img src="<?php bloginfo('template_url') ?>/assets/images/bridges.jpg" class="img img-responsive" />
        	        	<div class="cat_name">
							Bridges & Tunnels
						</div>
  					</div>
        		</div>
			</div>
		</div>
	</div>
</div>
<!-- //.tender sector -->

<!--
  /*=======================================
    Start of Page Content
  */=======================================
 -->

<!-- /*Picture in Modal View*/ -->
<script>

	$("input[type=checkbox][name=category]").on("change", function() {
    var arr = [];
    $(":checkbox").each(function() {
      if ($(this).is(":checked")) {
        arr.push($(this).val());
      }
    });
    var vals = arr.join(",");
    var str = "<?php echo site_url(); ?>/?cat=" + vals;
    console.log(str);

    if (vals.length > 0) {
      $("#filter").attr("href", str);
    } else {
      $("#filter").attr("href", "<?php echo site_url(); ?>");
    }
  });

  $(function() {
		$('.pop').on('click', function() {
			$('.tender_image_preview').attr('src', $(this).find('img').attr('src'));

      $('.modal-title').text($(this).find('img').attr('alt'));

      $('#OpenInNew').attr('href', $(this).find('img').attr('src'));

			$('#imagemodal').modal('show');
		});
  });


  $('.scroll').click(function() {
    $('body').animate({
        scrollTop: eval($('#' + $(this).attr('target')).offset().top - 70)
    }, 1000);
});
</script>

<?php get_footer();
