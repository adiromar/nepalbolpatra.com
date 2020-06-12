<?php 
use PHPMailer\PHPMailer\PHPMailer;

// using php default session
function tatwerat_startSession() {
    if(!session_id()) {
        session_start();
    }
}

add_action('init', 'tatwerat_startSession', 1);

// thumbnails
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50 ); 

function register_admin_scripts() {
    wp_enqueue_script( 'jquery-ui-datepicker' );
} // end
wp_enqueue_style( 'jquery-ui-datepicker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css' );


// meta boxes
function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div class="col-md-12">
        	<label>Publisher Name <span style="color: red"><b>*</b></span> : </label>
            <input name="publisher" type="text" value="<?php echo get_post_meta($object->ID, "publisher", true); ?>" placeholder="Enter your personal/company name" class="form-control" required style="width: 370px;">
        </div>
        <br>
        <div class="col-md-12">
        	<label>Published Date <span style="color: red"><b>*</b>: </label>
            <input id="datepicker1" name="published_date" type="text" value="<?php echo get_post_meta($object->ID, "published_date", true); ?>" placeholder="Published Date (B.S)" class="form-control nepali-calendar" autocomplete="off" required>

            <input type="text" name="published_date_eng" id="englishDate_pub" class="form-control" value="<?php echo get_post_meta($object->ID, "published_date_eng", true); ?>" placeholder="" autocomplete="off" readonly>
        </div>
        <br>
        <div class="col-md-12" style="margin-bottom: 155px;">
        	<label>Last Date of Submission <span style="color: red"><b>*</b>:</label>
            <input id="nepaliDate" name="expiry_date" type="text" value="<?php echo get_post_meta($object->ID, "expiry_date", true); ?>" placeholder="Expiry Date" class="form-control nepali-calendar" autocomplete="off">
            <input type="text" name="submission_date_eng" id="englishDate" class="form-control" value="<?php echo get_post_meta($object->ID, "submission_date_eng", true); ?>" placeholder="English Date" autocomplete="off" readonly>
        </div>

  <script type="text/javascript" src="<?php bloginfo('template_url') ?>/nepali/js/jquery.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url') ?>/nepali/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url') ?>/nepali/nepali.datepicker.v2.2.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/nepali/css/bootstrap.min.css" /> -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/nepali/nepali.datepicker.v2.2.min.css" />

<script>
  $(document).ready(function(){
$('#nepaliDate').nepaliDatePicker({
      ndpEnglishInput: 'englishDate'
    });
$('#datepicker1').nepaliDatePicker({
      npdMonth: true,
      npdYear: true,
    });

$('#nepaliDate').nepaliDatePicker({
    ndpEnglishInput: 'englishDate'
});

$('#englishDate').change(function(){
  $('#nepaliDate').val(AD2BS($('#englishDate').val()));
});

$('#datepicker1').nepaliDatePicker({
    ndpEnglishInput: 'englishDate_pub'
});

 });
  </script>
    <?php
}
function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Publisher Info", "custom_meta_box_markup", "post", "advanced", "low", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    $meta_box_text_value1 = "";
    $meta_box_text_value2 = "";
    $meta_box_text_value3 = "";

    if(isset($_POST["publisher"]))
    {
        $meta_box_text_value = $_POST["publisher"];
    }   
    update_post_meta($post_id, "publisher", $meta_box_text_value);
    if(isset($_POST["published_date"]))
    {
        $meta_box_text_value1 = $_POST["published_date"];
    }   
    update_post_meta($post_id, "published_date", $meta_box_text_value1);
    if(isset($_POST["expiry_date"]))
    {
        $meta_box_text_value2 = $_POST["expiry_date"];
    }   
    update_post_meta($post_id, "expiry_date", $meta_box_text_value2);
    if(isset($_POST["submission_date_eng"]))
    {
        $meta_box_text_value3 = $_POST["submission_date_eng"];
    } 
    update_post_meta($post_id, "submission_date_eng", $meta_box_text_value3);  
    if(isset($_POST["published_date_eng"]))
    {
        $meta_box_text_value4 = $_POST["published_date_eng"];
    }  
    update_post_meta($post_id, "published_date_eng", $meta_box_text_value4);
}

add_action("save_post", "save_custom_meta_box", 10, 3);


// insert tender form records
function tendernepal_add_new_tender()
{
	$publisher         = $_POST['publisher'];
 	$description 			 = $_POST['description'];
	$published_date    = $_POST['published_date'];
	$submission_date	 = $_POST['submission_date'];
	$submission_date_eng	 = $_POST['submission_date_eng'];
	$notice  				   = $_POST['notice'];
	$industry 				 = $_POST['industry'];
	$product  				 = $_POST['product'];
	$newspaper 				 = $_POST['newspaper'];
	$image  					 = '';

	global $wpdb;

	//Image upload check
	if ($_FILES['image']['size']) {
		//get latest id
		$obj = $wpdb->get_results( "SELECT MAX(id) FROM wp_tender" );
		$id_obj = (array)$obj['0'];
		$id = $id_obj['MAX(id)'];

		//obtaining extension from uploaded img
		$img_type = strrpos($_FILES['image']['type'], '/');
		$extn = $img_type === false ? $_FILES['image']['name'] : substr($_FILES['image']['type'], $img_type +1);
		$image_name = time() . "_{$_POST['published_date']}" . '.' . $extn;

		//file location specification to upload
		$file_local = 'wp-content/uploads/tender/' . $image_name;
		$file_path = ABSPATH . $file_local;
		$file_name = 'tender/' . $image_name;
		$imgupload = move_uploaded_file($_FILES['image']['tmp_name'], $file_local);
	} else {
		$file_name = NULL;
	}



  $table_name = $wpdb->prefix . "tender"; //try not using Uppercase letters or blank spaces when naming db tables

	  $entry = $wpdb->insert($table_name, array(
						 'publisher' 	=> $publisher, //replaced non-existing variables $lq_name, and $lq_descrip, with the ones we set to collect the data - $name and $description
					 	 'description'			=>  $description,
				 		 'published_date'		=>	$published_date,
						 'submission_date'	=>	$submission_date,
						 'submission_date_eng' => $submission_date_eng,
						 'notice'						=>	$notice,
						 'industry'					=>	$industry,
						 'product'					=>	$product,
						 'newspaper'				=>	$newspaper,
						 'image'						=>	$file_name
						 )
	 );

	add_to_schedule_email( $product, $wpdb->insert_id );

	 if ($entry) {
		 wp_redirect( site_url() . "\/entry-submission-success/" );
		 exit;
	 }
 }
// echo '<br><br>';
if( isset($_POST['tender_submit']) )
{
	tendernepal_add_new_tender();
}


/*
	=====================================
		TENDER "EDIT" FORM PROCESSING
	=====================================
*/


 function tendernepal_edit_tender()
 {
 	// print_r($_POST);print_r($_FILES);
	 $publisher       = $_POST['publisher'];
	 $description 		= $_POST['description'];
	 $published_date  = $_POST['published_date'];
	 $submission_date	= $_POST['submission_date'];
	 $submission_date_eng	= $_POST['submission_date_eng'];
	 $notice  				= $_POST['notice'];
	 $industry 				= $_POST['industry'];
	 $product  				= $_POST['product'];
	 $newspaper 			= $_POST['newspaper'];
	 $image  					= '';

  // $file_name = $_POST['image'];

	if ($_FILES['image']['size']) {
		//obtain new filename extension
		$img_type = strrpos($_FILES['image']['type'], '/');
		$extn = $img_type === false ? $_FILES['image']['name'] : substr($_FILES['image']['type'], $img_type +1);
		$image_name = time() . "_{$_POST['published_date']}" . '.' . $extn;

		//replace with the new file
		$file_local = 'wp-content/uploads/tender/' . $image_name;
		$file_path = ABSPATH . $file_local;
		$file_name = 'tender/' . $image_name;
		$imgupload = move_uploaded_file($_FILES['image']['tmp_name'], $file_local);
 	} else {
 		$file_name = $_POST['image'];
 	}
 		// echo $file_name;die;
	global $wpdb;

	$table_name = $wpdb->prefix . "tender"; //try not using Uppercase letters or blank spaces when naming db tables

	$entry = $wpdb->update( $table_name, array(
				'publisher' 			=> $publisher, //replaced non-existing variables $lq_name, and $lq_descrip, with the ones we set to collect the data - $name and $description
				'description'			=>  $description,
				'published_date'	=>	$published_date,
				'submission_date'	=>	$submission_date,
				'submission_date_eng' => $submission_date_eng,
				'notice'					=>	$notice,
				'industry'				=>	$industry,
				'product'					=>	$product,
				'newspaper'				=>	$newspaper,
				'image'						=>	$file_name
			), array('id'	=>	"{$_GET['tender_id']}")
		);

		if ($entry) {
			wp_redirect( site_url() . "\/entry-submission-success/" );
			exit;
	 }
 }
		if ( isset($_POST['tender_edit_submit']) )
		{
			tendernepal_edit_tender();
		}
