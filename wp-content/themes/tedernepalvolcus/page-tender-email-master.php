<?php
ob_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tender Nepal (<?php date("Y-m-j") ?>)</title>

    <link rel="stylesheet" type="text/css" crossorigin="anonymous" href="<?php bloginfo('template_url') ?>/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="container">
      <table class="table-hover table-striped table-bordered">
        <thead>
          <tr class="first-row">
            <th>SN.</th>
            <th>Notice Publisher</th>
            <th>Description</th>
            <th>Published Date</th>
            <th>Last Submission date</th>
            <th>Notice Category</th>
            <th>Industry</th>
            <th>Product/ Service</th>
            <th>Newspaper</th>
            <th>Day Left</th>
            <th>Image</th>
          </tr>
        </thead>
        <?php $i = 1;
          foreach( $table_result as $value_obj ) {
            $tender_each = (array) $value_obj;
        ?>
        <tbody>
          <tr class="first-row">
            <th scope="row"><?php echo $i++ ?></th>
            <td><?php echo $tender_each['publisher'] ?></td>
            <td><?php echo $tender_each['description'] ?></td>
            <td><?php echo $tender_each['published_date'] ?></td>
            <td><?php echo $tender_each['submission_date'] ?></td>
            <td><?php echo ucfirst( $tender_each['notice'] )?></td>

            <td><?php 
            // switch ( $tender_each['industry'] ) {
            //   case 'govt':
            //     echo "Government/ Ministries/ Departments";
            //     break;
            //   case 'bank':
            //     echo "Banking/ Finance /Insurance";
            //     break;
            //   case 'hydro':
            //     echo " Hydro Power/ Energy";
            //     break;
            // } 
             echo ucfirst( $tender_each['industry'] );
            ?>
            </td>

            <td><?php
            echo ucfirst( $tender_each['product'] );
            // switch ( $tender_each['product'] ) {
            //   case 'architectural':
            //     echo "Architectural / Interior";
            //     break;
            //   case 'auction':
            //     echo "Auction";
            //     break;
            //   case 'estate':
            //     echo "Real Estate";
            //     break;
            //   case 'electronic':
            //   echo "Electronics / Electric Utilities";
            //     break;
            //   case 'health':
            //     echo "Health / Medical";
            //     break;
            //   case 'auto':
            //     echo "Automotive / Vehicles";
            //     break;
            //   case 'build':
            //     echo "Construction / Buildings";
            //     break;
            //}
            ?></td>

            <td><?php echo $tender_each['newspaper'] ?></td>

            <td><?php $today = new DateTime(date("Y-m-j"));
              $sd = new DateTime( $tender_each['submission_date'] );
              echo $diff = $sd->diff($today)->format("%a") . " days";
            ?></td>

            <td><?php if ($tender_each['image']) { ?>
              <a href="<?php echo wp_upload_dir()['baseurl'] . '/' . $tender_each['image'] ?>">
                <img src="<?php echo wp_upload_dir()['baseurl'] . '/' . $tender_each['image'] ?>"
                  alt="<?php echo $tender_each['notice'] . ' image' ?>"
                  style="max-height: 100px; max-width: 50px;">
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
  </body>
</html>

<?php
$message = ob_get_contents();
ob_end_clean();
