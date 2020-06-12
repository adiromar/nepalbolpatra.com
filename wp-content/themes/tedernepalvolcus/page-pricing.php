<?php
get_header();


?>
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
<!-- 
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
</script> -->

<!-- //.login/register section -->
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
<?php 
  global $wpdb;
  $result1 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '1'",ARRAY_A );
  $result1 = $result1['0'];

  $result2 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '2'" , ARRAY_A);
  $result2 = $result2['0'];

  $result3 = $wpdb->get_results( "SELECT * FROM wp_pricing WHERE id = '3'" , ARRAY_A );
  $result3 = $result3['0'];
?>
<div class="container" style="margin-bottom: 100px;">
<div class="row">
  <h3 style="margin-top: 90px;">Our Pricing Options:</h3>
  <hr>
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
    <a href="<?php echo home_url('/order') ?>"><button id="register_mod_link" style="padding-left: 25px;" data-toggle="modal" data-target="#myModal" onclick="show_register();return false;">Sign Up</button></a>
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
    <a href="<?php echo home_url('/order') ?>"><button id="register_mod_link" style="padding-left: 25px;" data-toggle="modal" data-target="#myModal" onclick="show_register();return false;">Sign Up</button></a>
  <?php else: ?>
    <a href="<?php echo home_url('/order') ?>"><button>Order</button></a>
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
    <a href="<?php echo home_url('/order') ?>"><button id="register_mod_link" style="padding-left: 25px;" data-toggle="modal" data-target="#myModal" onclick="show_register();return false;">Sign Up</button></a>
  <?php else: ?>
    <a href="<?php echo home_url('/order') ?>"><button>Order</button></a>
  <?php endif; ?>
</div>


</div>
</div>
</div>
<?php get_footer();
?>