/*-----------FORM EDIT END-----------*/


/*
	=====================================
		Date Picker for FORM
	=====================================
*/
function add_datepicker_in_footer(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
		    jQuery('#pdate').datepicker({
		        dateFormat: 'yy-mm-dd'
		    });
				jQuery('#sdate').datepicker({
						dateFormat: 'yy-mm-dd'
				});
		});
	</script>
<?php
} // close add_datepicker_in_footer() here
//add an action to call add_datepicker_in_footer function
add_action('wp_footer','add_datepicker_in_footer', 10);

/*
	=====================================
		Add Custom Interest Field on User Profile 2
	=====================================
*/
add_action('show_user_profile1', 'extra_user_profile_fields1');
add_action('edit_user_profile1', 'extra_user_profile_fields1');
//show "INTEREST" extra field for each User on their PROFILE PAGE
function extra_user_profile_fields1( $user ) { ?>
	<?php
	global $wpdb;
	?>

	<div class="col-md-12 col-sm-12">
		<button class="btn btn-primary btn-sm  chev" type="button" data-toggle="collapse" data-target="#cat" aria-expanded="false" aria-controls="collapseExample">Category 
		</button>
	</div>
	<div class="collapse mt-2" id="cat">
  		<div class="card card-body">
    		<div class="row">
    	<?php	
		// new terms or category lists
		$terms = get_terms( array(
    		'taxonomy' => 'category',
    		'hide_empty' => false,
		) ); 
		foreach ($terms as $data) { ?>
			<div class="col-md-4 col-sm-12">
		<label>
			<input type="checkbox" name="<?php echo $data->slug ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data->slug, $user->ID ) == 1 ) echo "checked"; ?>>
			<strong><?php echo $data->name ;?></strong>
		</label>
		
		</div>
		<?php } ?>
			</div>
  		</div>
	</div>

	<div class="col-md-12 col-sm-12 mt-3">
		<button class="btn btn-primary btn-sm  chev" type="button" data-toggle="collapse" data-target="#news" aria-expanded="false" aria-controls="collapseExample">Newspapers</button>
	</div>
	<div class="collapse mt-2" id="news">
  		<div class="card card-body">
  			<div class="row">
    	<?php	
		// new terms or category lists
		$terms = get_terms( array(
    		'taxonomy' => 'newspapers',
    		'hide_empty' => false,
		) ); 
		foreach ($terms as $data) { ?>
			<div class="col-md-4 col-sm-12">
		<label>
			<input type="checkbox" name="<?php echo $data->slug ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data->slug, $user->ID ) == 1 ) echo "checked"; ?>>
			<strong><?php echo $data->name ;?></strong>
		</label>
		
		</div>
		<?php } ?>
			</div>
  		</div>
	</div>

	<div class="col-md-12 col-sm-12 mt-3">
		<button class="btn btn-primary btn-sm chev" type="button" data-toggle="collapse" data-target="#products" aria-expanded="false" aria-controls="collapseExample">Products</button>
	</div>
	<div class="collapse mt-2" id="products">
  		<div class="card card-body">
  			<div class="row">
    	<?php	
		// new terms or category lists
		$terms = get_terms( array(
    		'taxonomy' => 'products',
    		'hide_empty' => false,
		) ); 
		foreach ($terms as $data) { ?>
			<div class="col-md-4 col-sm-12">
		<label>
			<input type="checkbox" name="<?php echo $data->slug ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data->slug, $user->ID ) == 1 ) echo "checked"; ?>>
			<strong><?php echo $data->name ;?></strong>
		</label>
		
		</div>
		<?php } ?>
			</div>
  		</div>
	</div>

<?php
}
/*
	=====================================
		Add Custom Interest Field on User Profile
	=====================================
*/
add_action('show_user_profile', 'extra_user_profile_fields');
add_action('edit_user_profile', 'extra_user_profile_fields');
//show "INTEREST" extra field for each User on their PROFILE PAGE
function extra_user_profile_fields( $user ) { ?>
	<?php
	global $wpdb;
	/*$res = $wpdb->get_results("SELECT * FROM wp_addproduct",ARRAY_A);
            foreach($res as $data)
              { ?>
                <div style="padding-left:50px;">
		<label>
			<input type="checkbox" name="<?php echo $data['product_name'] ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data['product_name'], $user->ID ) == 1 ) echo "checked"; ?> >
		</label>
		<strong><?php echo $data['product_name'] ;?></strong>
		</div>
		<?php }*/ 
		?>

		<div class="row">
			<div class="col-md-3 col-sm-12 cat-field-plug">
			<legend>Newspapers: </legend>

		<?php	
		// new terms or category lists
		$terms = get_terms( array(
    		'taxonomy' => 'newspapers',
    		'hide_empty' => false,
		) ); 
		// print_r($terms);
		foreach ($terms as $data) { ?>
			<div class="col-md-12 col-sm-12">
		<label>
			<input type="checkbox" name="<?php echo $data->slug ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data->slug, $user->ID ) == 1 ) echo "checked"; ?>>
			<strong><?php echo $data->name ;?></strong>
		</label>
		
		</div>
		<?php } ?>
		</div>

		<div class="col-md-3 col-sm-12 cat-field-plug">
			<legend>Category:</legend>
			<?php
			$category = get_categories();

			foreach ($category as $cat) { ?>
				<div class="col-md-12 col-sm-12">
					<label>
					<input type="checkbox" name="<?php echo $cat->slug ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$cat->slug, $user->ID ) == 1 ) echo "checked"; ?>>
					<strong><?php echo $cat->name ;?></strong>
					</label>
				</div>
			<?php } ?>
		</div>

		<div class="col-md-3 col-sm-12 cat-field-plug">
			<legend>Products: </legend>

		<?php	
		// new terms or category lists
		$terms_p = get_terms( array(
    		'taxonomy' => 'products',
    		'hide_empty' => false,
		) ); 
		// print_r($terms);
		foreach ($terms_p as $data) { ?>
			<div class="col-md-12 col-sm-12">
		<label>
			<input type="checkbox" name="<?php echo $data->slug ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data->slug, $user->ID ) == 1 ) echo "checked"; ?>>
			<strong><?php echo $data->name ;?></strong>
		</label>
		
		</div>
		<?php } ?>
		</div>

		<div class="col-md-3 col-sm-12 cat-field-plug">
			<legend>Industries: </legend>

		<?php	
		// new terms or category lists
		$terms_i = get_terms( array(
    		'taxonomy' => 'industries',
    		'hide_empty' => false,
		) ); 
		// print_r($terms);
		foreach ($terms_i as $data) { ?>
			<div class="col-md-12 col-sm-12">
		<label>
			<input type="checkbox" name="<?php echo $data->slug ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data->slug, $user->ID ) == 1 ) echo "checked"; ?>>
			<strong><?php echo $data->name ;?></strong>
		</label>
		
		</div>
		<?php } ?>
		</div>

	</div>

<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );



// ====================================== taxanomy ===========
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts
 
