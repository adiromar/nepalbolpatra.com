<?php /* Template Name: Single Posts Tenders */

get_header(); ?>

<div class="container" style="margin-top:100px;min-height: 250px; ">
	<div class="row">
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		$post_id = get_the_ID();
		$title = ucwords(get_the_title()); 
		$category = wp_get_post_terms( $post_id, 'category');
$cc = count($category);
$cnames = array();
for ($i=0; $i < $cc; $i++) { 
	$cname = $category[$i]->name;
	$cnames[] = $cname;
}
$cat_names = implode(', ', $cnames);

$prod = wp_get_post_terms( $post_id, 'products');
$pc = count($prod);
$pnames = array();
for ($i=0; $i < $pc; $i++) { 
	$pname = $prod[$i]->name;
	$pnames[] = $pname;
}
$pro_names = implode(', ', $pnames);

$ind = wp_get_post_terms( $post_id, 'industries'); 
$ic = count($ind);
$inames = array();
for ($i=0; $i < $ic; $i++) { 
	$iname = $ind[$i]->name;
	$inames[] = $iname;
}
$ind_names = implode(', ', $inames);

$papers = wp_get_post_terms( $post_id, 'newspapers'); 
$papc = count($papers);
$ppnames = array();
for ($i=0; $i < $papc; $i++) { 
	$papname = $papers[$i]->name;
	$ppnames[] = $papname;
}
$paper_names = implode(', ', $ppnames);

$publisher = get_post_meta( $post_id, 'publisher' , true );
$published_date = get_post_meta( $post_id, 'published_date' , true );
$p_date = get_post_meta( $post_id, 'submission_date_eng' , true );
$expiry = get_post_meta( $post_id, 'expiry_date' , true );

$today = new DateTime(date("Y-m-j"));
$sd = DateTime::createFromFormat( "Y-m-j", $p_date )->settime(0,0);
$diff = $today->diff($sd)->format("%R%a");
		?>
		<h4 style="text-align: center;"><b><?= $title ?></b></h4>
		<table class="table table-bordered">
			<tr>
				<th width="40%"><b>Description </b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td width="58%" align="left"><?= the_content(); ?></td>
			</tr>
		    <tr>
				<th><b>Published Date: </b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td align="left"><?= $published_date ?></td>
			</tr>
			<tr>
				<th><b>Last Submission Date: </b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td align="left"><?= $expiry ?></td>
			</tr>
			<tr>
				<th><b>Expired In: </b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td align="left"><?php
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
			</tr>
			<tr>
				<th><b>Notice Publisher:</b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td width="55%" align="left"><?= $publisher ?></td>
			</tr>
			<tr>
				<th><b>Category Type:</b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td align="left"><?= $cat_names ?></td>
			</tr>
			<tr>
				<th><b>Product/Services:</b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td align="left"><?= $pro_names ?></td>
			</tr>
			<tr>
				<th><b>Industry:</b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td align="left"><?= $ind_names ?></td>
			</tr>
			<tr>
				<th><b>Newspaper:</b></th>
				<td width="2%"><i class="fa fa-arrow-right"></i></td>
				<td align="left"><?= $paper_names ?></td>
			</tr> 
		</table>

		<div class="col-md-12">
			<a href="#" class="pop">
		<?php the_post_thumbnail('medium-large', ['class' => 'img-responsive']) ;?>
			</a>
		</div>
		<?php endwhile; endif; ?>
	</div>
</div>
<style type="text/css">
	div a img{
		margin: 0 auto;
	}
	th {
		width: 250px !important;
	}

	th b{
		color: #411dd9;
    	font-weight: 700;
	}
</style>

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

<script type="text/javascript">
	$(function() {
		$('.pop').on('click', function() {
			$('.tender_image_preview').attr('src', $(this).find('img').attr('src'));

      $('.modal-title').text($(this).find('img').attr('alt'));

      $('#OpenInNew').attr('href', $(this).find('img').attr('src'));

			$('#imagemodal').modal('show');
		});
  });
</script>
<?php get_footer(); ?>

