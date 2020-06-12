<?php

get_header('');
 
 global $wpdb;
 $uid = get_current_user_id();
 $user = get_user_meta($uid, 'user_type');
 $user = $user[0];
 $userw = get_user_meta($uid);
 $count = count($userw);

 ?>


 <?php

 if ($uid > 0) {
 	$result = (array) $wpdb->get_results(
 	'SELECT * FROM `wp_sharereport` ORDER BY `published_date` DESC LIMIT 20'
 	);
 }else{
 	$result = (array) $wpdb->get_results(
 	'SELECT * FROM `wp_sharereport` ORDER BY `published_date` DESC LIMIT 10'
 );
 }
 
//define(ROOTPATH, ABSPATH);

?>
<style type="text/css">
#alert{
	 height: 100px;
}
	@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    #alert{
	 height: 150px;
	}
	}
	@media only screen and (max-width: 500px) {
    #alert{
	 height: 180px;
	}
	}


.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:black;
}

.search{
	background: white !important;
	border: 1px solid #364043d1 !important;
	color: black !important;
	height: 40px;
	font-size: 16px;
}

#orgname{
	cursor: pointer; font-size: 15px; color: black;
}
#org a:hover{
	color: orange;
}
</style>
<!--
  /*
		=======================================
    Start of Page Content
  	=======================================
	*/
-->
<div id="content" class="table_content" style="margin-top: 00px;" >
<div class="container">
	<div class="row">
		<div class="col col-md-12">
			<h3 style="margin-top:120px">Latest in Share Bazaar</h3>
			<hr style="width: 22%;border-top: 3px solid #ec4707; margin-bottom: 40px;">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group pull-left">
				<span class="counter pull-right"></span>
	   		 <input type="text" class="search form-control" placeholder="   NAME OR SYMBOL">
				</div>
				</div>
				<div class="col-md-6">
					<?php if(is_user_logged_in()) : ?>
					<a href="<?php echo home_url( '/subscribe-us-for-share-email-notifications' ) ?>" class="btn btn-success pull-right" style="height: 40px; font-size: 18px; background-color: #364043d1;">Subscribe to Email Notifications</a>
					<?php endif; ?> 
				</div>
			</div>
			
			</div>
	</div>
<div class="row">
	<div class="col-md-12">
	<table class="table table-striped table-hover table-bordered table-condensed table-responsive results">
	  <thead>
	    <tr>
	      <th style="padding: 5px; width: 20px;">S.N</th>
		    <th style="width:180px; padding: 15px;">Organization Name</th>
		    <th style="padding: 15px; width: 400px;">Notice</th>
		    <th style="width:99px; padding: 15px;">Published Date</th>
		    
	    </tr>
	    <tr class="warning no-result">
	      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
	    </tr>
	  </thead>
	  <tbody>
	    <?php
				if (count($result)) {
					$i = 1;
					foreach ($result as $value_obj) {
						$entry = (array) $value_obj;
						$orgn = $entry["organization"];
						$symbol = $wpdb->get_results("SELECT symbol FROM wp_org WHERE orgname='$orgn'", ARRAY_A);
						$symbol = $symbol[0];
						$symbol = $symbol['symbol'];
				?>
						<tr> 
							<td style="padding: 10px;"><?php echo $i++.'.'; ?></td>
							<td style="padding: 10px;" id="org">
								<a href="<?php echo home_url( '/organization-detail' ) ?>?org=<?php echo $entry['organization'];?>" id="orgname"><?php echo $entry['organization'].' ( '. $symbol .' )' ?></a>
							</td>
							<td style="padding: 10px; font-size: 14px;"><?php echo $entry['notice'] ?></td>
							<td style="padding: 10px;"><?php echo $entry['published_date'] ?></td>
						</tr>
				<?php }
			} else {
				echo "</table>";
				echo "There are no INFO at the Moment.";
			}
			?>
	  </tbody>
	</table>
	<?php if(is_user_logged_in()): ?>
	<a href="<?php echo home_url( '/sharedetail' ) ?>" class=" btn btn-large pull-right hvr-sweep-to-bottom" style="border: 1px solid grey; margin-bottom: 60px;">More SHARE Notices Details</a>
<?php endif; ?>
</div>
</div>
	</div>
</div>
</div>

<!--
  /*=======================================
    Start of Page Content
  */=======================================
 -->

<!-- /*Picture in Modal View*/ -->
<script>
  $(function() {
		$('.pop').on('click', function() {
			$('.tender_image_preview').attr('src', $(this).find('img').attr('src'));

      $('.modal-title').text($(this).find('img').attr('alt'));

      $('#OpenInNew').attr('href', $(this).find('img').attr('src'));

			$('#imagemodal').modal('show');
		});
  });

  $('.scroll').click(function() {
    $('body').animate({
        scrollTop: eval($('#' + $(this).attr('target')).offset().top - 70)
    }, 1000);
});

  $(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
</script>

<?php get_footer();
