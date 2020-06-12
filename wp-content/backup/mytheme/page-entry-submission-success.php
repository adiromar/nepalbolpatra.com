<?php get_header(); ?>
<style type="text/css">
	hr.message-inner-separator
{
    clear: both;
    margin-top: 10px;
    margin-bottom: 13px;
    border: 0;
    height: 1px;
    background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
    background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
</style>

<section class="hero-section-1 main-pg-section">
	<div class="container">
		<div class="row">
					<div class="col-sm-12 col-md-6">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button>
               <span class="glyphicon glyphicon-ok"></span> <strong>Success Message</strong>
                <hr class="message-inner-separator">
                <p>
                    <?php
if(have_posts()) : 

while(have_posts()) : the_post();

	the_content();
endwhile;
endif; ?></p>
            </div>
        </div>
		</div>
	</div>
</section>
<?php get_footer(); ?>