function create_topics_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Products/Service', 'taxonomy general name' ),
    'singular_name' => _x( 'Product', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Product' ),
    'all_items' => __( 'All Products/Services' ),
    'parent_item' => __( 'Parent Topic' ),
    'parent_item_colon' => __( 'Parent Product:' ),
    'edit_item' => __( 'Edit Product' ), 
    'update_item' => __( 'Update Product' ),
    'add_new_item' => __( 'Add New Product' ),
    'new_item_name' => __( 'New Product Name' ),
    'menu_name' => __( 'Products' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('products',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product' ),
  ));
 
}

// taxanomy
add_action( 'init', 'create_topics_hierarchical_taxonomy1', 0 );

function create_topics_hierarchical_taxonomy1() {
 
  $labels = array(
    'name' => _x( 'Newspapers', 'taxonomy general name' ),
    'singular_name' => _x( 'Newspaper', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Newspaper' ),
    'all_items' => __( 'All Newspapers' ),
    'parent_item' => __( 'Parent Topic' ),
    'parent_item_colon' => __( 'Parent Newspaper:' ),
    'edit_item' => __( 'Edit Newspaper' ), 
    'update_item' => __( 'Update Newspaper' ),
    'add_new_item' => __( 'Add New Newspaper' ),
    'new_item_name' => __( 'New Newspaper Name' ),
    'menu_name' => __( 'Newspapers' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('newspapers',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'newspaper' ),
  ));
 
}

// taxanomy industry
add_action( 'init', 'create_topics_hierarchical_taxonomy_industry', 0 );

function create_topics_hierarchical_taxonomy_industry() {
 
  $labels = array(
    'name' => _x( 'Industries', 'taxonomy general name' ),
    'singular_name' => _x( 'Industry', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Industry' ),
    'all_items' => __( 'All Industries' ),
    'parent_item' => __( 'Parent Topic' ),
    'parent_item_colon' => __( 'Parent Industry:' ),
    'edit_item' => __( 'Edit Industry' ), 
    'update_item' => __( 'Update Industry' ),
    'add_new_item' => __( 'Add New Industry' ),
    'new_item_name' => __( 'New Industry Name' ),
    'menu_name' => __( 'Industry' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('industries',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'industry' ),
  ));
 
}



//update User's "INTEREST FIELD" as per their profile-setting
function save_extra_user_profile_fields( $user_id )
{
	if( !current_user_can( 'edit_user', $user_id ) ) 
	require_once('../../../wp-load.php');
 	global $wpdb;

	// $res = $wpdb->get_results("SELECT * FROM wp_addproduct",ARRAY_A);
	//         foreach($res as $data)
	//         {
	//             update_user_meta( $user_id, 'interest-' .$data['product_name'], $_POST[$data['product_name']] );
	//         }

 		// newspapers
		$terms = get_terms( array(
    		'taxonomy' => 'newspapers',
    		'hide_empty' => false,
		) );
		foreach ($terms as $data) {
			update_user_meta( $user_id, 'interest-' .$data->slug, $_POST[$data->slug] );
		}
		// category
		$category = get_categories();
		foreach ($category as $cat) {
			update_user_meta( $user_id, 'interest-' .$cat->slug, $_POST[$cat->slug] );
		}

		// industries
		$terms_i = get_terms( array(
    		'taxonomy' => 'industries',
    		'hide_empty' => false,
		) );
		foreach ($terms_i as $data) {
			update_user_meta( $user_id, 'interest-' .$data->slug, $_POST[$data->slug] );
		}

		// products
		$terms_p = get_terms( array(
    		'taxonomy' => 'products',
    		'hide_empty' => false,
		) );
		foreach ($terms_p as $data) {
			update_user_meta( $user_id, 'interest-' .$data->slug, $_POST[$data->slug] );
		}
// 	update_user_meta( $user_id, 'interest-architectural', $_POST['architectural'] );
// 	update_user_meta( $user_id, 'interest-auction', $_POST['auction'] );
// 	update_user_meta( $user_id, 'interest-estate', $_POST['estate'] );
// 	update_user_meta( $user_id, 'interest-electronic', $_POST['electronic'] );
// 	update_user_meta( $user_id, 'interest-health', $_POST['health'] );
// 	update_user_meta( $user_id, 'interest-auto', $_POST['auto'] );
// 	update_user_meta( $user_id, 'interest-build', $_POST['build'] );
}




/*
	==========================================================
		Add Custom DB_Meta for each user after each Tender_type is posted
	==========================================================
*/
function add_to_schedule_email( $product, $last_id )
{
	//check the product/service type of each tender i.e. $product
	//if interest-match, add the tender id to the custom_created "SCHEDULE EMAIL"(DB_META) of that particular user

	//check which user has interest as the tender_type just posted
	$meta_query_args = array(
		'meta_query'	=>	array(
			array(
				'key'			=>	'interest-' . $product,
				'value'		=>	'1',
				'compare'	=>	'='
			)
		)
	);

	//Getting list of users who have their preference set to tender-category
	$meta_query = new WP_User_Query( $meta_query_args );

	//Adding recent tender_id to their custom_DB_meta
	if( !empty( $meta_query->results ) ) {
		foreach( $meta_query->results as $user ) {
			//check if the custom meta already has the tender_id(for edit purpose)->extra caution
			$email_content = get_user_meta( $user->{'ID'}, 'schedule_email', true );

			if( $email_content != null || $email_content != '' ) {
				if( !in_array( $last_id, $email_content ) ) {
					$email_content[]	=	$last_id;
					update_user_meta( $user->{'ID'}, 'schedule_email', $email_content );
				}
			} else {
				$add_content[]	=	$last_id;
				update_user_meta( $user->{'ID'}, 'schedule_email', $add_content );
			}; //endelseif

			//check if the so schedule_email meta has 5 or more Array
			if( count( get_user_meta( $user->{'ID'}, 'schedule_email', true ) ) >= 5 ) {
				//run mail function
				send_mail_after_five( $user->{'ID'} );
			};

		};	//endforeach
	};	//endif

}




/*
	===============================
		Mail functions
	===============================
*/
//read the schedule_email meta
//will run for every user whose schedule_email meta is 5 or more, as the function is called inside foreach loop above
function send_mail_after_five( $userid )
{
	//convert schedule_email array into string
	$email_list = get_user_meta( $userid, 'schedule_email', true );
	$email_list_string = implode( $email_list, ', ' );
	$emailaddress = get_userdata( $userid )->{ 'user_email' };
	$email_sub = get_userdata( $userid )->{ 'display_name' } . ', Tender notice as of ' . date( "Y-m-j" );

	//get data from DB as per schedule_email meta
	global $wpdb;
	$result = (array) $wpdb->get_results( "SELECT * FROM wp_tender WHERE id IN ( $email_list_string )" );
	//Get The Existing User Type
	$existing_user_type = get_the_author_meta( 'user_type', $userid );
	if ($existing_user_type == 'paid') {
		//send the data to email_template: 'different file':-to populate table
	global $table_result;
	$table_result = $result;
	require( 'inc/tender-email-master.php' );

	//send so mail
	add_filter('wp_mail_content_type', 'change_mail_type');
	add_filter('wp_mail_from', 'change_mail_from');
	add_filter('wp_mail_from_name', 'change_mail_from_name');
  
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 //mail( $emailaddress, $email_sub, $message );

 $success = mail($emailaddress, $email_sub, $message, $headers);
 if (!$success) {
    $errorMessage = error_get_last()['message'];
    echo $errorMessage;
    exit;
}




//	wp_mail( $emailaddress, $email_sub, $message );

	remove_filter('wp_mail_content_type', 'change_mail_type');
	remove_filter('wp_mail_from', 'change_mail_from');
	remove_filter('wp_mail_from_name', 'change_mail_from_name');

	//reset the schedule_email custom meta
	delete_user_meta( $userid, 'schedule_email' );
	}else{
		//send the data to email_template: 'different file':-to populate table
	global $table_result;
	$table_result = $result;
	require( 'inc/tender-email-trial.php' );

	//send so mail
	add_filter('wp_mail_content_type', 'change_mail_type');
	add_filter('wp_mail_from', 'change_mail_from');
	add_filter('wp_mail_from_name', 'change_mail_from_name');
  


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 //mail( $emailaddress, $email_sub, $message );

 $success = mail($emailaddress, $email_sub, $message, $headers);
 if (!$success) {
    $errorMessage = error_get_last()['message'];
    echo $errorMessage;
    exit;
}

//	wp_mail( $emailaddress, $email_sub, $message );

	remove_filter('wp_mail_content_type', 'change_mail_type');
	remove_filter('wp_mail_from', 'change_mail_from');
	remove_filter('wp_mail_from_name', 'change_mail_from_name');

	//reset the schedule_email custom meta
	delete_user_meta( $userid, 'schedule_email' );
	}
}




/*
	==========================================================
		Add Extra column to Users List in Admin Panel
	==========================================================
*/
//unset POST column, insert 4 new
add_action( 'manage_users_columns', 'modify_user_columns' );
function modify_user_columns( $column_headers )
{
	unset( $column_headers['posts'] );
	$column_headers['status'] 						= 'Subscription Type';
	$column_headers['reg_date'] 					= 'Registered Date';
	$column_headers['exp_date'] 					= 'Expiration Date';
	$column_headers['subscription_left'] 	= 'Subscription Left';
	return $column_headers;
}

//style the shrunked Email column
add_action('admin_head', 'style_userslist_columns');
function style_userslist_columns() {
  echo '<style>
	.column-email { width: 18% }
	.column-name { width: 10% }
	.column-username { width: 12% }
  </style>';
}

//give value to custom fields
add_action( 'manage_users_custom_column', 'value_to_custom_column', 10, 3 );
function value_to_custom_column( $value, $column_name, $user_id )
{
	$user = get_userdata( $user_id );

	if( 'subscription_left' == $column_name )
	{
		if( isset( $user->{'expiration_date'} ) || $user->{'expiration_date'} != '' )
		{
			$today = new DateTime( date( "Y-m-j" ) );
			$exp_date = DateTime::createFromFormat( "Y-m-j", $user->{'expiration_date'} )->settime( 0,0 );
			$subsc_left_calc = $today->diff( $exp_date )->format("%R%a");
			if( $subsc_left_calc >= 0 )
			{
				if( $user->{'user_type'} == 'expired' )
				{
					calc_change_user_type( $user_id );
				}

				switch ( substr( $subsc_left_calc, 1 ) ) {
					case 0:
						return 'Ending Today';
						break;

					case 1:
						return substr( $subsc_left_calc, 1 ) . ' day';
						break;

					default:
						return substr( $subsc_left_calc, 1 ) . ' days';
						break;
				}
			}
			else
			{
				if( $user->{'user_type'} != 'expired' )
				{
					calc_change_user_type( $user_id );
				}
				return 'Expired';
			}
		}
	}

	if( 'exp_date' == $column_name )
	{
		ob_start(); ?>
		<form class="" method="post">
			<select class="" name="period">
				<option value="1">01</option>
				<option value="2">02</option>
				<option value="3">03</option>
			</select>
		</form>
		<?php
		$form_msg = ob_get_contents();
		ob_end_clean();
		// return $form_msg;
		return $user->{'expiration_date'};
	}

	if( 'status' == $column_name )
	{
		return ucfirst($user->{'user_type'});
	}

	if( 'reg_date' == $column_name )
	{
		return date_format( new DateTime( $user->{'user_registered'} ), "Y-m-j" );
	}

	return $value;
}

/*
	==========================================================
		Add Custom Meta: Expiration date and User Type
	==========================================================
*/
function extend_user_exp_date( $user_id, $period )
{
	// echo "<pre>";
	// var_dump( $user_id );
	// var_dump( $period );

	$today = new DateTime( date( "Y-m-j" ) );
	$existing_exp_date = DateTime::createFromFormat( "Y-m-j", get_the_author_meta( 'expiration_date', $user_id ) );

	$latest_date = ( $existing_exp_date > $today ) ? $existing_exp_date : $today;

	// echo "<br>TODAY<br>";	var_dump( $today );
	// echo "<br>EXISTING EXP DATE<br>";	var_dump( $existing_exp_date );
	// echo "<br>LATEST DATE<br>";	var_dump( $latest_date );

	switch ( $period ) {	//string since form converts int to str
		case '3':
			$new_exp_date = date_add( $latest_date, date_interval_create_from_date_string("3 months") );
			break;

		case '6':
			$new_exp_date = date_add( $latest_date, date_interval_create_from_date_string("6 months") );
			break;

		case '12':
			$new_exp_date = date_add( $latest_date, date_interval_create_from_date_string("12 months") );
			break;

		default:
			$new_exp_date = $latest_date;
			break;
	}

	// echo "<br>New EXP DATE<br>";	var_dump( $new_exp_date );
	// die();

	$success = update_user_meta( $user_id, 'expiration_date', $new_exp_date->format( "Y-m-j" ) );

	if( $success )
	{
		calc_change_user_type( $user_id );
	}
}

//calculates subs_left and changes user_type either paid or expired; not for date-calc
function calc_change_user_type( $user_id )
{
	$today = new DateTime( date( "Y-m-j" ) );
	$existing_user_type = get_the_author_meta( 'user_type', $user_id );
	$exp_date = DateTime::createFromFormat( "Y-m-j", get_the_author_meta( 'expiration_date', $user_id ) )->settime( 0,0 );
	$subscription_left = ( $exp_date >= $today ) ? true : false;

	if( $subscription_left == true && $existing_user_type != 'paid' )
	{
		update_user_meta( $user_id, 'user_type', 'paid' );
	}

	if( $subscription_left == false && $existing_user_type != 'expired' )
	{
		update_user_meta( $user_id, 'user_type', 'expired' );
	}
}

/*
	========================================================
		Calculate User Remaining Subscription
	========================================================
*/
function calc_user_subs( $user_id )
{
	$today = new DateTime( date( "Y-m-j" ) );
	$exp_date = DateTime::createFromFormat( "Y-m-j", get_the_author_meta( 'expiration_date', $user_id ) )->settime( 0,0 );
	return $today->diff( $exp_date )->format("%R%a");
}

/*
	==========================================================
		Create TRIAL userType and Set Expiration Date after Registration
	==========================================================
*/
add_action( 'user_register', 'create_user_type_after_register', 10, 1 );
function create_user_type_after_register( $user_id )
{
	$existing_user_type = get_the_author_meta( 'user_type', $user_id );
	$existing_exp_date = get_the_author_meta( 'expiration_date', $user_id );

	if( !isset( $existing_user_type ) || $existing_user_type == '' )
	{
		update_user_meta( $user_id, 'user_type', 'trial' );
	}

	if( !isset( $existing_exp_date ) || $existing_exp_date == '' )
	{
		$new_exp_date = date_add( new DateTime( date( "Y-m-j" ) ), date_interval_create_from_date_string("15 days") );

		update_user_meta( $user_id, 'expiration_date', $new_exp_date->format( "Y-m-j" ) );
	}
}



/*
	==========================================================
		Add subpage to Users
	==========================================================
*/
add_action('admin_menu', 'edit_user_subscription');
function edit_user_subscription()
{
	// add_users_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_users_page( 'Edit Users Subscription', 'Subscription Edit', 'edit_users', 'user_subscription', 'edit_subscription_content' );
}

function edit_subscription_content(){
if(!current_user_can('edit_users')){
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}	//end if user is allowed.
	//add any form processing code here in PHP:
	$users = get_users();
	// var_dump( $users );
	// echo $users[0]->{'ID'};
?>

<div style="width:750px;">
<h1><span style="position:relative;top:-7px">Subscription Edit Page</span></h1>

<h3>Select User</h3>
<form name="subscription" class="form-group" action="" method="post">

	<select class="form-control" name="user_list">
		<?php foreach ( $users as $user ) { ?>
			<option value="<?php echo $user->{'ID'} ?>"><?php echo $user->{'user_login'} ?></option>
		<?php } ?>
	</select>
	<select class="form-control" name="time_period">
		<option value="3">3 months</option>
		<option value="6">6 months</option>
		<option value="12">1 year</option>
	</select>

	<input type="submit" name="subscription_submit" value="Confirm">

</form>
<?php
}
//add the rest of your page content above here if it's HTML and below here if it's PHP!
//end pg_building_function function.

if ( isset($_POST['subscription_submit']) )
{
	// echo "<pre>";
	// var_dump( $_POST );
	// die();
	extend_user_exp_date( $_POST['user_list'], $_POST['time_period'] );
}


add_action( 'pre_get_posts', function($q) {
    if( !is_admin() && $q->is_main_query() && $q->is_tax() ) {
        $q->set ('post_type', array( 'page' ) );
    }
});

// remove is singular
// add_filter('redirect_canonical','pif_disable_redirect_canonical');

// function pif_disable_redirect_canonical($redirect_url) {
//     if (is_singular()) $redirect_url = false;
// return $redirect_url;
// }


// Featured post function
function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
?>
<p>
  	<div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Featured this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );
/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
  // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
}
add_action( 'save_post', 'sm_meta_save' );


