<?php get_header(); ?>

<section class="hero-section-1 main-pg-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 card">
			<?php  
          if (isset($_GET['register'])){
          $register = $_GET['register'];  
         
          if($register == true) { 
                        echo '<div class="alert alert-success">Check your email and set the password!</div>'; 
                        }
                       }
                         else {

                        echo '<div class="alert alert-warning">Please provide a unique username or email address!</div>';
                      }
                      ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>