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
.main-section{
	background-color: #fafafa;
	padding: 12px 40px;
}	
.x-gap{
	border-color: transparent;
}
.x-text p{
	font-size: 1em;
}
.x-text-2 p{
	color: #000 !important;
    font-family: "Roboto",Sans-serif;
    font-weight: 400;
    line-height: 1.5em;
    padding-top: 8px;
}
.x-ul-icons{
	list-style: none;
	margin-top: 14px;
}
.feat-icon{
	font-size: 52px;
	/*color: #2ecc71;*/
	color: #fff;
}
.som:before{
	content: '';
	border-left: 1px dashed grey;
}
.x-counter{
	text-align: center;
}
.text-above{
	margin-bottom: .5em;
}
.text-below{
	margin-top: .5em;
}
.x-counter .text-above, .x-counter .text-below {
    display: block;
    letter-spacing: .125em;
    line-height: 1.5;
    text-transform: uppercase;
}
.numbers-wrap{
	font-size: 3.25em;
	line-height: 1;
	color: grey;
	font-weight: 700 !important;
}
.circle{
	background: #2ecc71;
    border-radius: 50%;
    padding: 9px;
}
.square{
	background: #2ecc71;
    /*border-radius: 50%;*/
    padding: 9px;
}


.bus-mod-icon{
	font-size: 105px;
	color: darkgrey;
}

.bot-sec-head h2{
	color: #fff;
    font-family: "Roboto",Sans-serif;
    font-size: 38px;
    font-weight: 300;
}
.bot-sec-text p{
	font-family: 'Arimo';
    font-style: normal;
    font-weight: 400;
    color: #fff;
    font-size: 16px;
}
.bot-sec-list{
	list-style: none;
	color: #fff;
}
.bot-sec-list li{
	color: #fff;
    font-family: "Roboto",Sans-serif;
    font-size: 24px;
    font-weight: 300;
    line-height: 1.5;
}
</style>

<section class="hero-section-1 main-pg-section">
	<div class="container card mt-4 p-4">
		<?php 
		if($msg){
		echo '<div class="alert alert-success">'.$msg.'</div>'; 
	} ?>


			<div class="main-section">
				<h2>Professional Business Plans For Funding</h2>
				<hr class="x-gap" style="margin: 7px 0 0 0;">

				<div class="x-text">
				<p>You will not have to worry about whether your plan is good enough to be seen by an investor, bank or endorsement company.</p>

				<p>Our business plans are of a high standard, so you will be able to speak to key stakeholders knowing you have a professional business plan to back up your business proposal.</p>

				<p>Your business plan writer will also be available to answer any questions investors or funders may have about your business.</p>
				</div>

				<h4>All Plans Include</h4>
				<ul class="x-ul-icons mvn">
					<li><i class="fa fa-check" aria-hidden="true"></i> Funding Advice</li>
					<li><i class="fa fa-check" aria-hidden="true"></i> Help With Improving Your Business Model</li>
					<li><i class="fa fa-check" aria-hidden="true"></i> Market Research</li>
					<li><i class="fa fa-check" aria-hidden="true"></i> Competitor Analysis</li>
					<li><i class="fa fa-check" aria-hidden="true"></i> Business Valuation</li>
					<li><i class="fa fa-check" aria-hidden="true"></i> Financial Projections</li>

				</ul>

				<hr class="x-gap" style="margin: 7px 0 0 0;">
				<div class="mt-4">
					<h2>Business Plan Features</h2>
				</div>

				<ul class="mt-3" style="list-style: none;">

					<li class="pt-4 pb-4">
						
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-gears circle"></i>
							<!-- <span class="som"></span> -->
						</div>
						<div class="feat-head col-md-10">
							<h3>Idea Development</h3>
							<p>If you have an idea but do not have much information, your business plan writer can help you develop your idea further and build a business plan around it. All of our plans come with business advice that helps you take your idea to the next level.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-bar-chart circle"></i>
							<!-- <span class="som"></span> -->
						</div>
						<div class="feat-head col-md-10">
							<h3>Financial Projections</h3>
							<p>All Business Plans include financial projections for 3-5 years. It includes Sales Projections, P&L, Balance Sheet, Cash Flow, Metrics & KPI’s</p>
						</div>
						</div>
					</li>

					<li  class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-info-circle circle"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Market Research</h3>
							<p>Your business plan writer will conduct research to ensure your business is in a profitable and sustainable market. We’ll also research your ideal customer, ensuring there is a product/market fit and you know enough about them to build engaging marketing campaigns.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-bullhorn square"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Marketing Plan</h3>
							<p>No business plan is complete without a solid Marketing Plan. Your business plan writer will help you backup your sales projections with an engaging marketing plan. Using the information we’ve gathered from the market research we’ll help you create campaigns to attract your ideal customer.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-clipboard square"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Business Advice</h3>
							<p>We do not just write a business plan, we try to add value to your business by providing you with business advice. We have worked with over 1500 businesses over the past six years, and we will transfer our knowledge to help you succeed.</p>
						</div>
						</div>
					</li>

					<li  class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-money square"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Business Funding Database</h3>
							<p>We have a database of all of the main institutional investors and funders in the UK. When your project is complete, we will share this with you and inform you of your most likely sources of funding. We will also ensure your business plan is written to increase your chances of securing investment or funding.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-life-ring square"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Business Support & Development</h3>
							<p>Sometimes you may need more than just a business plan. We also offer startup support, business growth solutions and business mentoring. When your business plan is complete, your business plan writer will discuss with you some of the options you have for us to continue to support your business development and growth.</p>
						</div>
						</div>
					</li>

				</ul>
			</div>
			
