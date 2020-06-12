<?php /* Template Name: SHOW TABLE */
 if(is_user_logged_in())
{if( current_user_can('subscriber'))
  {
    $subsc_left_calc = calc_user_subs( $current_user->{'ID'});
    if( $subsc_left_calc < 0 )
    {
      wp_redirect(home_url('?error=sub_expired'));
    }
  }
} else {
  wp_redirect(home_url('?action=login'));
}

get_header();
global $wpdb;

//get filter_by_category parameters; 'array' for checking checkboxes' values; 'arg' for DB's data
if(isset($_GET['cat'])){
$filter_string = $_GET['cat'];
}
else{
    $filter_string='';
}
$filter_array = explode( ",", $filter_string );
$filter_arg = '\'' . implode( $filter_array, '\' , \'' ) . '\'';

if( $filter_string )
{
  $query = "SELECT * FROM `wp_tender` WHERE `product` IN ( ${filter_arg} )";
} else {
  $query = "SELECT * FROM `wp_tender`";
}

// define(ROOTPATH, ABSPATH);

/*
  ====================================
    PAGINATION LOGIC
  ====================================
*/
$customPagHTML  = "";
$total_query    = "SELECT COUNT(1) FROM ( ${query} ) AS combined_table";
$total          = $wpdb->get_var( $total_query );
$items_per_page = 10;
$page           = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset         = ( $page * $items_per_page ) - $items_per_page;
$result         = $wpdb->get_results( $query . " ORDER BY `created_at` DESC LIMIT ${offset}, ${items_per_page}" );
$totalPage      = ceil( $total / $items_per_page );

if($totalPage > 1)
{
  $customPagHTML     =  ' <strong>Page ' . $page . ' of ' . $totalPage . '</strong></span>' . paginate_links( array(
      'base' => add_query_arg( 'cpage', '%#%' ),
      'format' => '',
      'prev_text' => __('Previous'),
      'next_text' => __('Next'),
      'total' => $totalPage,
      'current' => $page
    ));
}
/*
  ====================================
    END OF PAGINATION
  ====================================
*/
?>

<!--
  ====================================
    MODAL START
  ====================================
-->
<!-- Button trigger modal -->
<!-- <div class="bd-example">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Launch demo modal
  </button>
</div> -->

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
  
    <h5>Filter By Category:</h5>
    <div class="col-md-2 col-sm-1"></div>
    <ul class="col-md-10 col-sm-3" style="font-size:12px; list-style:none;">
      <div class="form-check form-check-inline">
        <?php 
        $res = $wpdb->get_results("SELECT * FROM wp_addproduct",ARRAY_A);
        
        foreach($res as $data)
        {
        ?>
        
    <label class="form-check-label">
      <input type="checkbox" name="category" value="<?php echo $data['product_name'];?>" <?php  if( in_array( $data['product_name'], $filter_array ) ) { echo "checked"; } ?> >
      &nbsp;<?php echo $data['product_name'];?>&nbsp;
    </label>
      <?php
      }
      ?>
    </div>
   </ul>
  </div>
</div><!-- endof container-->
<a id="filter" href="#">
  <button class="btn btn-outline-primary btn-sm" style="margin-left: 88px;">Filter Result</button>
</a>


