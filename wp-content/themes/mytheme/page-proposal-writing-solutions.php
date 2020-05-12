<?php get_header(); ?>
<?php 
global $wpdb;
if(isset($_POST['btn_submit']))
{
// echo '<pre>';
// print_r($_POST);die;

  $company_name = $_POST['company_name'];
  $contact_name = $_POST['contact_name'];
  $email = $_POST['email'];
  $phone_no = $_POST['phone_no'];
  $tender_name = $_POST['tender_name'];
  $tender_link = $_POST['tender_link'];
  $urgency = $_POST['urgency'];

   $table = "wp_addindustry";
  $insert = $wpdb->insert('wp_contactus',array(
  	'company_name' => $company_name,
  	'contact_name' => $contact_name,
  	'email' => $email,
  	'phone_no' => $phone_no,
  	'tender_name' => $tender_name,
  	'tender_link' => $tender_link,
  	'urgency' => $urgency,
  ),array(
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  	'%s',
  ));
  // echo '<div class="alert alert-success"><h4>New Industry added successfully.</h4></div>';
  if($insert){
  	$msg = "Your Message is successfully delivered !!";
  }else{
  	$msg = '';
  }
}
?>
<style type="text/css">
	.cust-head{
		float: left;
	}
	p{
	font-family: Cabin;
    line-height: 25px;
    letter-spacing: 0.5px;
    font-weight: 400;
    font-style: normal;
    color: #747e80;
    font-size: 16px;
}
.pc{
	color: #36ab9c;
}
.grid-line-pp{
	border-color: #36ab9c;
	display: block;
    position: relative;
    text-align: left;
    padding-bottom: 0;
    border-top-width: 2px;
    border-top-style: solid;
}
.list-view{
	position: relative;
    margin: 0;
    padding: 0;
    list-style: none;
}
.ins-pp-item{
	display: inline-block;
    position: relative;
    float: left;
    margin: 15px;
    margin-bottom: 0;
    padding: 0;
    border: 1px solid #e5e7f2;
    border-radius: 4px;
    margin-top: 0;
    -webkit-transition: .25s;
    -o-transition: .25s;
    transition: .25s;
    padding-top: 55px;
    box-shadow: none!important;
    background: 0 0;
    border: 0;
    padding-bottom: 0;
}
.ins-pp-item:before {
    content: '';
    width: 50px;
    height: 50px;
    background: #fff;
    border-width: 2px;
    border-style: solid;
    border-radius: 50%;
    position: absolute;
    top: -25px;
    border-color: #36ab9c;
}
.ins-number{
	display: block;
    position: relative;
    margin-bottom: 23px;
    line-height: 1;
    position: absolute;
    top: -7px;
    left: 0px;
    width: 50px;
    font-weight: 700;
    text-align: center;
}
.budget-section{
	background-color: #223645;
}
.bud-h4{
	color: #36ab9c;
}
.otb{
	color: #fff;
}
.empty-space{
	height: 40px;
}
.ct-btn{
	background-color: #36ab9c;
	color: #fff;
}
.icon-100 i{
	font-size: 60px;
	color: #36ab9c;
}
.ending-section{
	background-color: #36ab9c !important;
}
.cir-o i{
	font-size: 145px;
	color: #fff;
}
.last-sec p{
	color: #fff;
	font-size: 14px;
}
.quote-btn{
	background: #223645;
    color: #fff;
    padding: 12px 34px;
    border-radius: 5px;
}
.quote-btn:hover{
	background-color: #fff !important;
	color: #223645;
}
.contact-btn{
	background: #36ab9c;
    color: #fff;
    padding: 12px 34px;
    border-radius: 5px;
}
.contact-btn:hover{
	background-color: #fff !important;
	color: #223645;
}

[class^="iconsmind-"], [class*=" iconsmind-"] {
    font-family: 'iconsmind';
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.iconsmind-Clock-Forward:before {
    content: "\e770";
}
.numscroller{
	font-size: 54px;
}
#contact-form label, #contact-form span{
	color: #fff;
	font-weight: 700;
}
</style>


