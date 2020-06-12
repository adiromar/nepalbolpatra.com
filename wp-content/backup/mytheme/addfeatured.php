<?php
/**
 * Template Name: Add Featured
 *
 */
?>
<?php
if( ! is_super_admin() )
{
 auth_redirect();
}

get_header();


  global $wpdb;
  $query = "SELECT * FROM `wp_tender` ORDER BY id DESC LIMIT 0,20";
  $result = $wpdb->get_results($query);

  /*
  =====================================
    TENDER "FEATURED" FORM PROCESSING
  =====================================
*/

  if (isset($_POST['submit_featured'])) {
    $tenderid = $_POST['featured'];
    $table = "wp_tender";
    $f = 'yes';
    foreach ($tenderid as $key) {
      $suc = $wpdb->update($table, 
                      array('featured' => $f ) , 
                      array('id' => $key)  
                    );
    }
     if ( is_wp_error( $suc ) ) {
        $error_string = $result->get_error_message();
        echo '<div class="alert alert-warning"><p>' . $error_string . '</p></div>';
    }else{
      echo '<div class="alert alert-success">You have succesfully updated featured notices.</div>';
    }
  }

/*END*/
?>
<style type="text/css">
  .panel-table .panel-body{
  padding:0;
}

.panel-table .panel-body .table-bordered{
  border-style: none;
  margin:0;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
    text-align:center;
    width: 100px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
  border-right: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
  border-left: 0px;
}

.panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
  border-bottom: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
  border-top: 0px;
}

.panel-table .panel-footer .pagination{
  margin:0; 
}

/*
used to vertically center elements, may need modification if you're not using default sizes.
*/
.panel-table .panel-footer .col{
 line-height: 34px;
 height: 34px;
}

.panel-table .panel-heading .col h3{
 line-height: 30px;
 height: 30px;
}

.panel-table .panel-body .table-bordered > tbody > tr > td{
  line-height: 34px;
}


</style>
<section class="hero-section-1 main-pg-section">
	<div class="container card mt-3 p-3">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-8 col-xs-8 col-sm">
                    <h3 class="panel-title">Featured Posts</h3>
                    <small>Please select the following and submit:</small>
                  </div>
                  <div class="col-md-4 col-xs-4 col-sm text-right">
                    <!-- <button type="button" class="btn btn-sm btn-primary btn-create">Make Featured</button> -->
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <td class="hidden-xs">ID</td>
                        <td>Publisher</td>
                        <td>Description</td>
                    </tr> 
                  </thead>
                  <tbody>
                    <form action="" method="post">
                    <?php 
                      $i =1;
                      if ( count( $result ) ) {
                        foreach ( $result as $value_obj ) {
                          $entry = (array) $value_obj;
                    ?>
                    <tr>
                        <th><input type="checkbox" name="featured[]" value="<?= $entry['id'] ?>" <?php if ($entry['featured']=='yes'){ echo 'checked'; } ?>></th>
                        <th><?php echo $i.'.'; $i++; ?></th>
                        <th><?php echo $entry['publisher'] ?></th>
                        <th><?php echo $entry['description'] ?></th>
                    </tr>
                    <?php }
                        }
                    ?>
                  </tbody>
                </table>
            
              </div>
               <div class="panel-footer">
                <div class="row">
                  <div class="col col-xs-4">
                  </div>
                  <div class="col col-xs-8">
                    <input type="submit" name="submit_featured" value="Make Featured" class="btn btn-success btn-xs">
                  </form>
                  </div>
                </div>
              </div>
            </div>

</div></div>
		</div>
	</div>
</section>
<?php get_footer(); ?>