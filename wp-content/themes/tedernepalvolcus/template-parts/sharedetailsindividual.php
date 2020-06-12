<?php /* Template Name: Organization Detail */
?>
<?php get_header('user'); 

?>

<section>
<div class="container">
	<div class="row">
		<div class="col col-md-8 col-md-offset-2">
			<h3 style="margin-top: 100px; border: 2px solid blue; background-color: #31708f; padding: 20px; color: whitesmoke;">Details:<!-- <?php if(is_user_logged_in()){?><a href="<?php echo home_url( '/sharedetail' ) ?>" class="btn btn-default pull-right">View All </a><?php } ?> --></h3>

			<?php 
			global $wpdb;
			if (isset($_GET['org'])) {
				$orgname = $_GET['org'];
				$sql = "SELECT * FROM `wp_sharereport` WHERE organization='$orgname' ORDER BY id ASC";
				
				$results = (array) $wpdb->get_results($sql);
				?>
				<div class="row">
					<div class="col col-md-12" style="margin-top: 30px">
						<div class="panel panel-success">
						  <div class="panel-heading" style="font-size: 20px; color: black; background-color: #2b6a8aa6"><?php echo $orgname ?></div>
						  
						  <div class="panel-body">
						  	<p style="color: maroon; font-size: 18px;">CLICK TO VIEW:</p><hr style="border-top: 3px solid lightgrey;">
						  	<?php 
							foreach ($results as $key) {
							$data = (array) $key;

							$filename = $data['file'];

							$length = strlen($filename);

							$position = strrpos($filename, '.');

							$filetype = substr($filename, $position ,$length);

							if ($filetype == '.pdf' || $filetype == '.doc' || $filetype == '.docx' ) { ?>
								<a style="font-size: 14px; cursor: pointer; padding: 10px; color: black;" href="https://docs.google.com/gview?url=<?php echo wp_upload_dir()['baseurl'] . '/reports/' . $data['file'] ?>&embedded=true" target="_blank"> <i class="fa fa-file-text fa-lg" aria-hidden="true"></i> <?php echo $data['notice'] ?>  </a>
								
							<?php }else{ ?>
								<!-- <a href="<?php echo wp_upload_dir()['baseurl'] . '/reports/' . $data['file'] ?>" style="padding: 10px; color: black; cursor: pointer;" download> -->
								<a href="#" class="pop" style="color: black; cursor: pointer;"><i class="fa fa-file-image-o fa-lg" aria-hidden="true" style="padding: 10px;"></i> 
								<?php echo $data['notice'] ?>
								
								</a>
							<?php 
							}
						  	?>

	
	
	<br><br>
						  	<?php } ?>
						  </div>
						</div>
					</div>
					</div>
			<?php
			}
					
			?>
		</div>
	</div>
</div>
</section>
</div>
<div class="modal bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        <h5 class="modal-title" id="ModalLongTitle"></h5>
      </div>
      <div class="modal-body">
          
        <!-- <img src="<?php echo wp_upload_dir()['baseurl'] . '/reports/' . $filename ?>" class="tender_image_preview" style="width: 100%;" >  -->
       <img width="800" src="<?php echo wp_upload_dir()['baseurl'] . '/reports/' . $filename ?>">
        
      </div>
      <div class="modal-footer">
        <!-- <a id="OpenInNew" href="" target="_blank"><button type="button" class="btn btn-primary"></button></a> -->
        
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
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
</script>

<?php get_footer(); ?>