<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<section class="hero-section-1 main-pg-sections card">
	
	<div class="container cards">
	<?php 
		if($msg){
		echo '<div class="alert alert-success">'.$msg.'</div>'; 
	} ?>

		<div class="row">
			<div class="col-md-6 col-sm-12">
				<img src="<?= get_template_directory_uri()?>/img/process.png">
			</div>

			<div class="col-md-6 col-sm-12 pt-4 pb-3">
				<div class="cust-head">
					<h2>Effective, Nepalese Tender Writing Solutions for every Industry from A to Z</h2>
				</div>
				

				<div class="cust-cont pt-4">
					<p>Tenders A to Z allows you to maximise your chances of winning your bid, while outsourcing 99% of the work involved.</p>

					<p>Our qualified and experienced tender writers provide confidential bid support tailored to your exact needs, by following this process:</p>
				</div>
			</div>
		</div>

		<div class="row pt-5">
			<div class="grid-line-pp">
			<ul class="list-view">
				<li class="ins-pp-item" style="width: calc(33.3333% - 30px);">
					<div class="ins-pp-container">
						<div class="ins-number">
							<span class="pc">1</span>
						</div>
						<div class="ins-text">
							<h4>RFT Submitted</h4>
							<p>Client provides a copy of the request for tender documents</p>
						</div>
					</div>
				</li>

				<li class="ins-pp-item" style="width: calc(33.3333% - 30px);">
					<div class="ins-pp-container">
						<div class="ins-number">
							<span class="pc">2</span>
						</div>
						<div class="ins-text">
							<h4>Quote Provided</h4>
							<p>We provide a quote to the client for preparation of the tender and supporting documents</p>
						</div>
					</div>
				</li>

				<li class="ins-pp-item" style="width: calc(33.3333% - 30px);">
					<div class="ins-pp-container">
						<div class="ins-number">
							<span class="pc">3</span>
						</div>
						<div class="ins-text">
							<h4>Draft Response</h4>
							<p>We submit draft response for the client</p>
						</div>
					</div>
				</li>
				</ul>
</div>
</div>

<div class="row mt-5">
<div class="grid-line-pp col-md-12 col-sm-12">
	
				<ul class="list-view">
				<li class="ins-pp-item" style="width: calc(33.3333% - 30px);">
					<div class="ins-pp-container">
						<div class="ins-number">
							<span class="pc">4</span>
						</div>
						<div class="ins-text">
							<h4>Draft Response</h4>
							<p>We submit draft response for client review</p>
						</div>
					</div>
				</li>

				<li class="ins-pp-item" style="width: calc(33.3333% - 30px);">
					<div class="ins-pp-container">
						<div class="ins-number">
							<span class="pc">5</span>
						</div>
						<div class="ins-text">
							<h4>Necessary Edits</h4>
							<p>Client flags any necessary changes</p>
						</div>
					</div>
				</li>

				<li class="ins-pp-item" style="width: calc(33.3333% - 30px);">
					<div class="ins-pp-container">
						<div class="ins-number">
							<span class="pc">3</span>
						</div>
						<div class="ins-text">
							<h4>Re-draft submitted to client</h4>
							<p>Updated draft submitted to client for final check</p>
						</div>
					</div>
				</li>
			</ul>
			</div>
		</div>

		<div class="row mt-5">
<div class="grid-line-pp col-md-12 col-sm-12">
	
				<ul class="list-view">
				<li class="ins-pp-item" style="width: calc(100% - 30px);">
					<div class="ins-pp-container">
						<div class="ins-number">
							<span class="pc">7</span>
						</div>
						<div class="ins-text">
							<h4>Tender Submitted</h4>
							<p>Client submits the tender</p>
						</div>
					</div>
				</li>
</ul>
</div>


	</div>
</section>

