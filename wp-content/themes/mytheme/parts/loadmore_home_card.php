<style type="text/css">
.pgn{
	margin: 0 auto;
	text-align: center;
}
.pgn-list{
	list-style: none;
	display: inline-flex;
}
.pgn-list  li{
	list-style: none;
	margin: 0 auto;
	background: #17a2b8;
    /* color: #fff; */
    padding: 5px;
    margin-right: 5px;
}
.pgn-list li a{
	color: #fff;
}
.pgn-list li .active_li > .pgn-list li{
	background-color: green;
}
</style>


<?php
$post_count = $cat_posts->post_count;


if ( $cat_posts->have_posts() ) : while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
    	$cat_id = get_the_ID();
		$cat_names = $paper_names = $ind_names = $published_date = $expiry = '-';
				
		$category = wp_get_post_terms( $cat_id, 'category');
		$cc = count($category);
		$cnames = array();
		for ($i=0; $i < $cc; $i++) { 
			$cname = $category[$i]->name;
			$cnames[] = $cname;
		}
		$cat_names = implode(', ', $cnames);

		$papers = wp_get_post_terms( $cat_id, 'newspapers'); 
		// print_r($papers);
		$papc = count($papers);
		$ppnames = array();
		for ($i=0; $i < $papc; $i++) { 
			$papname = $papers[$i]->name;
			$ppnames[] = $papname;
		}
		$paper_names = implode(', ', $ppnames);

		$ind = wp_get_post_terms( $cat_id, 'industries'); 
		$ic = count($ind);
		$inames = array();
		for ($i=0; $i < $ic; $i++) { 
			$iname = $ind[$i]->name;
			$inames[] = $iname;
		}
		$ind_names = implode(', ', $inames);

		$prod = wp_get_post_terms( $cat_id, 'products');
		$pc = count($prod);
		$pnames = array();
		for ($i=0; $i < $pc; $i++) { 
			$pname = $prod[$i]->name;
			$pnames[] = $pname;
		}
		$pro_names = implode(', ', $pnames);

		$publisher = get_post_meta( $cat_id, 'publisher' , true );
		$published_date = get_post_meta( $cat_id, 'published_date' , true );
		$p_date = get_post_meta( $cat_id, 'submission_date_eng' , true );
		$expiry = get_post_meta( $cat_id, 'expiry_date' , true );

		$today = new DateTime(date("Y-m-j"));
		if($p_date){
	        $sd = DateTime::createFromFormat( "Y-m-d", $p_date )->settime(0,0);
	        $diff = $today->diff($sd)->format("%R%a");
		} ?>

<div class="col-md-4 col-sm-12 cardss mt-3 mb-3 posts my-posts pb-3" style="border-bottom: 1px solid darkgrey;" id="container">
				<div class="row">
				<div class="col-md-4 col-sm-12">
					<?php if (has_post_thumbnail()) : 
							if( is_user_logged_in() ) : 
						?>
					<!-- <figure> <a href="" data-toggle="modal" data-target="#image_modalm<?= $imm;?>"><?php the_post_thumbnail(array( 80, 80 ) , array('class' => 'post-thumbnail-main')); ?></a> </figure> -->
					<figure> <a href="#outer1" class="btn_clk" data-img="<?= $cat_id; ?>"><?php the_post_thumbnail(array( 80, 80 ) , array('class' => 'post-thumbnail-main')); ?></a> </figure>
					<?php else: ?>
						<figure> <a href="#outer1" class="btn_clk" data-img="<?= $cat_id?>"><?php the_post_thumbnail(array( 80, 80 ) , array('class' => 'post-thumbnail-main')); ?></a> </figure>
					<?php endif; ?>

				<?php else:
					if( is_user_logged_in() ) : 
						echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main mb-3" width="80" height="80">';
					else:
						echo '<a href="#" data-toggle="modal" data-target="#login_Modal"><img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main mb-3" width="80" height="80"></a>';
					endif;
				endif; 

				if( is_user_logged_in() ) : 
					// echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-sm">View Notice</a>';
				else:
					// echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#login_Modal">View Notice</a>';
				endif;
				?>

				<!-- <a href="<?= the_permalink(); ?>" class="btn btn-primary btn-sm"><u>View Notice</u></a> -->
				</div>
			
				<div class="col-md-8 col-sm-12">
					<div class="row">
						<div class="col-md-12 col-sm-12">
						<?php 
						if( !is_user_logged_in() ) : ?>
						<h5><a href="#" data-toggle="modal" data-target="#login_Modal" class="hr-btn"><?= the_title(); ?></a></h5>
						<?php else: ?>
							<h5><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></h5>
						<?php endif; ?>

						</div>
						<div class="col-md-12">
							<small><?php //echo mb_strimwidth(get_the_content(), 0, 40, '...'); ?></small>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12" style="overflow: hidden;">
							<div class="row">
						<div class="col-md-12 col-sm-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-address-card "></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($publisher, 0, 25, '...'); ?></span></span>	
						</p></div>

						<div class="col-md-12 col-sm-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-list-ul "></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($cat_names, 0, 25, '...'); ?></span></span>	
						</p></div>
						<div class="col-md-12 col-sm-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-paper-plane"></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($paper_names, 0, 25, '...'); ?></span></span>	
						</p></div>

						<div class="col-md-12 col-sm-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-calendar"></i></span>
							<span class="ml-4 float-left"><span><?= $published_date; ?></span></span>	
						</p></div>

						<div class="col-md-12 col-sm-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-hourglass-end" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span>
							<?php
							if( $diff >= 0){
							switch ( substr( $diff, 1 ) ) {
								case 0:
									echo 'Ending Today';
									break;

								case 1:
									echo substr( $diff, 1 ) . ' day';
									break;

								default:
									echo substr( $diff, 1 ) . ' days';
									break;
								}
							} else {
								echo "<span style='color:red'>Expired</span>";
							} ?>
							</span></span>	
						</p></div>

					</div>
					</div>

					</div> <!-- main row -->
				</div>
				</div>
			</div> 
    <?php endwhile; endif; 

    $next = $paged + 1;
    $previous = $paged - 1;


// if($post_count >= 12 ) :
echo '<div class="col-md-12">';
    echo '<div class="pgn">';
    	if($paged == 1){
    		echo '<ul class="pgn-list">';
    			// echo '<li><a href="#" class="more_posts" data-id="0">Previous</a></li>';
    		if($post_count >= 3 ) :
    			echo '<li><a href="#" class="more_posts" data-id="2">Next</a></li>';
    		endif;
    		echo '</ul>';
    	}elseif($paged){
			echo '<ul class="pgn-list">';

			if ( $cat_posts->have_posts() ) : 
				echo '<li><a href="#" class="more_posts" data-id="1"><</a></li>';

				echo '<li><a href="#" class="more_posts" data-id="'.$previous.'">Previous</a></li>';
				echo '<li><a href="#" class="more_posts active_li" data-id="'.$paged.'">'.$paged.'</a></li>';

				if($post_count >= 3 ) :
    			echo '<li><a href="#" class="more_posts" data-id="'.$next.'">Next</a></li>';
    			endif;
    		else:
    			echo '<li><a href="#" class="more_posts" data-id="1"><</a></li>';
				echo '<li><a href="#" class="more_posts" data-id="'.$previous.'">Previous</a></li>';

    		endif;

    		echo '</ul>';
    	}
    echo '</div>';
echo '</div>';
// endif;

	?>
	