<?php /* Template Name: Show Tenders */

get_header();

// $paged = get_query_var('paged');


if(isset($_GET['cat'])){
$filter_string = $_GET['cat'];
}
else{
    $filter_string='';
}

$filter_array = explode( ",", $filter_string );
$filter_arg = '\'' . implode( $filter_array, '\' , \'' ) . '\'';

$grp = explode(',', $filter_string);

if( $filter_string )
{
  $args = array(
'post_type'=> 'post',
  'tax_query' => array( 
	array(
      'taxonomy' => 'products',
      'field' => 'slug',
      'terms' => $grp, 
      'include_children' => true
    )
  )
);

$the_query = new WP_Query( $args );

} else {
$paged = get_query_var('paged');
  $args = array(
'post_type'=> 'post',
'orderby'    => 'ID',
'post_status' => 'publish',
'order'    => 'DESC',
'posts_per_page' => 20,
'paged' => $paged,
);

$the_query = new WP_Query( $args );
}
?>

<style type="text/css">
	.pop img{
		width: 50px;
		height: 55px;
	}
</style>
<!-- Modal -->
<div class="modal bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        <h5 class="modal-title" id="ModalLongTitle"></h5>
      </div>
      <div class="modal-body">
          
        <img src="" class="tender_image_preview" style="width: 100%;" > 
       
        
      </div>
      <div class="modal-footer">
        <a id="OpenInNew" href="" target="_blank"><button type="button" class="btn btn-primary">Open in New Tab</button></a>
        
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!--
  ====================================
    END MODAL
  ====================================
-->

<div class="container" style="margin-top:50px; ">
<marquee style="color:green; margin-top: 10px;">Update interest fields in your profile to get the regular email notifications related to your interest.
</marquee>

<div class="row">
	<?php
	$terms = get_terms( array(
    'taxonomy' => 'products',
    'hide_empty' => false,
) );
    // echo '<pre>';
    // print_r($terms);

	?>

	 <h5>Filter By Category:</h5>
    <div class="col-md-2 col-sm-1"></div>
    <ul class="col-md-10 col-sm-3" style="font-size:12px; list-style:none;">
      <div class="form-check form-check-inline">
        <?php         
        foreach($terms as $data) { ?>
        
    <label class="form-check-label">
      <input type="checkbox" name="category" value="<?php echo $data->slug;?>" <?php  if( in_array( $data->slug, $filter_array ) ) { echo "checked"; } ?>>
      &nbsp;<?php echo $data->name;?>&nbsp;
    </label>
      <?php
      }
      ?>
    </div>
   </ul>
<a id="filter" href="#">
  <button class="btn btn-outline-primary btn-sm" style="margin-left: 88px;">Filter Result</button>
</a>
</div>

<table class="table table-striped table-border table-hover" id="example">
	<thead>
		<tr>
			<th>S.N.</th>
			<th>Publisher</th>
			<th>Title</th>
			<th>Category</th>
			<th>Products</th>
			<th>Industries</th>
			<th>Newspapers</th>
			<th>Published Date</th>
			<th>Expiry</th>
			<th>Days Remaining</th>
			<th>Image</th>
		</tr>
	</thead>	
	<tbody>
<?php $ij = 1; 

if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
$cat_id = get_the_ID();
// $cat_name = get_cat_name( $cat_id );

// $category = get_the_term_list( $cat_id, 'category', '', ', ' ); 
$category = wp_get_post_terms( $cat_id, 'category');

$cc = count($category);
$cnames = array();
for ($i=0; $i < $cc; $i++) { 
	$cname = $category[$i]->name;
	$cnames[] = $cname;
}
$cat_names = implode(', ', $cnames);

$prod = wp_get_post_terms( $cat_id, 'products');
$pc = count($prod);
$pnames = array();
for ($i=0; $i < $pc; $i++) { 
	$pname = $prod[$i]->name;
	$pnames[] = $pname;
}
$pro_names = implode(', ', $pnames);

$ind = wp_get_post_terms( $cat_id, 'industries'); 
$ic = count($ind);
$inames = array();
for ($i=0; $i < $ic; $i++) { 
	$iname = $ind[$i]->name;
	$inames[] = $iname;
}
$ind_names = implode(', ', $inames);

$papers = wp_get_post_terms( $cat_id, 'newspapers'); 
$papc = count($papers);
$ppnames = array();
for ($i=0; $i < $papc; $i++) { 
	$papname = $papers[$i]->name;
	$ppnames[] = $papname;
}
$paper_names = implode(', ', $ppnames);

$publisher = get_post_meta( $cat_id, 'publisher' , true );
$published_date = get_post_meta( $cat_id, 'published_date' , true );
$p_date = get_post_meta( $cat_id, 'submission_date_eng' , true );
$expiry = get_post_meta( $cat_id, 'expiry_date' , true );

$today = new DateTime(date("Y-m-j"));
$sd = DateTime::createFromFormat( "Y-m-j", $p_date )->settime(0,0);

$diff = $today->diff($sd)->format("%R%a");
?>
	<tr>
		<td><?= $ij ?></td>
		<td><?= $publisher ?></td>
		<th><a href="<?= the_permalink() ?>"><?= get_the_title(); ?></th>
		<th><?= $cat_names ?></th>
		<th><?= $pro_names ?></th>
		<td><?= $ind_names ?></td>
		<td><?= $paper_names ?></td>
		<td><?= $published_date ?></td>
		<td><?= $expiry ?></td>
		<td><?php
			if( $diff >= 0)
									{
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
										echo "<p style='color:red'>Expired</p>";
									}
		 ?></td>
		<th><a href="#" class="pop"><?php the_post_thumbnail('medium-large', ['class' => 'img-responsive']) ;?></a></th>
		<th></th>
	</tr>
<?php $ij++; endwhile; endif; ?>
</tbody>
</table>
<?php echo '<p style="color:red; padding: 5px; font-size: 16px; text-align:center; margin-top: 20px;">' . paginate_links(array('total'=> $the_query->max_num_pages)); ?>
          <?php wp_reset_postdata(); ?>
</div>

<script type="text/javascript">
	$("input[type=checkbox][name=category]").on("change", function() {
    var arr = [];
    $(":checkbox").each(function() {
      if ($(this).is(":checked")) {

        arr.push($(this).val());
      }
    });

    var vals = arr.join(",");
    var str = "<?php echo site_url(); ?>/show-tenders/?cat=" + vals;
    console.log(str);

    if (vals.length > 0) {
      $("#filter").attr("href", str);
    } else {
      $("#filter").attr("href", "<?php echo site_url(); ?>/show-tenders");
    }
  });

	/*Picture in Modal View*/
  $(function() {
		$('.pop').on('click', function() {
			$('.tender_image_preview').attr('src', $(this).find('img').attr('src'));
console.log($(this).find('img').attr('src'));

      $('.modal-title').text($(this).find('img').attr('alt'));

      $('#OpenInNew').attr('href', $(this).find('img').attr('src'));

			$('#imagemodal').modal('show');
		});
  });
</script>

<?php get_footer();
?>
