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

<table class="table table-bordered table-striped table-hover" id="list_view_tbl">
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
		<tr class="tbody_tr">
			<td><?= $im; ?></td>
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
				    <figure> <a href="" data-toggle="modal" data-target="#image_modal<?= $im;?>"><?php the_post_thumbnail( array( 50, 50 ) , array('class' => 'post-thumbnail-mains')); ?></a> </figure>
				<?php }
				?>
			</td>
		</tr>
	
<!-- Image Modal -->
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
		<?php $im++; endwhile;endif; ?>
	</tbody>
</table>


<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
    $('#list_view_tbl').DataTable();
} );
</script>

