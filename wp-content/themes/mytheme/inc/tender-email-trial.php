<?php
ob_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nepalbolpata.com (<?php date("Y-m-j") ?>)</title>

    
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
        <?php $i = 1;
          foreach( $table_result as $value_obj ) {
            $tender_each = (array) $value_obj;
        ?>
        <tbody>
          <tr class="first-row">
            <th scope="row"><?php echo $i++ ?></th>
            <td><?php echo $tender_each['publisher']; ?></td>
            <td><?php echo $tender_each['description']; ?></td>
            <td><?php echo $tender_each['published_date']; ?></td>
            <td><?php echo $tender_each['submission_date']; ?></td>
            <td><?php echo ucfirst( $tender_each['notice'] ); ?></td>

            <td><?php 
            
             echo ucfirst( $tender_each['industry'] );
            ?>
            </td>

            <td><?php
            echo ucfirst( $tender_each['product'] );
            
            ?></td>

            <td><?php echo $tender_each['newspaper'] ?></td>

            <td><?php $today = new DateTime(date("Y-m-j"));
              $sd = new DateTime( $tender_each['submission_date'] );
              echo $diff = $sd->diff($today)->format("%a") . " days";
            ?></td>

            <td><?php if ($tender_each['image']) { ?>
              <a href="">
                <img src="<?php echo wp_upload_dir()['baseurl']; ?>/<?php echo $tender_each['image']; ?>" title="tender" alt="View" style="max-height: 50px; max-width: 100px; display:block; pointer-events: none;">
              </a>
            <?php } else { ?>
              &nbsp;n/a
            <?php } ?></td>
          </tr>
        </tbody>
        <?php
          }
        ?>
      </table>
    </div>
    </div>
  </body>
</html>

<?php
$message = ob_get_contents();
ob_end_clean();
