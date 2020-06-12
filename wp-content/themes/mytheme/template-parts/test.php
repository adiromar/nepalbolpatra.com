<style type="text/css">
    .cvf_pag_loading {padding: 20px;}
.cvf-universal-pagination ul {margin: 0; padding: 0;}
.cvf-universal-pagination ul li {display: inline; margin: 3px; padding: 4px 8px; background: #FFF; color: black; }
.cvf-universal-pagination ul li.active:hover {cursor: pointer; background: #1E8CBE; color: white; }
.cvf-universal-pagination ul li.inactive {background: #7E7E7E;}
.cvf-universal-pagination ul li.selected {background: #1E8CBE; color: white;}
</style>

<div class="col-md-12 content">
    <div class = "inner-box content no-right-margin darkviolet">

<div class = "cvf_pag_loading">
            <div class = "cvf_universal_container">
                <div class="cvf-universal-content"></div>
            </div>
        </div>
    </div>      
</div>


<script>
jQuery(document).ready(function($) {
            // This is required for AJAX to work on our page
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

            function cvf_load_all_posts(page){
                // Start the transition
                $(".cvf_pag_loading").fadeIn().css('background','#ccc');

                // Data to receive from our server
                // the value in 'action' is the key that will be identified by the 'wp_ajax_' hook 
                var data = {
                    page: page,
                    action: 'demo-pagination-load-posts'
                };

                // Send the data
                $.post(ajaxurl, data, function(response) {
                    // If successful Append the data into our html container
                    $(".cvf_universal_container").append(response);
                    // End the transition
                    $(".cvf_pag_loading").css({'background':'none', 'transition':'all 1s ease-out'});
                });
            }

            // Load page 1 as the default
            cvf_load_all_posts(1);

            // Handle the clicks
            $('.cvf_universal_container .cvf-universal-pagination li.active').live('click',function(){
                var page = $(this).attr('p');
                cvf_load_all_posts(page);

            });

        }); 
</script>