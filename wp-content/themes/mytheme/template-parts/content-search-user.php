<?php  
$date = date("Y-m-d");
if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	$role = $user->roles[0];

	if( is_super_admin() || $role == 'Editor' || $role == 'Subscriber' || $role == 'Contributor') : 
		// super admin
		$max = '-1';
		$paging = $info = 'true';
		$comp = '>=';
	else:
		// subscriber, contributor, author, etc
		$t = get_user_meta($user_id);
		$subs = $t['user_type'][0];		

		$exp_date = $t['expiration_date'][0];

		if($subs == 'paid'){
			$max = '-1';
			$paging = $info = 'true';
			$comp = '>=';
		}elseif($subs == 'trial'){
			$max = '-1';
			$paging = $info = 'true';
			$comp = '>=';
		}else{
			$max = '10';
			$paging = $info = 'false';
			$comp = '>=';
		}
	endif;
else:
	$max = '10';
	$paging = $info = 'false';
	$comp = '<=';
endif;

$tax = '';
        if(isset($_GET['s'])) : 
        	$search=$_GET['s'];
        	// $tax=$_GET['tax'];

        	$argss = array(  
        		// 'taxonomy'      => array( $tax ),
    			's' => $search,
    			'post_type' => 'post',
    			'post_status' => 'publish',
    			'posts_per_page' => 20,
    			'meta_query' => array(
			        array(
			            'key' => 'submission_date_eng',
			            'value' => $date,
			            'type' => 'DATE',
						'compare' => $comp,
			        	)		    		
		 			)	
    			// 'tax_query' => array(
       //              array(
       //                  'taxonomy' => $tax,
       //                  'field' => 'title',
       //                  // 'terms' => $search
       //              )
       //           )
			); 
   //      	echo '<pre>';
			// print_r($argss);

			?>

			<div class="row">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#search_list_view" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list"></i> </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="home-tab2" data-toggle="tab" href="#search_card_view" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-th-large"></i> </a>
				  </li>
			</ul>
			</div>
			
		<div class="row card tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="search_list_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="row p-3">

						<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
						<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<style type="text/css">
	.list_view_tr th{
		font-size: 14px;
		font-weight: 500;
	}
	.tbody_tr td{
		font-size: 12px !important;
		font-weight: 600;
	}
</style>
					<table class="table table-bordered table-striped table-hover" id="s_list_view_tbl">
					<thead>
						<tr class="list_view_tr">
							<th>#</th>
							<th>Notice Publisher</th>
							<th>Description</th>
							<th>Published Date</th>
							<th>Last Date Of Submission</th>
							<th>Notice Category</th>
							<th>Newspaper</th>
							<th>Industry</th>

							<th>Expiry</th>
							<th>Image</th>
						</tr>
					</thead>
					<tbody>
<?php


        $sn = 1;
		$query = new WP_Query( $argss );
		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

			$cat_id = get_the_ID();

			$category = wp_get_post_terms( $cat_id, 'category');
			$cc = count($category);
			$cnames = array();
			for ($i=0; $i < $cc; $i++) { 
				$cname = $category[$i]->name;
				$cnames[] = $cname;
			}
			$cat_names = implode(', ', $cnames);

			$papers = wp_get_post_terms( $cat_id, 'newspapers'); 
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
					<?php
					// echo "list view";
					//get_template_part( 'template-parts/content', 'home-list' );
					?>