<div class="table_content" style="margin-top:10px">
  <div class="container ">
    <div class="row">
      <div class='tender_table col-md-12'>

      <table class="table table-striped table-hover table-bordered table-condensed table-responsive">
        <thead >
          <tr>
            <th>SN.</th>
            <th style="min-width: 245px;">Notice Publisher</th>
            <th>Description</th>
            <th style="width:99px">Published Date</th>
    		    <th style="width:99px">Last date</th>
    		    <th style="width:85px;">Category</th>
    		    <th style="width:124px">Industry</th>
    		    <th style="width:">Product/Service</th>
            <th>Newspaper</th>
            <th style="width:72px">Days remaining</th>
    		    <th style="width:90px">Notice Image</th>
            <?php if( is_super_admin() ): ?>
              <th>Options</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody class="table_body">
        <?php
        get_template_part( 'DateConverter');
          if ( count( $result ) ) {
            $i = 1;
            $cc = '';
            foreach ( $result as $value_obj ) {
              $entry = (array) $value_obj;
          ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $entry['publisher'] ?></td>
                <td><?php echo $entry['description'] ?></td>
                <td><?php echo $entry['published_date'] ?></td>
                <td><?php echo $entry['submission_date'] ?></td>
                
                <td>
                  <?php
                    echo ucfirst( $entry['notice'] );
                  ?>
                </td>

                <td>
                  <?php
                    
                    echo $entry['industry'] ;
                  ?>
                </td>
                <td>                 
                 <?php                  
                  echo $entry['product'];
                  ?>                  
                </td>

                <td><?php echo $entry['newspaper'] ?></td>

                <td>
                  <?php
                  $convert = new DateConverter();
                  
                  $chars = preg_split('/(\d{4}-\d{2}-\d{2})/', $entry['submission'], null, PREG_SPLIT_DELIM_CAPTURE);
                  // $convert->setNepaliDate($chars[0] .',' .$chars[1] .','. $chars[2] );
// $convert = $convert->getEnglishYear()."-".$convert->getEnglishMonth()."-".$convert->getEnglishDate();

                  
                  if ($entry['submission_date_eng'] == null){
                    echo "-";
                  }else{
                    $today = new DateTime(date("Y-m-j"));
                  $sd = DateTime::createFromFormat( "Y-m-j", $entry['submission_date_eng'] )->settime(0,0);
                  $diff = $today->diff($sd)->format("%R%a");
                  // $now = time();
                  // $sub_date = strtotime($entry['submission_date_eng']);
                  // $diff = $now->diff($sub_date)->format("%R%a");
                  // echo $diff;
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
                }
                  ?>
                </td>
                <td style="overflow: hidden;">
                  <?php if( $entry['image'] ) { ?>
                    <a href="#" class="pop">
                      <img src="<?php echo wp_upload_dir()['baseurl'] . '/' . $entry['image'] ?>"
                        alt="<?php echo $entry['publisher'] ?>"
                        style="max-height: 100px; max-width: 50px; cursor: pointer;">
                    </a>
                  <?php } else { ?>
                    &nbsp;n/a
                  <?php } ?>
                </td>
                <?php if( is_super_admin() ): ?>
                <td>
                  <a href="<?php echo site_url();?>/edit-table/?tender_id=<?php echo $entry['id'] ?>">
                    <button type="button"  style="color:green"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>
                  </a>
                <br/>
                  <br/>
                  <a href="<?php echo site_url(); ?>/delete-table/?tender_id=<?php echo $entry['id'] ?>" onclick="return confirm('Are you sure you want to delete?');">
                  <button type="button" style="color:red"> <i class="fa fa-trash-o fa-lg"></i>Delete </button>
                  </a>
                 
                </td>
                <?php endif; ?>

              </tr>
          <?php }
        } else {
          echo "</table>";
          echo "There are no Tenders at the moment, move along";
        }
        ?>
      </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<nav align="center" style="background-color: grey;">
  <ul class="pagination pagination-sm">
    <li class="page-item" style="margin-left: 5px; margin-right: 10px;">
      <?php echo $customPagHTML; ?>
    </li>
  </ul>
</nav>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<script type="text/javascript">
/*RESULT Filter JQ*/
  $("input[type=checkbox][name=category]").on("change", function() {
    var arr = [];
    $(":checkbox").each(function() {
      if ($(this).is(":checked")) {
        arr.push($(this).val());
      }
    });
    var vals = arr.join(",");
    var str = "<?php echo site_url(); ?>/show-table/?cat=" + vals;
    console.log(str);

    if (vals.length > 0) {
      $("#filter").attr("href", str);
    } else {
      $("#filter").attr("href", "<?php echo site_url(); ?>/show-table");
    }
  });

/*Picture in Modal View*/
  $(function() {
		$('.pop').on('click', function() {
			$('.tender_image_preview').attr('src', $(this).find('img').attr('src'));

      $('.modal-title').text($(this).find('img').attr('alt'));

      $('#OpenInNew').attr('href', $(this).find('img').attr('src'));

			$('#imagemodal').modal('show');
		});
  });
</script>

<?php get_footer();
?>