<div>
	<div style="background-color: #135589; color: white !important; padding: 15px; text-align: center;">

		<h5 class="man mt-4 mb-4" p="" style="color:white"> Book A Free Consultation</h5>

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
								<div class="row">
									<div class="col-md-3 col-sm-12">
										<label class="ml-2"><input type="radio" name="urgency" value="High"> High</label>
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="ml-2"><input type="radio" name="urgency" value="Medium"> Medium</label>
									</div>
									<div class="col-md-3 col-sm-12">
										<label class="ml-2"><input type="radio" name="urgency" value="Low"> Low</label>
									</div>
								</div>
								
								
								
							</div>
						</div>

						<div class="row mt-3 mb-5">
							<div class="col-md-12 col-sm-12">
								<!-- <a href="#" class="btns btn-defaults contact-btn mt-4" >Contact Us</a> -->
								<input type="submit" name="btn_submit" class="contact-btn btn btn-primary mt-4">
							</div>
						</div>
		</form>
	</div>
</div>

<!-- not required anymore -->
<!-- <div class="row x-counter p-5">
	<div class="col-md-4 col-sm">
		<span class="text-above">WE HAVE WRITTEN</span>
		<div class="numbers-wrap">
			<span class="number" id="plans">1500</span>
			<span class="suffix">+</span>
		</div>
		<span class="text-below">PLANS</span>
	</div>

	<div class="col-md-4 col-sm">
		<span class="text-above">WE HAVE ACHIEVED</span>
		<div class="numbers-wrap">
			<span class="number" id="s_rate">90</span>
			<span class="suffix">+</span>
		</div>
		<span class="text-below">SUCCESS RATE</span>
	</div>

	<div class="col-md-4 col-sm">
		<span class="text-above">AND HAVE RAISED</span>
		<div class="numbers-wrap">
			<span class="number">£8m</span>
			<span class="suffix">+</span>
		</div>
		<span class="text-below">IN FUNDING / INVESTMENT</span>
	</div>
</div> -->

<div class="main-section pt-5">
	<div class="business-formula">
		<h2 class="pb-4">Business Success Formula</h2>
		<p>Most successful businesses contain similar attributes. On every plan, our business plan writers follow our Business Success Formula, ensuring your business plan includes everything you need to make your business a success.</p>

		<div class="">
			<img src="<?= get_template_directory_uri()?>/img/bsf.jpg">
		</div>
	</div>

	<div class="business-planning mt-5">
		<h2>Business Planning Process</h2>
	</div>

	<ul class="mt-3" style="list-style: none;">
					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-rocket circle"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Step 1 - The Kick Off</h3>
							<p>Your business plan writer will find out about your business, competition, and goals as a business owner.</p>
						</div>
						</div>
					</li>

					<li  class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-book circle"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Step 2 - Research</h3>
							<p>Your business plan writer will find out as much about your market and your competition. This stage is critical for your business plan. We’ll to help you improve your business model and get ahead of the competition.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-pencil square"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Step 3 - Business Plan Writing</h3>
							<p>Your business plan writer will write your business plan using all the information we have received from you and what we have found out in the research phase.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-check-circle-o circle"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Step 4 - Business Plan Draft 1</h3>
							<p>Your business plan writer will complete a draft with the information we have available. We’ll assess your business against our business success formula and highlight the areas that need development.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-check-circle circle"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Step 5 - Business Plan Draft 2 (Optional)</h3>
							<p>The second draft rectifies any issues discovered in the first draft.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-thumbs-o-up circle"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Step 6 - Approval</h3>
							<p>No project is completed without you approving the work.</p>
						</div>
						</div>
					</li>

					<li class="pt-4 pb-4">
						<div class="row">
						<div class="feat-icon col-md-2">
							<i class="fa fa-thumbs-up circle"></i>
						</div>
						<div class="feat-head col-md-10">
							<h3>Step 7 - Completion</h3>
							<p>The plan is complete but our support is not necessarily over. Before you go your business plan writer will agree how we will support you on the next stage of your business development.</p>
						</div>
						</div>
					</li>

				</ul>
