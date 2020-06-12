<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>

<div id="contact" class="footer" style="width: 1343px; margin-left: -102px;">
    <div class="container">
        <div class="row">
             <div class="col-md-4">
                <div class="hm-ft-contact ">
                    <div class="ftr-title"><p>Contact Us</p>
                    <!-- <hr style="margin-top: -12px; width: 75%; margin-left: -2px;border-top: 1px solid #ec4707;" > -->
                     </div>

                    <ul class="list-unstyled">
                      <li>Mobile No. : 987654234</li>
                      <li>Phone No. : 01-4456785</li>
                      <li>Fax No. : 01-4456785</li>
                      <li>SE-mail : <a href="#">Sales@tendernepal.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4" style="text-align: center;padding-top:50px;">
            	<div class="google-maps">
            		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.3806416884013!2d85.36422551506135!3d27.67462798280551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1a105e2dab75%3A0xda52a3c686042a03!2sVolcussoft!5e0!3m2!1sne!2snp!4v1502609057127" width="100%" height="180px" class="img-rounded" frameborder="0" style="border:0" allowfullscreen></iframe>
            	</div>
            </div>
             <div class="col-md-4 right_block_footer">
             <p> Follow us</p>
            <hr class='right_block_footer_line'>
              <div class="social_icons">
               	<ul style='padding:0;'>
               		<li ><a class="rotate-link" href="#"><i class="fa fa-facebook rotate-icon" aria-hidden="true"></i></a></li>
               		<li ><a class="rotate-link" href="#"><i class="fa fa-twitter rotate-icon" aria-hidden="true"></i></a></li>
               		<li ><a href="#"><i class="fa fa-google-plus rotate-icon" aria-hidden="true"></i></a></li>
               	</ul>
              </div>
            </div>
        </div>
    </div>
        <hr style="margin:10px 0 10px 0;">
    <div class="container">
        <div class="row copy-div">
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
</div>

<!-- //.footer -->

<script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/js/tilt.jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    const tilt = $('.js-tilt').tilt();
    $('.js-destroy').on('click', function () {
        const element = $(this).closest('.js-parent').find('.js-tilt');
        element.tilt.destroy.call(element);
    });
    $('.js-getvalue').on('click', function () {
        const element = $(this).closest('.js-parent').find('.js-tilt');
        const test = element.tilt.getValues.call(element);
        console.log(test[0]);
    });
    $('.js-reset').on('click', function () {
        const element = $(this).closest('.js-parent').find('.js-tilt');
        element.tilt.reset.call(element);
    });
    $('.js-tilt').tilt({
	scale: 1.2
	});
</script>

<!-- JS for LOGIN/REGISTER MODAL -->
<script>
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

<?php wp_footer();
if(isset ($_GET['action'])){
  // Simulate click of BTN when GET-Requested
  if( $_GET['action'] == 'register' || $_GET['action'] == 'forgot') : ?>
    <script type="text/javascript">
      document.getElementById("register_mod_link").click();
    </script>
  <?php elseif( $_GET['action'] == 'login') : ?>
    <script type="text/javascript">
      document.getElementById("signin_mod_link").click();
    </script>
  <?php elseif( $_GET['action'] == 'lostpassword' ) : ?>
    <script type="text/javascript">
      document.getElementById("lostpass_mod_link").click();
    </script>
  <?php endif;} ?>



<p>huashd asd jas dsajasn</p>
</body>
</html>
