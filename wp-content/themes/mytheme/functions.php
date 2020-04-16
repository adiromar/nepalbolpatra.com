<?php 
use PHPMailer\PHPMailer\PHPMailer;


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
            <input id="datepicker1" name="published_date" type="text" value="<?php echo get_post_meta($object->ID, "published_date", true); ?>" placeholder="PublishedDate" class="form-control nepali-calendar" autocomplete="off" required>
        </div>
        <br>
        <div class="col-md-12">
        	<label>Last Date of Submission <span style="color: red"><b>*</b>:</label>
            <input id="nepaliDate" name="expiry_date" type="text" value="<?php echo get_post_meta($object->ID, "expiry_date", true); ?>" placeholder="Expiry Date" class="form-control nepali-calendar">
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
		Add Custom Interest Field on User Profile
	=====================================
*/
add_action('show_user_profile', 'extra_user_profile_fields');
add_action('edit_user_profile', 'extra_user_profile_fields');
//show "INTEREST" extra field for each User on their PROFILE PAGE
function extra_user_profile_fields( $user ) { ?>
	<?php
	global $wpdb;
	$res = $wpdb->get_results("SELECT * FROM wp_addproduct",ARRAY_A);
            foreach($res as $data)
              { ?>
                <div style="padding-left:50px;">
		<label>
			<input type="checkbox" name="<?php echo $data['product_name'] ;?>" value="1" <?php if( get_the_author_meta( 'interest-'.$data['product_name'], $user->ID ) == 1 ) echo "checked"; ?> >
		</label>
		<strong><?php echo $data['product_name'] ;?></strong>
		</div>
		<?php } 

		// new terms or category lists
		$terms = get_terms( array(
    		'taxonomy' => 'products',
    		'hide_empty' => false,
		) );

		foreach ($terms as $data) { ?>
			<div style="padding-left:50px;">
		<label>
			<input type="checkbox" name="<?php echo $data->name ;?>" value="1">
			<strong><?php echo $data->name ;?></strong>
		</label>
		
		</div>
		<?php }

}

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
	$res = $wpdb->get_results("SELECT * FROM wp_addproduct",ARRAY_A);
	        foreach($res as $data)
	        {
	            update_user_meta( $user_id, 'interest-' .$data['product_name'], $_POST[$data['product_name']] );
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

function wpbeginner_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
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
?>