<tr class="tbody_tr">
			<td><?= $sn; ?></td>
			<td><?= $publisher ?></td>
			<td ><a href="<?= the_permalink(); ?>" data-toggle="tooltip" title="<?= get_the_title()?>"><?= mb_strimwidth(get_the_title(), 0, 25, '...'); ?></a></td>
			<td><?= $published_date ?></td>
			<td><?= $expiry ?></td>

			<td><?= $cat_names ?></td>
			<td><?= $paper_names ?></td>
			<td><?= $ind_names ?></td>
			<td width="">
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
			}
			?>
			</td>
			<td>
				<?php
				if ( has_post_thumbnail() ) { ?>
				    <!-- <figure> <a href="" data-toggle="modal" data-target="#image_modal_list<?= $im;?>"><?php the_post_thumbnail( array( 50, 50 ) , array('class' => 'post-thumbnail-mains')); ?></a> </figure> -->
				    <figure><a class="btn_clk" data-img="<?= $cat_id; ?>" ><?php the_post_thumbnail( array( 50, 50 ) , array('class' => 'post-thumbnail-mains')); ?></a></figure>
				<?php }
				?>
			</td>
		</tr>
		<?php 
		$sn++; 
	endwhile; else : ?>

	<div class="col-md-12 card mb-3 p-3">
			<p>Sorry Nothing found related to '<?php echo $search ;?>'.</p>
			</div>
		<?php endif; ?>
					</tbody>
					</table>

<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
    $('#s_list_view_tbl').DataTable({
    	"paging":   <?= $paging; ?>,
        "ordering": true,
        "info":     <?= $info; ?>
    });
} );
</script>

					</div>
				</div>

				<div class="tab-pane fade" id="search_card_view" role="tabpanel" aria-labelledby="home-tab1">
					<div class="row p-3">
					<?php


        $sn = 1;
		$query = new WP_Query( $argss );
		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

			$cat_id = get_the_ID();

			$category = wp_get_post_terms( $cat_id, 'category');
			$cc = count($category);
			$cnames = array();
			for ($i=0; $i < $cc; $i++) { 
				$cname = $category[$i]->name;
				$cnames[] = $cname;
			}
			$cat_names = implode(', ', $cnames);

			$papers = wp_get_post_terms( $cat_id, 'newspapers'); 
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

		<div class="col-md-4 col-sm cardss mt-3 mb-3 posts pb-3" style="border-bottom: 1px solid darkgrey;">
				<div class="row">
				<div class="col-md-4 col-sm-4">
					<?php if (has_post_thumbnail()) : 
						?>
					<figure><a class="btn_clk" data-img="<?= $cat_id; ?>" ><?php the_post_thumbnail( array( 80, 80 ) , array('class' => 'post-thumbnail-mains')); ?></a></figure>
				<?php else:
						echo '<img src="'.get_template_directory_uri().'/img/unnamed.png" class="post-thumbnail-main mb-3" width="80" height="80">';
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

					</div> <!-- main row -->
					
				</div>
			
				</div>
			</div> 
<?php 
// echo do_shortcode('[ajax_load_more post_type="post, page, portfolio" search="'. $term .'" orderby="relevance" posts_per_page="4" scroll="true" css_classes="plain-text" button_label="Show More Results"]');
endwhile;else: ?>
<div class="col-md-12 card mb-3 p-3">
	<p>Sorry Nothing found related to '<?php echo $search ;?>'.</p>
</div>
<?php endif;

echo do_shortcode('[ajax_load_more post_type="post, page" search="'. $_GET['s'] .'" orderby="relevance" posts_per_page="4" scroll="true" css_classes="plain-text" button_label="Show More Results"]');

// pagination
		if( is_super_admin() || $role == 'author' || $role == 'contributor' || $role == 'editor') : 
				echo '<div class="col-md-12 mt-3 pb-3" style="text-align: center;">';
					wpbeginner_numeric_posts_nav();

				echo '</div>';
		endif;
		if ($user) :
			if($subs == 'paid') :
				echo '<div class="col-md-12 mt-3 pb-3" style="text-align: center;">';
					wpbeginner_numeric_posts_nav();
				echo '</div>';
			elseif($subs == 'trial') :
				// nothing
				echo '<div class="col-md-12 mt-3 pb-3" style="text-align: center;">';
					wpbeginner_numeric_posts_nav();
				echo '</div>';
			else:
				// nothing
				
			endif;
				
		else:
			// nothing
		endif; ?>

					</div>
				</div>
			</div>

		<?php endif; ?>