</div>


		<div class="row pt-4">
			<div class="col-md-12 col-sm-12 pb-5" style="text-align: center;">
				<h2>Some Details Of Our Business Plans Include</h2>
			</div>

			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-desktop"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>Executive Summary</h3>
						</div>
						<div class="x-text-2">
							<p>The Executive Summary is perhaps one of the most important parts of your plan and plays a major role in providing a quick synopsis to your investors. With an executive summary, you can convince the right person to read on and to use the information within as a general guide as to your competence and professional credibility.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-pie-chart"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>Market Details</h3>
						</div>
						<div class="x-text-2">
							<p>Market Details is a vital element of your plan as it will help the reader to understand your target market, show off your suppliers, as well as explaining your competition. This helps to show the reader not only what you provide, but where you will be providing it, and the level of competition that exists at the time that you need to overcome.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-pie-chart"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>General Overview</h3>
						</div>
						<div class="x-text-2">
							<p>A smart, succinct section that outlines your mission statement, a breakdown of company ownership, a history of the business, and where you’re positioned in the market. It is written at a high level without going into details.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-bar-chart"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>Sales Model</h3>
						</div>
						<div class="x-text-2">
							<p>You also need to show how you will be selling and what the general projections are for future years. This is obviously dependent on various factors, but everything from pricing plans to forecasted sales targets will be expected. A breakdown of the cost of sales and the general anticipated sales volume is more than enough for this section.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-cog"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>Products or Services</h3>
						</div>
						<div class="x-text-2">
							<p>Whether the business offers a service or sells products, this section identifies the main issues your business shall solve, including pricing, fulfilment, and various other key factors that will explain how your business intends to operate.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-pie-chart"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>Marketing</h3>
						</div>
						<div class="x-text-2">
							<p>Another critical part of our business plan service is to create a marketing plan to help explain which forms of marketing are presently available to you, and within your budget, that will enable you to reach your target audience. This is usually achieved through a mix of local, online, and offline marketing strategies.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-money"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>Financial Section</h3>
						</div>
						<div class="x-text-2">
							<p>The last, but often most important, part of any business plan is that it includes all relevant financial details to back up and explain how the business finances will function. Expected Profit and Loss statements will have to be shown, along with a Cashflow projection plan. This part will play a major role in influencing your potential investors that you’re a serious business contender.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="row">
					<div class="col-md-3 col-sm-12 bus-mod-icon">
						<i class="fa fa-users"></i>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="">
							<h3>Management Structure</h3>
						</div>
						<div class="x-text-2">
							<p>This is a very underrated part of a successful business plan. Your business has to be able to demonstrate to any potential investor that you have the means to be trusted. So, who are you? Does the business have sound leadership, and will it be professionally staffed and ran going forward?</p>
						</div>
					</div>
				</div>
			</div>
			
		</div>

	</div>
	
</section>

<section class="hero-section-1" style="background-image: url('<?= get_template_directory_uri()?>/img/handshake.jpg');">
	<div class="container">
		<div class="row pt-4 pb-4">
			<div class="col-md-6 col-sm-12">
				<div class="bot-sec-head">
					<h2>THE PROCESS <b>IS EASY</b></h2>
				</div>
				<div class="">
					<p style="color: #fff;">Our job is to take the stress out of writing your business plan.</p>
				</div>

				<div class="bot-sec-head">
					<h2>SIMPLE <b>STEPS</b></h2>

					<ul class="bot-sec-list">
						<li><u><b>1</b></u> Free Consultation Call</li>
						<li><u><b>2</b></u> Information Gathering</li>
						<li><u><b>3</b></u> First Draft</li>
						<li><u><b>4</b></u> Revisions</li>
						<li><u><b>5</b></u> Final Draft and Handover</li>
					</ul>

					<p style="color:#fff;font-size: 24px;"><u><b>Click Here</b></u> for more details on the process</p>
				</div>
			</div>

			<div class="col-md-6 col-sm-12">
				<div class="bot-sec-head">
					<h2>HOW MUCH DOES IT <b>COST?</b></h2>
				</div>
				<div class="bot-sec-text mt-4">
					<p>We try to make our business plans affordable, accessible to all business sizes, and are confident they represent great value for money.
The cost of a plan will depend on the level of detail required, the complexity of the business model, and the nature of your audience. After we have had an initial discussion with you, we are able to accurately quote for projects based on the amount of work required.
Every plan is different and is written specifically for the individual client’s needs. This means that the number of weeks it takes to write a plan can vary.</p>
				</div>

				<p style="color:#fff;font-size: 24px;">For more information on pricing please <u><b>Click Here</b></u> </p>

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

animateValue("plans", 0, 1500, 5000);
animateValue("s_rate", 0, 90, 5000);
</script>
<?php get_footer(); ?>