<section class="budget-section">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<img src="<?= get_template_directory_uri()?>/img/process.png">
			</div>
			<div class="col-md-6 col-sm-12 pt-4">
				<h4 class="bud-h4">OUR SERVICE GUARANTEE</h4>
				<h2 class="otb">On Time, On Budget.</h2>

				<div class="empty-space mt-4">
					<p style="color: #fff;font-size: 24px;">Professional and confidential bid support service tailored to your exact needs, completed on time, within budget to the highest standard.</p>
				</div>
				<div class="empty-space mt-4 mb-4">
					
				</div>
				<!-- <div class="empty-space mt-4 mb-4">
					
				</div> -->

				<div class="contact mt-4">
					<!-- <a href="#" class=""><button class="ct-btn btn btn-default">Contact Us</button></a> -->
					<h4 class="text-white mb-4">Contact Us</h4>
					<form action="" method="post" id="contact-form">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<label>Company Name*:</label>
								<input type="text" name="company_name" class="form-control" required>
							</div>

							<div class="col-md-6 col-sm-12">
								<label>Contact Name*:</label>
								<input type="text" name="contact_name" class="form-control" required>
							</div>

							<div class="col-md-6 col-sm-12 mt-3">
								<label>Email*:</label>
								<input type="email" name="email" class="form-control" required>
							</div>

							<div class="col-md-6 col-sm-12 mt-3">
								<label>Phone No.:</label> 
								<input type="text" name="phone_no" class="form-control">
							</div>

							<div class="col-md-6 col-sm-12 mt-3">
								<label>Tender Name*:</label>
								<input type="text" name="tender_name" class="form-control" required>
							</div>

							<div class="col-md-6 col-sm-12 mt-3">
								<label>Tender Link:</label>
								<input type="text" name="tender_link" class="form-control">
							</div>

							<div class="col-md-12 col-sm-12  mt-3">
								<label>Urgency Level:</label>
								<span class="ml-2"><input type="radio" name="urgency" value="High"> High</span>
								<span class="ml-2"><input type="radio" name="urgency" value="Medium"> Medium</span>
								<span class="ml-2"><input type="radio" name="urgency" value="Low"> Low</span>
							</div>
						</div>

						<div class="row mt-3 mb-5">
							<div class="col-md-12 col-sm-12">
								<!-- <a href="#" class="btns btn-defaults contact-btn mt-4" >Contact Us</a> -->
								<input type="submit" name="btn_submit" class="contact-btn mt-4">
							</div>
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- <section class="hero-section-1"> 
	<div class="container">
		<div class="row ">
			<div class="col-md-3 col-sm-12 wow bounceInUp" style="text-align: center;">
				<div class="col-md-12 col-sm-12 icon-100 mb-3">
					<i class="fa fa-map-marker"></i>
				</div>
				<div class="col-md-12 col-sm-12 ">
					<h4 class='numscroller' id="nep_based">100<span style="color: #36ab9c;"> %</span></h4>
				</div>
				<span><b>Nepal-based</b></span>
			</div>

			<div class="col-md-3 col-sm-12 wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s" style="text-align: center;">
				<div class="col-md-12 col-sm-12 icon-100 mb-3">
					<i class="fa fa-hourglass-end iconsmind-Clock-Forward"></i>
				</div>
				<div class="col-md-12 col-sm-12">
					<h4 class="numscroller" id="time">100<span style="color: #36ab9c;"> %</span></h4>
				</div>
				<span><b>Delivered On Time</b></span>
			</div>


			<div class="col-md-3 col-sm-12 wow bounceInUp" data-wow-duration="1s" data-wow-delay="1s" style="text-align: center;">
				<div class="col-md-12 col-sm-12 icon-100 mb-3">
					<i class="fa fa-calendar"></i>
				</div>
				<div class="col-md-12 col-sm-12">
					<h4 class="numscroller" id="exp">100<span style="color: #36ab9c;"> +</span></h4>
				</div>
				<span><b>Combined Years Experience</b></span>
			</div>

			<div class="col-md-3 col-sm-12 wow bounceInUp" data-wow-duration="1s" data-wow-delay="1.5s">
				<div class="col-md-12 col-sm-12 icon-100 mb-3">
					<i class="fa fa-money"></i>
				</div>
				<div class="col-md-12 col-sm-12">
					<h4 class="numscroller">NaN<span style="color: #36ab9c;">M</span></h4>
				</div>
				<span><b>Tenders Won</b></span>
			</div>

		</div>		
	</div>
</section> -->

<section class="hero-section-1 ending-section">
	<div class="container">
		<div class="row p-3">
			<div class="col-md-4 col-sm-12 cir-o">
				<i class="fa fa-check-circle-o"></i>
			</div>
			<div class="col-md-8 col-sm-12 wow slideInRight" data-wow-duration="2s" data-wow-delay="0.5s">
				<h2 style="color: #fff;">All industries. All budgets. Australia-wide.</h2>
				
				<div class="last-sec mt-4">
					<p>Qualified, experienced writers with a vast range of industry backgrounds, located in major centres nationally.
					Competitive tender submissions on time and on budget. Guaranteed.</p>	
				</div>
				

				<a href="#" class="btns btn-defaults quote-btn mt-4" >Get Free Quote</a>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
var fade_out = function() {
  $(".alert").fadeOut().empty();
}
setTimeout(fade_out, 5000); 

function animateValue(id, start, end, duration) {
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.getElementById(id);
    var timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}

animateValue("nep_based", 0, 100, 5000);
animateValue("time", 0, 100, 6000);
animateValue("exp", 0, 100, 7000);

</script>

<?php get_footer(); ?>