/* localizing scripts */
wp_enqueue_script( 'custom-ajax-request', '/path/to/settings.js', array( 'jquery' ) );
wp_localize_script( 'custom-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
/*
wpbeginner pagination
*/
function wpbeginner_numeric_posts_nav() {
 
    // if( is_singular() )
    //     return;

    global $query;
 
    /** Stop execution if there's only 1 page */
    if( $query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
}

/*
	==========================================================
		Custom Login function: by CUBIQ
	==========================================================
*/
/**
 * Redirect to the custom login page
 */
function cubiq_login_init () {
	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';

	if ( isset( $_POST['wp-submit'] ) ) {
		$action = 'post-data';
	} else if ( isset( $_GET['reauth'] ) ) {
		$action = 'reauth';
	}

	// redirect to change password form
	// if ( $action == 'rp' || $action == 'resetpass' ) {
	// 	if( isset($_GET['key']) && isset($_GET['login']) ) {
	// 		$rp_path = wp_unslash(home_url('/login/'));
	// 		$rp_cookie	= 'wp-resetpass-' . COOKIEHASH;
	// 		$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
	// 		setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
	// 	}
	//
	// 	wp_redirect( home_url('/login/?action=resetpass') );
	// 	exit;
	// }

	// redirect from LOST PASSWORD page
	if ( $action == 'lostpassword' )
	{
		// wp_redirect( home_url( '/login' ) );
		wp_redirect( home_url( '/?a=lostpassword' ) );
	}

	//redirect from REGISTER PAGE
	if ( $action == 'register' )
	{
		// wp_redirect( home_url( '/login' ) );
		wp_redirect( home_url( '/?a=register' ) );
	}

	// redirect from wrong key when resetting password
	if ( $action == 'lostpassword' && isset($_GET['error']) && ( $_GET['error'] == 'expiredkey' || $_GET['error'] == 'invalidkey' ) ) {
		// wp_redirect( home_url( '/login/?action=forgot&failed=wrongkey' ) );
		wp_redirect( home_url( '/?a=forgot&failed=wrongkey' ) );
		exit;
	}

	if (
		$action == 'post-data'		||			// don't mess with POST requests
		$action == 'reauth'			||			// need to reauthorize
		$action == 'logout'						// user is logging out
	) {
		return;
	}

	// wp_redirect( home_url( '/login/' ) );
	// exit;
}
add_action('login_init', 'cubiq_login_init');

/**
 * Redirect logged in users to the right page
 */
function cubiq_template_redirect () {
	if ( is_page( 'login' ) && is_user_logged_in() ) {
		wp_redirect( home_url(  ) );
		exit();
	}

	if ( is_page( 'user' ) && !is_user_logged_in() ) {
		// wp_redirect( home_url( '/login/' ) );
		wp_redirect( home_url( '/?a=login-error' ) );
		exit();
	}
}
add_action( 'template_redirect', 'cubiq_template_redirect' );


/**
 * Prevent subscribers to access the admin
 */
function cubiq_admin_init () {

	if ( current_user_can( 'subscriber' ) && !defined( 'DOING_AJAX' ) ) {
		// wp_redirect( home_url('/login/') );
		wp_redirect( home_url( '/?a=login' ) );
		exit;
	}
}
add_action( 'admin_init', 'cubiq_admin_init' );

/**
 * Login page redirect
 */
function cubiq_login_redirect ($redirect_to, $url, $user) {

	if ( !isset($user->errors) ) {
		return $redirect_to;
	}

	// if ( $_POST['action'] == 'rp' )
	// {
	// 	return $redirect_to;
	// } else {
	// }
	wp_redirect( home_url( '/?a=login-error' ));
	exit;
}
add_filter('login_redirect', 'cubiq_login_redirect', 10, 3);


// redirect after password change
add_action( 'validate_password_reset', 'rsm_redirect_after_rest', 10, 2 );
function rsm_redirect_after_rest($errors, $user) {
    global $rp_cookie, $rp_path;
    if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
        reset_password( $user, $_POST['pass1'] );
        setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
        wp_set_current_user( $user->ID );
        wp_set_auth_cookie( $user->ID );
        do_action( 'wp_login', $user->user_login );//`[Codex Ref.][1]
        wp_redirect( home_url() );
        exit;
    }
}

/**
 * Send users a notification of new grower posts 
 */
function notify_growers($post) {
// Only notify for grower posts
if ( $post->post_type != 'post' ) return;

$post_id = $post->ID;

$papers = wp_get_post_terms( $post_id, 'newspapers'); 
	$papc = count($papers);
	$ppnames = array();
	for ($i=0; $i < $papc; $i++) { 
		$papname = $papers[$i]->slug;
		$ppnames[] = $papname;
	}
	$paper_names = implode(', ', $ppnames);

	$paper_names = explode(', ', $paper_names);

foreach ($paper_names as $paper) {
	echo $paper;
	add_to_schedule_email( $paper, $post_id );
}

// $user_id = get_current_user_id();
// $user = get_userdata( $user_id );

// $email_content[] = '74';
// update_user_meta( $user->{'ID'}, 'schedule_email', $email_content );

}
add_action( 'draft_to_publish', 'notify_growers' );
add_action( 'new_to_publish', 'notify_growers' );





function js_enqueue_scripts() {
    wp_enqueue_script ("my-ajax-handle", get_stylesheet_directory_uri() . "/assets/js/ajax.js", array('jquery')); 
    //the_ajax_script will use to print admin-ajaxurl in custom ajax.js
    wp_localize_script('my-ajax-handle', 'the_ajax_script', array('ajaxurl' =>admin_url('admin-ajax.php')));
} 
add_action("wp_enqueue_scripts", "js_enqueue_scripts");


add_action('wp_ajax_call_post', 'misha_filter_function');
add_action('wp_ajax_nopriv_call_post', 'misha_filter_function');


function call_post(){

    // Getting the ajax data:
    // An array of keys("name")/values of each "checked" checkbox
    $choices = $_POST['choices'];
    // print_r($choices);

    $meta_query = array('relation' => 'OR');
    foreach($choices as $Key=>$Value){

        if(count($Value)){
            foreach ($Value as $Inkey => $Invalue) {
                $meta_query[] = array( 'key' => $Key, 'value' => $Invalue, 'compare' => '=' );
            }
        }
    }
    $args = array(
        'post_type' => 'post',
        'meta_query' =>$meta_query
    );

    $query = new WP_Query($args);
     //if( ! empty ($params['template'])) {
         ////$template = $params['template'];
         if( $query->have_posts() ) :
             while( $query->have_posts() ): $query->the_post();
             	echo "hello world !!";
                 get_template_part('content');
             endwhile;
             wp_reset_query();
         else :
             wp_send_json($query->posts);
         endif;
     //}

    // die();
}


function my_enqueue() {

    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/my-ajax-script.js', array('jquery') );

    wp_localize_script( 'ajax-script', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );




/*
	==========================================================
		Add subpage to Users for Contact form
	==========================================================
*/
add_action('admin_menu', 'edit_user_subscriptions');
function edit_user_subscriptions()
{
	// add_users_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_users_page( 'View Contact Form', 'View Contact Records', 'edit_users', 'user_records', 'edit_subscription_contents' );
}

function edit_subscription_contents(){
if(!current_user_can('edit_users')){
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}	//end if user is allowed.
	//add any form processing code here in PHP:
	$users = get_users();
	// var_dump( $users );
	// echo $users[0]->{'ID'};
	global $wpdb;
	$table="wp_contactus";
	$res = $wpdb->get_results("SELECT * FROM wp_contactus ORDER BY id desc",ARRAY_A);
	?>

<div style="margin-top: 14px;">
	<h2>Contact Form Records:</h2>
	<table class="wp-list-table widefat fixed striped users"  style="padding: 8px;">
		<thead>
			<th width="5%">S.N.</th>
			<th>Company Name</th>
			<th>Contact Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Tender Name</th>
			<th>Tender Link</th>
			<th>Urgency</th>
			<th>Insert Date</th>
		</thead>
		<tbody>
			<?php
			$kk = 1;
			foreach ($res as $data) {
				echo '<tr>';
				echo '<td>'.$kk.' - '.$data['id'].'</td>';
				echo '<td>'.$data['company_name'].'</td>';
				echo '<td>'.$data['contact_name'].'</td>';
				echo '<td>'.$data['email'].'</td>';
				echo '<td>'.$data['phone_no'].'</td>';
				echo '<td>'.$data['tender_name'].'</td>';
				echo '<td>'.$data['tender_link'].'</td>';
				echo '<td>'.$data['urgency'].'</td>';
				echo '<td>'.$data['inserted_date'].'</td>';
				echo '<td><a href="#" class="btn_del" id="'.$data['id'].'">Delete</a></td>';
				echo '</tr>';

			$kk++; } ?>
		</tbody>
	</table>
<script src="<?php bloginfo('template_url') ?>/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";

	$(".btn_del").click(function() {
		var el = this;
		var rec_id = this.id;

  		var r=confirm("Confirm Delete this Data?"+rec_id)
        if (r==true)
       	// console.log(rec_id);
       	$.ajax({
       		url: ajaxUrl,
           action: 'delete_contact_records',
           type: 'POST',
           data: { id:rec_id },
           success: function(response){

             // Removing row from HTML Table
             if(response == 1){
				$(el).closest('tr').css('background','tomato');
		                $(el).closest('tr').fadeOut(800,function(){
				   $(this).remove();
				});
		     }else{
		     	$(el).closest('tr').css('background','tomato');
				alert('Record not deleted.');
		     }
           }
         });

      
        else
          return false;
	});
});

// jQuery(document).on('click', '.btn_del', function () {
//     var id = this.id;
//     jQuery.ajax({
//         type: 'POST',
//         url: ajaxurl,
//         data: {"action": "delete_row", "element_id": id},
//         success: function (data) {
//             //run stuff on success here.  You can use `data` var in the 
//            //return so you could post a message.  
//         }
//     });
// });


</script>
</div>
<?php
}
// ends here

