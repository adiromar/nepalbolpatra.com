<?php 
if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	$role = $user->roles[0];

	if( is_super_admin() || $role == 'Editor' || $role == 'Subscriber' || $role == 'Contributor') : 
		// super admin
		$max = '10';
	else:
		// subscriber, contributor, author, etc
		$t = get_user_meta($user_id);
		$subs = $t['user_type'][0];		

		$exp_date = $t['expiration_date'][0];

		if($subs == 'paid'){
			$max = '10';
		}elseif($subs == 'trial'){
			$max = '10';
		}else{
			$max = '6';
		}
	endif;
else:
	$max = '6';
endif;

			// query argument
			$date = date("Y-m-d");
			$args = array (
					    // 'cat' => array(),
					    'orderby' => 'meta_value_num',
					    'order' => 'ASC',
					    'posts_per_page' => $max,
					    'meta_query' => array(
					        array(
					            'key' => 'submission_date_eng',
					            'value' => $date,
					            'type' => 'DATE',
								'compare' => '<=',
					        	)		    		
				 			)					    		
					 	);
			$cat_posts= new WP_query($args);

			// echo '<pre>';
			// 	print_r($cat_posts);
			// echo '</pre>';
			$imm = 1;
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
			}
			?>
			
<!-- style="border: 1px dashed grey;border-radius: 12px;" -->
			<div class="col-md-4 col-sm cardss mt-3 mb-3 posts my-posts pb-3" style="border-bottom: 1px solid darkgrey;" id="container">
				<div class="row">
				<div class="col-md-4 col-sm-4">
					<?php if (has_post_thumbnail()) : 
							if( is_user_logged_in() ) : 
						?>
					<!-- <figure> <a href="" data-toggle="modal" data-target="#image_modalm<?= $imm;?>"><?php the_post_thumbnail(array( 80, 80 ) , array('class' => 'post-thumbnail-main')); ?></a> </figure> -->
					<figure> <a href="#" class="btn_clk" data-img="<?= $cat_id; ?>"><?php the_post_thumbnail(array( 80, 80 ) , array('class' => 'post-thumbnail-main')); ?></a> </figure>
					<?php else: ?>
						<figure> <a href="#" class="btn_clk" data-id="<?= $cat_id?>"><?php the_post_thumbnail(array( 80, 80 ) , array('class' => 'post-thumbnail-main')); ?></a> </figure>
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
			
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
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
						<div class="col-md-12" style="overflow: hidden;">
							<div class="row">
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-address-card "></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($publisher, 0, 25, '...'); ?></span></span>	
						</p></div>

						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-list-ul "></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($cat_names, 0, 25, '...'); ?></span></span>	
						</p></div>
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-paper-plane"></i></span>
							<span class="ml-4 float-left"><span><?= mb_strimwidth($paper_names, 0, 25, '...'); ?></span></span>	
						</p></div>

						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-calendar"></i></span>
							<span class="ml-4 float-left"><span><?= $published_date; ?></span></span>	
						</p></div>
						<!-- <div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-calendar" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span><?= $expiry; ?></span></span>	
						</p></div> -->

						<div class="col-md-12">
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
<!-- <div class="col-md-6" style="border-left: 1px dashed lightgrey;text-align: justify;">
	<?php //echo mb_strimwidth(get_the_content(), 0, 110, '...'); ?>
</div> -->

<!-- Modal -->
<div class="modal fade" id="image_modalm<?= $imm;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= the_title(); ?></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php
        if ( has_post_thumbnail() ) {
				    the_post_thumbnail( 'full' );
				}else{
					echo "No Image Found";
				}

				?>


      </div>
    </div>
  </div>
</div>

<!-- <?php if (current_user_can('administrator')) 
{
edit_post_link( esc_html__( 'Edit', 'oria' ), '<span class="edit-link">', '</span>' ); 
} ?> -->
					</div> <!-- main row -->
					
				</div>
			
			
				</div>
			</div> 

		<?php 

// echo do_shortcode('[ajax_load_more repeater="" post_type="post, ajax_more" transition="fade" transition_speed="350" images_loaded="true" preloaded="true" preloaded_amount="4" posts_per_page="4" pause="true" pause_override="true" css_classes="flex"]');


		$imm++; endwhile;endif; 

// misha_paginator( get_pagenum_link() );
// echo '<a href="#" class="more_posts">Load More</a>';

		?>


<style type="text/css">
	#custom-alm-loader{
   opacity: 0;
   display: none;
   width: 100%;
   padding: 50px;
   margin: 0 0 20px;
   background: #fff;
   border: 2px dashed #ccc;
   background: url("img/ajax-loader.gif") no-repeat center center;
   transition: all 0.1s ease;
}
   .alm-loading #custom-alm-loader{
      display: block;
      opacity: 1;
   }
</style>

<script type="text/javascript">
jQuery(document).ready(function($){
			$('#load_more').click(function(e){ // <- added
        e.preventDefault(); // <- added to prevent normal form submission

        var postoffset = $('.post').length;
		var postoffset = 2;

        var values = {
            'post_id' : val
        };

        $.ajax({
			url:'wpa56343_more',
			data:, postoffset// form data
			type:'POST', // POST
			// format: 'json';
			
			success:function(data){
				$('#container').append( data );
			}


			});

        // $.post(
        //     WPaAjax.ajaxurl,
        //     {
        //         action : 'wpa56343_more',
        //         postoffset : postoffset
        //     },
        //     function( response ) {
        //         $('#container').append( response );
        //     }
        // );

    });
			});

jQuery(function($){
	// we will remove the button and load its new copy with AJAX, that's why $('body').on()
	$('body').on('click', '#misha_loadmore', function(){
		$.ajax({
			url : misha_loadmore_params.ajaxurl,
			data : {
				'action': 'loadmore',
				'query': misha_loadmore_params.posts,
				'page' : misha_loadmore_params.current_page,
				'first_page' : misha_loadmore_params.first_page // here is the new parameter
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				$('#misha_loadmore').text('Loading...'); 
			},
			success : function( data ){
 
				$('#misha_loadmore').remove(); // remove button
				$('#misha_pagination').before(data).remove(); // add new posts and remove pagination links
				misha_loadmore_params.current_page++;
 
 
			}
		});
		return false;
	});
});


// var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
//     var page = 1; // What page we are on.
//     jquery(function($){
//     	$(window).scroll(function(){
//     		if($(window).scroll() == $(document).height() - $(document).height()) {

//     			alert('scroll');
//     			var data = {
//     				'action': 'load_posts_by_ajax',
//     				'page': page,
//     				'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
//     			};

//     			$.post(ajaxUrl, data, function()response){
//     				$('.my-posts').append(response);
//     				page++;
//     			}
//     		}
//     	});
//     });
</script>

		