

	<!-- Footer Section -->
	<footer class="footer-section">
		<div class="container">
			<a href="index.html" class="footer-logo">
				<img src="<?php bloginfo('template_url') ?>/img/Logo1.png" alt="">
			</a>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h2>What we do</h2>
						<ul>
							<!-- <li><a href="#">Loans</a></li>
							<li><a href="#">Car loans</a></li>
							<li><a href="#">Debt consolidation loans</a></li>
							<li><a href="#">Home improvement loans</a></li>
							<li><a href="#"> Wedding loans</a></li>
							<li><a href="#">Innovative Finance ISA</a></li> -->
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h2>About us</h2>
						<ul>
							<!-- <li><a href="#">About us</a></li>
							<li><a href="#">Our story</a></li>
							<li><a href="#">Meet the board</a></li>
							<li><a href="#">Meet the leadership team</a></li>
							<li><a href="#">Awards</a></li>
							<li><a href="#">Careers</a></li> -->
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h2>Legal</h2>
						<ul>
							<li><a href="#">Privacy policy</a></li>
							<!-- <li><a href="#">Loans2go principles</a></li> -->
							<li><a href="#">Website terms</a></li>
							<li><a href="#">Cookie policy</a></li>
							<li><a href="#">Conflicts policy</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h2>Site Info</h2>
						<ul>
							<li><a href="#">Support</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Sitemap</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="#">Contact us</a></li>
						</ul>
					</div>
				</div>
			</div>
			<p></p>
			<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
</div>
		</div>
	</footer>
	<!-- Footer Section end -->
	
	<!--====== Javascripts & Jquery ======-->
	<!-- <script src="<?php bloginfo('template_url') ?>/js/jquery-3.2.1.min.js"></script> -->
	<script src="<?php bloginfo('template_url') ?>/js/bootstrap.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery.slicknav.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/owl.carousel.min.js"></script>
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<script src="<?php bloginfo('template_url') ?>/js/jquery-ui.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/main.js"></script>

	<!-- <script src="<?php bloginfo('template_url') ?>/assets/js/ajax.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
	<script src="<?php bloginfo('template_url') ?>/js/wow.min.js"></script>
	<!-- <script src="<?php bloginfo('template_url') ?>/assets/dist/snackbar.min.js"></script> -->

	<script>
  	new WOW().init();
  	// new Snackbar().init();
	</script>


	<!-- <?php
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	
	if ($user){
	// do nothing
	}else{
	if(isset ($_GET['a'])){
	  // Simulate click of BTN when GET-Requested
	  if( $_GET['a'] == 'register' || $_GET['a'] == 'forgot') : ?>
	    <script type="text/javascript">
	      document.getElementById("register_click").click();
	    </script>
	  <?php elseif( $_GET['a'] == 'login') : ?>
	    <script type="text/javascript">
	      document.getElementById("login_click").click();
	    </script>
	  <?php elseif( $_GET['a'] == 'lostpassword' ) : ?>
	    <script type="text/javascript">
	      document.getElementById("lostpwd_click").click();
	    </script>
	
	  <?php endif; } } ?> -->

<script>

	$(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;
        // console.log(url);
        // passes on every "a" tag
        $(".top_menu a").each(function() {
            // checks if its the same on the address bar

            console.log(this.href);
            if (url == (this.href) + '/') {
            	
                $(this).closest("li").addClass("active");
                $(this).closest("a").addClass("active");
                //for making parent of submenu active
               $(this).closest("li").parent().parent().addClass("active");
            }else{
            	// console.log("class is not active");
            }
        });
    });     

   var fade_out = function() {
  $(".alert-bx").fadeOut().empty();
}
setTimeout(fade_out, 500000); 

 


$(document).ready(function() {
	$('.button').click(function() {
   		Snackbar.show({text: 'Example notification text.'});
	});

$(".btn_clk").click( function(){
    	val = $(this).data("img");
    	// alert(val);
    	var values = {
            'post_id' : val
        };

        $('#img_modal').modal('show');
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_info_by_id.php",
          // dataType: 'JSON',
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $(".response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('.response').html(errorMsg);
			}
         });
   	});


var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = 1; // What page we are on.
    var ppp = 3; // Post per page
 $(".more_posts").click( function(){ 
 	// $( "#outer" ).mouseover(function() {
        $(".more_posts").attr("disabled",true); // Disable the button, temp.
        id = $(this).data("id");
        // alert(id);
        // alert(ajaxUrl);
		// $('html, body').animate({
	 //        scrollTop: $("#card_view").offset().top -270
	 //    }, 'slow'); // scroll to div

   		$('.loading_img').show();
		var data = {
			'action': 'load_posts_by_ajax',
			'page': page,
			// 'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
		};

		$.post(ajaxUrl, data, function(response){
			// $('.my-posts').append(response);
			$('.resp_card').html(response).hide().fadeIn(1500);
			$('.loading_img').hide();
			page++;
			

		});
	});

});

// function to callback main url and remove parameters from url after reloads
var url= document.location.href;
if (url.indexOf("?s=") > -1) {
      // alert("your url contains the name franky");
    }else if(url.indexOf("?") > -1){
		ff = url.split("?")[1];
		gg = ff.split("=")[0];

		if(gg == 's'){
			// do nothing
		}else{
			window.history.pushState({}, "", url.split("?")[0]);
		}
    }else{
    	// do nothing
    }



// ajax pagination
var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = 1; // What page we are on.
    jquery(function($){
    	$(window).scroll(function(){
    		if($(window).scroll() == $(document).height() - $(document).height()) {

    			alert('scroll');
    			var data = {
    				'action': 'load_posts_by_ajax',
    				'page': page,
    				// 'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
    			};

    			$.post(ajaxUrl, data, function(response){
    				$('.my-posts').append(response);
    				page++;
    			});
    		}
    	});
    });

</script>

	</body>
</html>