add_action('wp_ajax_delete_contact_records', 'delete_contact_records');
 add_action('wp_ajax_nopriv_delete_contact_records', 'delete_contact_records'); 

function delete_contact_records(){
	if(isset($_POST['id'])){
   $id=  $_POST['id'];
   global $wpdb;
   $wpdb->query(
              'DELETE  FROM wp_contactus
               WHERE id = "'.$id.'"'
	);
   echo 1;
   exit;
}
echo 0;
exit;
}

/*
	==========================================================
		Add subpage to Proposal writing helps
	==========================================================
*/
add_action('admin_menu', 'edit_proposal_writing_support_form');
function edit_proposal_writing_support_form()
{
	// add_users_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_users_page( 'View Proposal Writing Support', 'View Proposal Writing Records', 'edit_users', 'proposal_records', 'edit_proposal_contents' );
}

function edit_proposal_contents(){
if(!current_user_can('edit_users')){
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}	//end if user is allowed.
	//add any form processing code here in PHP:
	$users = get_users();
	// var_dump( $users );
	// echo $users[0]->{'ID'};
	global $wpdb;
	$table="wp_proposal_writing_support";
	$res = $wpdb->get_results("SELECT * FROM wp_proposal_writing_support ORDER BY id desc",ARRAY_A);
	?>

<div style="margin-top: 14px;">
	<h2>Proposal Writing Support Records:</h2>
	<table class="wp-list-table widefat fixed striped users"  style="padding: 8px;">
		<thead>
			<th width="5%">S.N.</th>
			<th>Company Name</th>
			<th>Contact Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			
			<th>Proposal Link</th>
			<th>Baseline Data</th>
			<th>Budget Volume</th>
			<th>No of Pages</th>
			<th>Insert Date</th>
		</thead>
		<tbody>
			<?php
			$kk = 1;
			foreach ($res as $data) {
				echo '<tr>';
				echo '<td>'.$kk.'</td>';
				echo '<td>'.$data['company_name'].'</td>';
				echo '<td>'.$data['contact_name'].'</td>';
				echo '<td>'.$data['email'].'</td>';
				echo '<td>'.$data['contact_numnber'].'</td>';
				
				echo '<td>'.$data['proposal_link'].'</td>';
				echo '<td>'.$data['baseline'].'</td>';
				echo '<td>'.$data['budget_volume'].'</td>';
				echo '<td>'.$data['pages_number'].'</td>';
				echo '<td>'.$data['inserted_date'].'</td>';
				// echo '<td><a href="#" class="btn_del" id="'.$data['id'].'">Delete</a></td>';
				echo '</tr>';

			$kk++; } ?>
		</tbody>
	</table>

</div>
<?php
}
// ends here

