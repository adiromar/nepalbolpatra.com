<?php
// ob_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nepalbolpatra.com (<?php echo date("Y-m-j") ?>)</title>

    
<style type="text/css">
    .tender_table{
  margin-top: 30px;
}
.table th{
    text-align: center;
    font-size:12px;
    line-height: 20px;
    vertical-align: middle;
    display:table-cell;
    width: auto;

}
.table td{
    font-size:12px;
    line-height: 20px;
    width: auto;
}
tbody{
  text-align: center;
  background-color: #f9f9f9;
}
.table-condensed thead tr th{
    padding:4px 5px;

}
.table{
   text-align: center;

    font-size: 12px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.table_content{
  background: #f5f0f0;
  min-height: 600px;
  overflow: auto;

  margin-top: -30px;
}
.table-bordered{
  border-radius:5px;
}
</style>
  </head>
  <body>
  
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8"><a href="http://encoderslab.com/tendernepalvolcus/"><img src="<?php bloginfo('template_url'); ?>/attachment/banner.png" style="width: 100%; height: 170px;"></a></div>
    </div><hr>
    <div class="tender_table">
      <table class="table table-striped table-hover table-bordered table-condensed table-responsive" style="border: bold;">
        <thead>
          <tr class="first-row">
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">SN.</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Notice Publisher</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Description</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Published Date</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Last Submission date</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Notice Category</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Industry</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Product/ Service</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Newspaper</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">Day Left</th>
            <th style="padding:10px 0;border:1px solid #dddddd; border-top: 2px solid; border-bottom: 2px solid;">View Notice</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
          $kk = 1;
          if ( $cat_posts->have_posts() ) : while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
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
      $description = mb_strimwidth(get_the_content(), 0, 40, '...');

          echo '<tr>';
            echo '<td>'.$kk.'</td>';
            echo '<td>'.$publisher.'</td>';
            echo '<td>'.get_the_title().'</td>';

            echo '<td>'.$published_date.'</td>';
            echo '<td>'.$expiry.'</td>';
            echo '<td>'.$cat_names.'</td>';
            echo '<td>'.$ind_names.'</td>';

            echo '<td>'.$pro_names.'</td>';
            echo '<td>'.$paper_names.'</td>';
            // echo '<td>'.$diff.'</td>';
            ?>
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
            <td>
              <?php if (has_post_thumbnail()) : ?>
              <figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array( 70, 70 ) , array('class' => 'post-thumbnail-mains')); ?></a> </figure>
              <?php else: ?>
            <figure> <a href="#" data-toggle="modal" data-target="#login_Modal"><?php the_post_thumbnail('thumbnail', array('class' => 'post-thumbnail-main')); ?></a> </figure>
            <?php endif; ?>

            </td>
          <?php echo '</tr>';

          $kk++;
        endwhile; endif;
          ?>  
        </tbody>

      </table>
    </div>
    </div>
  </body>
</html>

<?php
// $message = ob_get_contents();
// ob_end_clean();
