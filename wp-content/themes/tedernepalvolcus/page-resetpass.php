<?php   
get_header('user');

?>
<style type="text/css">
	.description{
		font-size: 12px;
		display: none;
	}
	#theme-my-login{
		text-align: center;
	}
</style>
<div class="container" style="margin-top: 100px;">
	<div class="row">
		<div class="col col-md-4 col-md-offset-4">
		<div class="" style="border: 1px solid black; background-color: lightgrey; padding: 20px; margin-bottom: 50px;">	
			<?php

			if(have_posts()) : 

			while(have_posts()) : the_post();

				the_content();
			endwhile;
			endif;
			?>
		</div>
		</div>
		<p style="color: red; font-size: 15px;"><strong>Note: </strong>The password must be at least 8 characters long including numbers.</p>
	</div>
</div>
<hr style="margin:10px 0 10px 0;">
    <div class="container">
        <div class="row copy-div" style="background-color: whitesmoke;">
            <div class="col-md-6">
                <div class="footer-links">
                    <ul class="list-inline pull-right">
                        <li><a href="#" target="_blank">Terms of use</a></li>
                        <li><a href="#" target="_blank">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="copy pull-left">| Copyright © 2017 <a href="#" target="_blank">Volcus Soft Pvt.Ltd</a></div>
            </div>
            <br>
            <br>
         </div>
    </div>

<?php
//get_footer('user');
	?>