function delete_qq(){
	global $wpdb;
	$wpdb->query('DELETE * FROM wp_contactus WHERE id = 1');
}
function delete_row() {
    $id = explode('_', sanitize_text($_POST['element_id']));
    if (wp_verify_nonce($id[2], $id[0] . '_' . $id[1])) {
                $table = 'wp_contactus';
        $wpdb->delete( $table, array( 'id' => $id[1] ) );

        echo 'Deleted post';
        die;
    } else {
        echo 'Nonce not verified';
        die;
    }
}
add_action('wp_ajax_your_delete_action', 'delete_row');
add_action( 'wp_ajax_nopriv_your_delete_action', 'delete_row');




// filter data
function filter_tender_posts(){
	$pub_date         = $_POST['pub_date'];
	$end_date         = $_POST['end_date'];
	$fname         = $_POST['fname'];

	global $wpdb;
	$table_name = 'wp_test';
	$entry = $wpdb->insert($table_name, array(
						 'pub_date' 	=> $pub_date, 
					 	 'end_date'			=>  $end_date,
				 		 'fname'		=>	$fname,
						 )
	 );
	print_r($_POST);
	// die;
}

// if( isset($_POST['filter_submit']) )
// {
// 	filter_tender_posts();
// }

// function ajax_filter_posts_scripts() {
//   // Enqueue script
//   wp_register_script('afp_script', get_template_directory_uri() . '/js/ajax-filter-posts.js', false, null, false);
//   wp_enqueue_script('afp_script');

//   wp_localize_script( 'afp_script', 'afp_vars', array(
//         'afp_nonce' => wp_create_nonce( 'afp_nonce' ), // Create nonce which we later will use to verify AJAX request
//         'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
//       )
//   );
// }
// add_action('wp_enqueue_scripts', 'ajax_filter_posts_scripts', 100);


add_action('wp_ajax_myfilter', 'misha_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');
 
