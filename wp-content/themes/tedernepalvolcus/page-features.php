<?php
 get_header();
?>
<style type="text/css">
	.service_content h4:hover, p:hover{
		color: orange;
		cursor: pointer;
	}
	.service_content{
		height: 250;
	}
</style>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
		<div class="login tab_content_login" id="tab1_login" style="display: block">
			<form id="accesspanel" action="login" method="post">
				<h1 id="litheader" ><a href="" >LOG IN</a></h1>
				<div class="inset">
				  <p>
				    <input type="text" name="username" id="email" placeholder="Email address">
				  </p>
				  <p>
				    <input type="password" name="password" id="password" placeholder="Access code">
				  </p>
				  <div style="margin-top: -10px; text-align: center; margin-bottom: 5px;">
				    <div class="checkboxouter">
				      <input type="checkbox" name="rememberme" id="remember" value="Remember">
				      <label class="checkbox"></label>
				    </div>
				    <label for="remember">Remember me</label>
				  </div>
				  <input class="loginLoginValue" type="hidden" name="service" value="login" />
				</div>
				<p class="p-container">
				  <input type="submit" name="Login" id="go" value="Authorize">
				</p>
			  <p class="f_login" style="color:#FFbb00; text-align:center; font-size:12px;">
					<a href="#" onclick="show_register();return false;">Register</a>
					<span style="color:white; padding:0 5px 0 5px;" >|</span>
					<a href="#" onclick="show_forgot();return false;"> Lost your password ?</a>
				</p>
			</form>
		</div>
		<div class="register tab_content_login" id='tab2_login' style="display: none">
		  <form id="accesspanel" action="register" method="post" >
			  <h1 id="litheader">REGISTER</h1>
			  <div class="inset">
			    <p>
			      <input type="text" name="username" id="email" placeholder="Username">
			    </p>
			    <p>
			    	<input type="text" name="username" id="email" placeholder="Email address">
			    </p>
			    <input class="loginLoginValue" type="hidden" name="service" value="register" />
			  </div>
				<p class="p-container">
					<input type="submit" name="Login" id="go" value="Register">
				</p>
		    <p class="f_login" style="color:#FFbb00; text-align:center; font-size:12px;">
					<a href="#" onclick="show_login();return false;">Log In</a>
					<span style="color:white; padding:0 5px 0 5px;" >|</span>
					<a href="#" onclick="show_forgot();return false;"> Lost your password ?</a>
		  	</p>
			</form>
		</div>
		<div class="forgot_password tab_content_login" id="tab3_login" style="display: none; ">
		  <form id="accesspanel" action="forgot_password" method="post" >
			  <h1 id="litheader" >Forgot Password</h1>
			  <div class="inset">
			    <p>
			      <input type="text" name="forgot_password" id="forgot_password" placeholder="Username or Email Address">
			    </p>
				  <p class="p-container">
				    <input type="submit" name="Login" id="go" value="Get New password">
					</p>
			    <p class="f_login" style="color:#FFbb00; text-align:center; font-size:12px;">
						<a href="#" onclick="show_login();return false;">Log In</a>
						<span style="color:white; padding:0 5px 0 5px;" >|</span>
						<a href="#" onclick="show_register();return false;"> Register</a>
				  </p>
				</div>
			</form>
		</div>
	</div>
</div>
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
<script type="text/javascript">
	function show_login()
	{
		document.getElementById('tab1_login').style.display = "block";
		document.getElementById('tab2_login').style.display = "none";
		document.getElementById('tab3_login').style.display = "none";
	}

	function show_register()
	{
		document.getElementById('tab1_login').style.display = "none";
		document.getElementById('tab2_login').style.display = "block";
		document.getElementById('tab3_login').style.display = "none";
	}

	function show_forgot()
	{
		document.getElementById('tab1_login').style.display = "none";
		document.getElementById('tab2_login').style.display = "none";
		document.getElementById('tab3_login').style.display = "block";
	}
</script>

<!-- //.login/register section -->




<div class='hero'>
<div class='container-fluid' style="background-color: #18304aed; margin-top: 50px; height: 100px; margin-bottom: 26px;">
<h1 align="center" style="color: #76e276; font-size: 48px; font-weight: 700; text-shadow: 2px 2px black; margin-top: 10px; text-align: center;">TENDER SERVICES</h1>
<h6 style="color: white; text-align: center;">Saving your bid team time and supporting  your business development</h6>
</div>
	

	<div  class="container service_data" style="height: auto;">
	<div class="row">
	<!-- <div class="service_header">
	<h1> Saving your bid team time and supporting  your business development</h1>
	</div> -->
		<?php 
			global $wpdb;
			$table = 'wp_tender';
			$query = "SELECT *  FROM $table WHERE featured='yes' LIMIT 0,6";
			$result = $wpdb->get_results($query);
			if ( count( $result ) ) {
            $i = 1;
            foreach ( $result as $value_obj ) {
           	   $entry = (array) $value_obj;
          		
			?>
			<div class='col-md-6 service_content'>
				
				<a class="pop" href="#"><img src="<?php echo wp_upload_dir()['baseurl'] . '/' . $entry['image'] ?>"
                        alt="<?php echo $entry['publisher'] ?>"
                        style="min-height: 160px; max-width: 165px; cursor: pointer; border: 1px solid grey; padding: 2px;"></a>
				<h4 style="color: #76e276"><?php echo $entry['description']; ?></h4>
				<p style="font-size: 14px; text-align: center;"><span style="color: orange; font-size: 15px;">PUBLISHER: </span><?php echo $entry['publisher'] ?></p>

			</div>
			<?php } } ?>
						
		</div><!-- end of ROW -->
	</div>
 </div>
<script>
  $(function() {
		$('.pop').on('click', function() {
			$('.tender_image_preview').attr('src', $(this).find('img').attr('src'));

      $('.modal-title').text($(this).find('img').attr('alt'));

      $('#OpenInNew').attr('href', $(this).find('img').attr('src'));

			$('#imagemodal').modal('show');
		});
  });
</script>
<?php get_footer();?>