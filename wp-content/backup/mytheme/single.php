<?php
 get_header(); 

$post_id = get_the_ID();
$cat = get_the_category();
 ?>

<style type="text/css">
	th{
		font-weight: 600;
	}
	.brd-crm span{
		font-size: 14px;
		color: var(--blue);
	}
</style>
<section class="hero-section-1 main-pg-section">

	<div class="containersss">
		<div class="card p-4">
			<div class="row ml-5 brd-crm">
				<spam><a href="<?= home_url(); ?>">Home</a></span> /
					<span><?= $cat[0]->name; ?></span> /
					<span><?= get_the_title(); ?></span>
			</div>
		</div>
	</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
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

<div class="container card mt-4" style="min-height: 200px;">
	<div class="row mt-4 mb-4">
		<div class="col-md-12 col-sm">

						<h4><?= the_title(); ?></h4>
			<hr>
			<div class="mt-3 mb-4">
				<h6><b>Specification:</b></h6>
				<table class="table table-hover table-striped" style="line-height: 0.7rem;">
					<tr>
						<th width="5%"><i class="fa fa-list-ul"></i></th>
						<th width="40%">Category</th>
						<td width="5%">:</td>
						<td width="50%"><?= $cat_names; ?></td>
					</tr>
					<?php if($paper_names){ ?>
					<tr>
						<th width="5%"><i class="fa fa-paper-plane"></i></th>
						<th width="40%">Newspaper</th>
						<td width="5%">:</td>
						<td width="50%"><?= $paper_names; ?></td>
					</tr>
					<?php }if($pro_names){ ?>
					<tr>
						<th width="5%"><i class="fa fa-list"></i></th>
						<th width="40%">Products</th>
						<td width="5%">:</td>
						<td width="50%"><?= $pro_names; ?></td>
					</tr>
				<?php }if($ind_names){ ?>
					<tr>
						<th width="5%"><i class="fa fa-building"></i></th>
						<th width="40%">Industry</th>
						<td width="5%">:</td>
						<td width="50%"><?= $ind_names; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<th width="5%"><i class="fa fa-address-card"></i></th>
						<th width="40%">Publisher</th>
						<td width="5%">:</td>
						<td width="50%"><?= $publisher; ?></td>
					</tr>
					<tr>
						<th width="5%"><i class="fa fa-calendar"></i></th>
						<th width="40%">Published Date</th>
						<td width="5%">:</td>
						<td width="50%"><?= $published_date; ?></td>
					</tr>
					<tr>
						<th width="5%"><i class="fa fa-calendar fa-red"></i></th>
						<th width="40%">Expiry Date</th>
						<td width="5%">:</td>
						<td width="50%"><?= $expiry; ?></td>
					</tr>
					<tr>
						<th width="5%"><i class="fa fa-hourglass-end fa-red"></i></th>
						<th width="40%">Days Remaining</th>
						<td width="5%">:</td>
						<td width="50%"><?php
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
						?></td>
					</tr>
				</table>
			</div>
			<?php
			if ( has_post_thumbnail() ) {
			    the_post_thumbnail( 'medium_large' );
			}

			?>
		</div>
		
		<div class="col-md-12 col-sm">
			<?= the_content(); ?>
		</div>
		

	</div>
</div>


<?php endwhile; 
else :
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );

    endif; ?>

</section>
<?php get_footer(); ?>