function misha_filter_function(){
	$card = $_POST['card'];
	$list = $_POST['list'];

	if($_POST['expired'] == 0){
		$exp_comp = '<=';
	}elseif($_POST['expired'] == 1){
		$exp_comp = '<=';
	}else{
		$exp_comp = '<=';
	}

	$date = date("Y-m-d");

	$args = array(
		'orderby' => 'date', // we will sort posts by date
		'order'	=> $_POST['date'], // ASC or DESC
		'meta_query' => array(
		        array(
		            'key' => 'submission_date_eng',
		            'value' => $date,
		            'type' => 'DATE',
					'compare' => $exp_comp,
		        	)		    		
	 			)
	);
	// echo '<pre>';
	// print_r($_POST);
	// echo '</pre>';
	// for taxonomies / categories
	if( isset( $_POST['categoryfilter'] ) )
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $_POST['categoryfilter']
			)
		);

	if( isset( $_POST['papers'] ) )
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'newspapers',
				'field' => 'id',
				'terms' => $_POST['papers']
			)
		);

		$args['meta_query'] = array( 'relation'=>'OR' ); // AND means that all conditions of meta_query should be true
 
 // create $args['meta_query'] array if one of the following fields is filled
	if( isset( $_POST['pub_date_from'] ) && $_POST['pub_date_from'] || isset( $_POST['pub_date_to'] ) && $_POST['pub_date_to'] ){

		$args['meta_query'] = array( 'relation'=>'AND' ); 

		if( isset( $_POST['pub_date_from'] ) && $_POST['pub_date_from'] && isset( $_POST['pub_date_to'] ) && $_POST['pub_date_to'] ) {
		$args['meta_query'][] = array(
			'key' => 'published_date_eng',
			'value' => array( $_POST['pub_date_from'], $_POST['pub_date_to'] ),
			'type' => 'DATE',
			'compare' => 'between'
		);
	} else {
		// if only min price is set
		if( isset( $_POST['pub_date_from'] ) && $_POST['pub_date_from'] )
			$args['meta_query'][] = array(
				'key' => 'published_date_eng',
				'value' => $_POST['pub_date_from'],
				'type' => 'DATE',
				'compare' => '>='
			);
 
		// if only max price is set
		if( isset( $_POST['pub_date_to'] ) && $_POST['pub_date_to'] )
			$args['meta_query'][] = array(
				'key' => 'published_date_eng',
				'value' => $_POST['pub_date_to'],
				'type' => 'DATE',
				'compare' => '<='
			);
		}
	}

	// create $args['meta_query'] array if one of the following fields is filled
	if( isset( $_POST['pub_date_from1'] ) && $_POST['pub_date_from1'] || isset( $_POST['pub_date_to1'] ) && $_POST['pub_date_to1'] ){

		$args['meta_query'] = array( 'relation'=>'AND' ); 

		if( isset( $_POST['pub_date_from1'] ) && $_POST['pub_date_from1'] && isset( $_POST['pub_date_to1'] ) && $_POST['pub_date_to1'] ) {
		$args['meta_query'][] = array(
			'key' => 'published_date',
			'value' => array( $_POST['pub_date_from1'], $_POST['pub_date_to1'] ),
			'type' => 'DATE',
			'compare' => 'between'
		);
	} else {
		// if only min price is set
		if( isset( $_POST['pub_date_from1'] ) && $_POST['pub_date_from1'] )
			$args['meta_query'][] = array(
				'key' => 'published_date',
				'value' => $_POST['pub_date_from1'],
				'type' => 'DATE',
				'compare' => '>='
			);
 
		// if only max price is set
		if( isset( $_POST['pub_date_to1'] ) && $_POST['pub_date_to1'] )
			$args['meta_query'][] = array(
				'key' => 'published_date',
				'value' => $_POST['pub_date_to1'],
				'type' => 'DATE',
				'compare' => '<='
			);
		}
	}

// submission date english query
if( isset( $_POST['sub_date_from'] ) && $_POST['sub_date_from'] && isset( $_POST['sub_date_to'] ) && $_POST['sub_date_to'] ) {
	
	$args['meta_query'] = array( 'relation'=>'AND' );

	if( isset( $_POST['sub_date_from'] ) && $_POST['sub_date_from'] && isset( $_POST['sub_date_to'] ) && $_POST['sub_date_to'] ) {

		$args['meta_query'][] = array(
			'key' => 'submission_date_eng',
			'value' => array( $_POST['sub_date_from'], $_POST['sub_date_to'] ),
			'type' => 'DATE',
			'compare' => 'between'
		);
	} else {
		// if only min price is set
		if( isset( $_POST['sub_date_from'] ) && $_POST['sub_date_from'] )
			$args['meta_query'][] = array(
				'key' => 'submission_date_eng',
				'value' => $_POST['sub_date_from'],
				'type' => 'DATE',
				'compare' => '>='
			);
 
		// if only max price is set
		if( isset( $_POST['sub_date_to'] ) && $_POST['pub_date_to'] )
			$args['meta_query'][] = array(
				'key' => 'submission_date_eng',
				'value' => $_POST['sub_date_to'],
				'type' => 'DATE',
				'compare' => '<='
			);
	}
}

// nepali submission date
	if( isset( $_POST['sub_date_from1'] ) && $_POST['sub_date_from1'] && isset( $_POST['sub_date_to1'] ) && $_POST['sub_date_to1'] ) {

	$args['meta_query'] = array( 'relation'=>'AND' );

	if( isset( $_POST['sub_date_from1'] ) && $_POST['sub_date_from1'] && isset( $_POST['sub_date_to1'] ) && $_POST['sub_date_to1'] ) {

		$args['meta_query'][] = array(
			'key' => 'expiry_date',
			'value' => array( $_POST['sub_date_from1'], $_POST['sub_date_to1'] ),
			'type' => 'DATE',
			'compare' => 'between'
		);
	} else {
		// if only min price is set
		if( isset( $_POST['sub_date_from1'] ) && $_POST['sub_date_from1'] )
			$args['meta_query'][] = array(
				'key' => 'expiry_date',
				'value' => $_POST['sub_date_from1'],
				'type' => 'DATE',
				'compare' => '>='
			);
 
		// if only max price is set
		if( isset( $_POST['sub_date_to1'] ) && $_POST['pub_date_to1'] )
			$args['meta_query'][] = array(
				'key' => 'expiry_date',
				'value' => $_POST['sub_date_to1'],
				'type' => 'DATE',
				'compare' => '<='
			);
	}
}
 
	$query = new WP_Query( $args );
 	
 	$g=1;
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
		$cat_id = get_the_ID();

		$meta = get_post_meta($cat_id);
		// print_r($meta);
		$cat_names = $paper_names = $ind_names = $published_date = $expiry = '-';
			
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

    
    // check different date type
		if(isset($_POST['pub_date_from']) || isset($_POST['sub_date_from'])){
			$published_date = get_post_meta( $cat_id, 'published_date_eng' , true );
			$expiry = get_post_meta( $cat_id, 'submission_date_eng' , true );
		}else{
			$published_date = get_post_meta( $cat_id, 'published_date' , true );
			$expiry = get_post_meta( $cat_id, 'expiry_date' , true );
		}
		// $published_date = get_post_meta( $cat_id, 'published_date' , true );
		$p_date = get_post_meta( $cat_id, 'submission_date_eng' , true );
		// $expiry = get_post_meta( $cat_id, 'expiry_date' , true );

		$today = new DateTime(date("Y-m-j"));
		if($p_date){
	        $sd = DateTime::createFromFormat( "Y-m-d", $p_date )->settime(0,0);
	        $diff = $today->diff($sd)->format("%R%a");
		}

		// check if which tabs to append; card or list
		// if($list == '1'){
			/*echo '<tr>';
				echo '<td>'.$g.'</td>';
				echo '<td>'.$publisher.'</td>';
				echo '<td>'.get_the_title().'</td>';
				echo '<td>'.$published_date.'</td>';
				echo '<td>'.$expiry.'</td>';
				echo '<td>'.$cat_names.'</td>';
				echo '<td>'.$paper_names.'</td>';
				echo '<td>'.$ind_names.'</td>'; ?>
				<td width="">
				<?php
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
				?>
				</td>
				<td>
				<?php
				if ( has_post_thumbnail() ) { ?>
				    <!-- <figure> <a href="" data-toggle="modal" data-target="#image_modal<?= $im;?>"><?php the_post_thumbnail( array( 50, 50 ) , array('class' => 'post-thumbnail-mains')); ?></a> </figure> -->
				    <figure><a class="btn_clk" data-img="<?= $cat_id; ?>" ><?php the_post_thumbnail( array( 50, 50 ) , array('class' => 'post-thumbnail-mains')); ?></a></figure>
				<?php }
				?>
			</td>
			<?php echo '</tr>';*/
		// }else{
		// 	echo get_the_title();
		// }
	if( $diff >= 0){
		switch ( substr( $diff, 1 ) ) {
			case 0:
				$status = 'Ending Today';
				break;

			case 1:
				$status = substr( $diff, 1 ) . ' day';
				break;

			default:
				$status = substr( $diff, 1 ) . ' days';
				break;
			}
		} else {
			$status = "<span style='color:red'>Expired</span>";
		}

		if ( has_post_thumbnail() ) { 
			$img = get_the_post_thumbnail_url( );
		}else{
			$img = get_template_directory_uri().'/img/unnamed.png';
		}
		$data = array(
            "publisher"     => $publisher,
            "title"  => mb_strimwidth(get_the_title(), 0, 25, '...'),
            "link"  => get_the_permalink(),
            "published_date"   => $published_date,
            "expiry_date" => $expiry,
            "category"   => mb_strimwidth($cat_names, 0, 25, '...'),
            "paper_names" => mb_strimwidth($paper_names, 0, 25, '...'),
            "ind_names" => mb_strimwidth($ind_names, 0, 25, '...'),
            "status" => $status,
            "post_id" => $cat_id,
            "img" => $img,
        );
        $temp[] = $data;


		$g++; endwhile;
		wp_reset_postdata();

		echo json_encode($temp);die;
	else :
		echo 'No posts found';
	endif;


 ?>

 <script type="text/javascript">
 	$(document).ready(function() {
$(".btn_clk").click( function(){
    	val = $(this).data("img");
    	// alert(val);
    	var values = {
            'post_id' : val
        };

        $('#img_modal').modal('show');
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_info_by_id.php",
          // dataType: 'JSON',
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $(".response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('.response').html(errorMsg);
			}
         });
   	});
});
 </script>
	<?php die();
}



