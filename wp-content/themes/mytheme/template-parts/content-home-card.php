<?php 
			$args = array (
					    'cat' => array(),
					    'orderby' => 'date',
					    'posts_per_page' => 6					    		
					 	);
			$cat_posts= new WP_query($args);

			// echo '<pre>';
			// 	print_r($cat_posts);
			// echo '</pre>';
			$im = 1;
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
			

			<div class="col-md-6 col-sm cardss mt-3 mb-3 posts p-3" style="border: 1px dashed grey;border-radius: 12px;">
				<div class="row">
				<div class="col-md-3 col-sm-4">
					<?php if (has_post_thumbnail()) : 
							if( is_user_logged_in() ) : 
						?>
					<figure> <a href="" data-toggle="modal" data-target="#image_modal<?= $im;?>"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
					<?php else: ?>
						<figure> <a href="#" data-toggle="modal" data-target="#login_Modal"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
					<?php endif; ?>

				<?php else:
					if( is_user_logged_in() ) : 
						echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main mb-3" width="200" height="150">';
					else:
						echo '<a href="#" data-toggle="modal" data-target="#login_Modal"><img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main mb-3" width="200" height="150"></a>';
					endif;
				endif; 

				if( is_user_logged_in() ) : 
					echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-sm">View Notice</a>';
				else:
					echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#login_Modal">View Notice</a>';
				endif;
				?>

				<!-- <a href="<?= the_permalink(); ?>" class="btn btn-primary btn-sm"><u>View Notice</u></a> -->
				</div>
			
				<div class="col-md-9">
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
						<div class="col-md-6" style="overflow: hidden;">
							<div class="row">

						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-list-ul "></i></span>
							<span class="ml-4 float-left"><span><?= wp_trim_words($cat_names, 15, '..') ?></span></span>	
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
						<div class="col-md-12">
						<p class="p_list">
							<span class="float-left"><i class="fa fa-calendar" style="color: red;"></i></span>
							<span class="ml-4 float-left"><span><?= $expiry; ?></span></span>	
						</p></div>

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
<div class="col-md-6" style="border-left: 1px dashed lightgrey;text-align: justify;">
	<?php echo mb_strimwidth(get_the_content(), 0, 110, '...'); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="image_modal<?= $im;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<?php if (current_user_can('administrator')) 
{
edit_post_link( esc_html__( 'Edit', 'oria' ), '<span class="edit-link">', '</span>' ); 
} ?>
					</div> <!-- main row -->
					
				</div>
			
			
				</div>
			</div> 

		<?php $im++; endwhile;endif; ?>