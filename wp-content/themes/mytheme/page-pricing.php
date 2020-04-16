<?php 
/**
 * Template Name: Pricing Page
 */

get_header(); 


global $wpdb;
  $result1 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '1'",ARRAY_A );
  $result1 = $result1['0'];

  $result2 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '2'" , ARRAY_A);
  $result2 = $result2['0'];

  $result3 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '3'" , ARRAY_A );
  $result3 = $result3['0'];

?>
<style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600);

.promos {
  width: 800px;
  margin: 0 auto;
  margin-top: 100px;
}
.promo {
  width: 250px;
  background: #0F1012; 
  color: #f9f9f9;
  float: left;
}
.deal {
  padding: 10px 0 0 0;
}
.deal span {
  display: block;
  text-align: center;
}
.deal span:first-of-type {
  font-size: 18px;  
}
.deal span:last-of-type {
  font-size: 13px;
}
.promo .price {
  display: block;
  width: 250px;  
  background: #292b2e;
  margin: 15px 0 10px 0;
  text-align: center;
  font-size: 23px;
  padding: 17px 0 17px 0;
}

button {
  border: none;
  border-radius: 40px;
  background: #292b2e;
  color: #f9f9f9;
  padding: 10px 37px;
  margin: 10px 0 20px 60px;
}
.scale {
  transform: scale(1.2);
  box-shadow: 0 0 4px 1px rgba(20, 20, 20, 0.8);
}
.scale button {
  background: #64AAA4;
}
.scale .price {
  color: #64AAA4;
}
</style>


<section class="hero-section-1 main-pg-section">
	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home</a></span> /
					<span>Pricing</span>
					
			</div>
		</div>
	</div>


	<div class="container mb-3">
		<div class="card p-3 mt-3">
		<div class="row">
		<h3 style="text-align: center;margin-top: 15px;">Our Pricing Options:</h3>
  			<hr>
  		</div>

		<div class="row">
			

  			<div class="promos"> 

<div class="promo">
  <div class="deal">
    <span><?= $result1['title'] ?></span>
  <span><?= $result1['sub'] ?></span>
  </div>
  <span class="price" style=""><?= $result1['price'] ?></span>
  <ul class="features">
    
   <li><?= $result1['monthly'] ?></li>   
  </ul>
  <?php if( !is_user_logged_in() ) : ?>
    <a href="#"><button id="register_mod_link" style="padding-left: 25px;" data-toggle="modal" data-target="#register_Modal">Sign Up</button></a>
  <?php else: ?>
    <a href="<?php echo home_url('/order') ?>"><button>Order</button></a>
  <?php endif; ?>
</div>


<div class="promo scale">
  <div class="deal">
    <span><?= $result2['title'] ?></span>
  <span><?= $result2['sub'] ?></span>
  </div>
  <span class="outer">
  <span class='price' style=""><?= $result2['price'] ?></span></span>
  <ul class="features">
  
  <li><?= $result2['monthly'] ?></li>
  </ul>
  <?php if( !is_user_logged_in() ) : ?>
    <a href="#"><button id="register_mod_link" style="padding-left: 25px;" data-dismiss="modal" data-toggle="modal" data-target="#register_Modal">Sign Up</button></a>
  <?php else: ?>
    <a href="<?php echo home_url('/order') ?>" ><button>Order</button></a>
  <?php endif; ?>
</div>


<div class="promo">
  <div class="deal">
    <span><?= $result3['title'] ?></span>
  <span><?= $result['sub'] ?></span>
  </div>
   <span class="outer">
  <span class='price' style=""><?= $result3['price'] ?></span></span>
  <ul class="features">
  
  <li><?= $result3['monthly'] ?></li>
  </ul>
  <?php if( !is_user_logged_in() ) : ?>
    <a href="#"><button id="register_mod_link" style="padding-left: 25px;" data-toggle="modal" data-target="#register_Modal">Sign Up</button></a>
  <?php else: ?>
    <a href="<?php echo home_url('/order') ?>"><button>Order</button></a>
  <?php endif; ?>
</div>


</div>


		</div>
	</div>
	</div>
</div>
</section>




<?php get_footer(); ?>