// ajax pagination home page
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
 add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback'); 

function load_posts_by_ajax_callback(){
    // $check_ajax_referer('load_more_posts', 'security');
    $paged = 1;
    $paged = $_POST["page"];
	$date = date("Y-m-d");

if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	$role = $user->roles[0];

	if( is_super_admin() || $role == 'Editor' || $role == 'Subscriber' || $role == 'Contributor') : 
		
		$comp = '>=';
	else:
		$t = get_user_meta($user_id);
		$subs = $t['user_type'][0];		

		if($subs == 'paid'){
			$comp = '>=';
		}elseif($subs == 'trial'){
			$comp = '>=';
		}else{
			$comp = '>=';
		}
	endif;
else:
	$comp = '<=';
endif;

    $args = array(
    	'orderby' => 'meta_value_num',
		'order' => 'ASC',
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $paged,
        'meta_query' => array(
	        array(
	            'key' => 'submission_date_eng',
	            'value' => $date,
	            'type' => 'DATE',
				'compare' => $comp,
	        	)		    		
 			)	
        
    );
	$cat_posts= new WP_query($args);

require('parts/loadmore_home_card.php');

    

    ?>

    <script type="text/javascript">
    	$(document).ready(function() {

    	var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = 1; // What page we are on.
    var ppp = 3; // Post per page
 $(".more_posts").click( function(){ 
 	// $( "#outer" ).mouseover(function() {
        $(".more_posts").attr("disabled",true); // Disable the button, temp.
        id = $(this).data("id");

        // alert(ajaxUrl);
		$('html, body').animate({
	        scrollTop: $("#outer1").offset().top -270
	    }, 'slow'); // scroll to div

   		$('.loading_img').show();
		var data = {
			'action': 'load_posts_by_ajax',
			'page': id,
			// 'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
		};

		$.post(ajaxUrl, data, function(response){
			// $('.my-posts').append(response);
			$('.resp_card').html(response).hide().fadeIn(1500);
			$('.loading_img').hide();
			page++;
			

		});
	});

 $(".btn_clk").click( function(){
    	val = $(this).data("img");
    	// alert(val);
    	var values = {
            'post_id' : val
        };

        $('#img_modal').modal('show');
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_info_by_id.php",
          // dataType: 'JSON',
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $(".response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('.response').html(errorMsg);
			}
         });
   	});

});
    </script>

<?php    exit; 
} 



// ajax pagination home page
add_action('wp_ajax_load_posts_by_cat_ajax', 'load_posts_by_cat_ajax_callback');
 add_action('wp_ajax_nopriv_load_posts_by_cat_ajax', 'load_posts_by_cat_ajax_callback'); 

function load_posts_by_cat_ajax_callback(){
    // $check_ajax_referer('load_more_posts', 'security');
    $paged = 1;
    $paged = $_POST["page"];
    $taxonomy = $_POST["taxonomy"];
    echo $taxonomy;
	$date = date("Y-m-d");

if( is_user_logged_in() ) : 
	$user_id = get_current_user_id();
	$user = get_userdata( $user_id );
	$role = $user->roles[0];

	if( is_super_admin() || $role == 'Editor' || $role == 'Subscriber' || $role == 'Contributor') : 
		
		$comp = '>=';
	else:
		$t = get_user_meta($user_id);
		$subs = $t['user_type'][0];		

		if($subs == 'paid'){
			$comp = '>=';
		}elseif($subs == 'trial'){
			$comp = '>=';
		}else{
			$comp = '>=';
		}
	endif;
else:
	$comp = '<=';
endif;

    $args = array(
    	'orderby' => 'meta_value_num',
		'order' => 'ASC',
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $paged,
        'meta_query' => array(
	        array(
	            'key' => 'submission_date_eng',
	            'value' => $date,
	            'type' => 'DATE',
				'compare' => $comp,
	        	)		    		
 			),
 		'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $slug,
                
            ),
        ),	
        
    );
	$cat_posts= new WP_query($args);

require('parts/loadmore_cat_card.php');

    

    ?>

    <script type="text/javascript">
    	$(document).ready(function() {

    	var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = 1; // What page we are on.
    var ppp = 3; // Post per page
 $(".more_posts").click( function(){ 
 	// $( "#outer" ).mouseover(function() {
        $(".more_posts").attr("disabled",true); // Disable the button, temp.
        id = $(this).data("id");

        // alert(ajaxUrl);
		$('html, body').animate({
	        scrollTop: $("#outer1").offset().top -270
	    }, 'slow'); // scroll to div

   		$('.loading_img').show();
		var data = {
			'action': 'load_posts_by_ajax',
			'page': id,
			// 'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
		};

		$.post(ajaxUrl, data, function(response){
			// $('.my-posts').append(response);
			$('.resp_card').html(response).hide().fadeIn(1500);
			$('.loading_img').hide();
			page++;
			

		});
	});

 $(".btn_clk").click( function(){
    	val = $(this).data("img");
    	// alert(val);
    	var values = {
            'post_id' : val
        };

        $('#img_modal').modal('show');
      	// console.log(values);
        $.ajax({
          type: "POST",
          url: "<?= bloginfo('template_url') ?>/parts/fetch_info_by_id.php",
          // dataType: 'JSON',
          data: values,
          success: function(resp){
          
        // $('.mdl-response').show();
        $(".response").html(resp);
           },
           error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Image Request Failed: ' + xhr.responseText;
                    $('.response').html(errorMsg);
			}
         });
   	});

});
    </script>

<?php    exit; 
} 

?>