<?php
// Adding Custom Post Type : Team
add_action('init', 'team_register', 0);
function team_register() {
	$labels = array(
		'name'				=> esc_html__('Team', 'collective'),
		'singular_name'		=> esc_html__('Team Member', 'collective'),
		'add_new'			=> esc_html__('Add New Member', 'collective'),
		'add_new_item'		=> esc_html__('Add New Member', 'collective'),
		'edit_item'			=> esc_html__('Edit Member', 'collective'),
		'new_item'			=> esc_html__('New Team Post Item', 'collective'),
		'view_item'			=> esc_html__('View Team Item', 'collective'),
		'search_items'		=> esc_html__('Search Team', 'collective'),
		'not_found'			=> esc_html__('Nothing found', 'collective'),
		'not_found_in_trash'=> esc_html__('Nothing found in Trash', 'collective'),
		'parent_item_colon'	=> ''
	);
 
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'menu_position' 	=> 5,
		'exclude_from_search'=> true,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'show_in_nav_menus' => false,
		'hierarchical'		=> false,
		'rewrite'			=> true,
		'query_var'			=> true,
		'menu_icon'			=> '',  	  		
		'supports'			=> array('title', 'editor', 'author', 'excerpt', 'thumbnail', 'comments'),
		'has_archive' 		=> true,
	); 
	register_post_type( 'team' , $args );
	
	// Initialize New Taxonomy Labels  
	$labels = array(  
		'name' 				=> esc_html__( 'Categories', 'collective' ),  
		'singular_name' 	=> esc_html__( 'Category', 'collective' ),  
		'search_items' 		=> esc_html__( 'Search Categories', 'collective' ),  
		'all_items' 		=> esc_html__( 'All Categories', 'collective' ),  
		'parent_item' 		=> esc_html__( 'Parent Category', 'collective' ),  
		'parent_item_colon' => esc_html__( 'Parent Category:', 'collective' ),  
		'edit_item' 		=> esc_html__( 'Edit Categories', 'collective' ),  
		'update_item' 		=> esc_html__( 'Update Category', 'collective' ),  
		'add_new_item' 		=> esc_html__( 'Add New Category', 'collective' ),  
		'new_item_name' 	=> esc_html__( 'New Category Name', 'collective' ),  
	);  
	// Custom taxonomy for team categories 
	register_taxonomy('category-team', array('team'), array(  
		'hierarchical' 		=> true,  
		'labels' 			=> $labels,  
		'show_ui' 			=> true,  
		'query_var' 		=> true,  
		'rewrite' 			=> array( 'slug' => 'category-team' ),  
	)); 
}

// Default title text
function team_title( $title ){
    $screen = get_current_screen();
    if ( 'team' == $screen->post_type ) {
        $title = 'Team Member Name';
    }
    return $title;
}
add_filter( 'enter_title_here', 'team_title' );

// Custom dashboard icon
function menu_font_admin_init() {
   wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/organic-shortcodes/css/font-awesome.css', array(), '1.0' ); 
}
add_action('admin_init', 'menu_font_admin_init');

function add_menu_icons_styles(){
	?>
	 
	<style>
		#adminmenu .menu-icon-team div.wp-menu-image:before {
			font-family: 'FontAwesome';
			content: '\f0c0';
		}
	</style>
	 
	<?php
	}
add_action( 'admin_head', 'add_menu_icons_styles' );

// Adding Custom Meta Information
add_action('add_meta_boxes', 'team_add_custom_box');
function team_add_custom_box() {
    add_meta_box('team_info', 'Team Member Information', 'team_box', 'team', 'normal', 'high');
}

function team_box() {
	$team_title = '';
	if ( isset($_REQUEST['post']) ) {
	    $team_title = get_post_meta((int)$_REQUEST['post'],'team_title',true); 
	}
	$team_link = '';
    if ( isset($_REQUEST['post']) ) {
        $team_link = get_post_meta((int)$_REQUEST['post'],'team_link',true); 
    }
    $team_email = '';
    if ( isset($_REQUEST['post']) ) {
        $team_email = get_post_meta((int)$_REQUEST['post'],'team_email',true); 
    }
    $team_facebook = '';
    if ( isset($_REQUEST['post']) ) {
        $team_facebook = get_post_meta((int)$_REQUEST['post'],'team_facebook',true); 
    }
    $team_twitter_name = '';
    if ( isset($_REQUEST['post']) ) {
        $team_twitter_name = get_post_meta((int)$_REQUEST['post'],'team_twitter_name',true); 
    }
    $team_twitter_link = '';
    if ( isset($_REQUEST['post']) ) {
        $team_twitter_link = get_post_meta((int)$_REQUEST['post'],'team_twitter_link',true); 
    }
    $team_twitter_id = '';
    if ( isset($_REQUEST['post']) ) {
        $team_twitter_id = get_post_meta((int)$_REQUEST['post'],'team_twitter_id',true); 
    }
    $team_google = '';
    if ( isset($_REQUEST['post']) ) {
        $team_google = get_post_meta((int)$_REQUEST['post'],'team_google',true); 
    }
    $team_linkedin = '';
    if ( isset($_REQUEST['post']) ) {
        $team_linkedin = get_post_meta((int)$_REQUEST['post'],'team_linkedin',true); 
    }
    $team_dribbble = '';
    if ( isset($_REQUEST['post']) ) {
        $team_dribbble = get_post_meta((int)$_REQUEST['post'],'team_dribbble',true); 
    }
    $team_github = '';
    if ( isset($_REQUEST['post']) ) {
        $team_github = get_post_meta((int)$_REQUEST['post'],'team_github',true); 
    }
?>

<style>
	#team_info .team_field {
		margin-top: 12px;
		margin-bottom: 12px;
		}
	#team_info label { 
		display: block; 
		width: 24%; 
		float: left; 
		padding-top: 8px; 
		padding-right: 12px; 
		text-align: right; 
		}
	#team_info div input { 
		height: 36px; 
		width: 72%;
		}
	@media only screen and (max-width: 767px) {
		#team_info label { 
			text-align: left;
			padding: 6px 0px;
			}
		#team_info label,
		#team_info div input { 
			width: 100%;
			}
		}
</style>

<div id="team_info">

<div class="team_field">
<label for="team_title"><?php esc_html_e("Member Title", 'collective'); ?></label>
<input id="team_title" class="widefat" name="team_title" value="<?php echo $team_title; ?>" type="text">
</div>

<div class="team_field">
<label for="team_link"><?php esc_html_e("Personal Site", 'collective'); ?></label>
<input id="team_link" class="widefat" name="team_link" value="<?php echo $team_link; ?>" type="text">
</div>

<div class="team_field">
<label for="team_email"><?php esc_html_e("Email Address", 'collective'); ?></label>
<input id="team_email" class="widefat" name="team_email" value="<?php echo $team_email; ?>" type="text">
</div>

<div class="team_field">
<label for="team_facebook"><?php esc_html_e("Facebook Page", 'collective'); ?></label>
<input id="team_facebook" class="widefat" name="team_facebook" value="<?php echo $team_facebook; ?>" type="text">
</div>

<div class="team_field">
<label for="team_twitter_name"><?php esc_html_e("Twitter Name", 'collective'); ?></label>
<input id="team_twitter_name" class="widefat" name="team_twitter_name" value="<?php echo $team_twitter_name; ?>" type="text">
</div>

<div class="team_field">
<label for="team_twitter_link"><?php esc_html_e("Twitter Profile URL", 'collective'); ?></label>
<input id="team_twitter_link" class="widefat" name="team_twitter_link" value="<?php echo $team_twitter_link; ?>" type="text">
</div>

<div class="team_field">
<label for="team_twitter_id"><?php esc_html_e("Twitter Widget ID", 'collective'); ?></label>
<input id="team_twitter_id" class="widefat" name="team_twitter_id" value="<?php echo $team_twitter_id; ?>" type="text">
</div>

<div class="team_field">
<label for="team_google"><?php esc_html_e("Google Plus Profile URL", 'collective'); ?></label>
<input id="team_google" class="widefat" name="team_google" value="<?php echo $team_google; ?>" type="text">
</div>

<div class="team_field">
<label for="team_linkedin"><?php esc_html_e("LinkedIn Profile URL", 'collective'); ?></label>
<input id="team_linkedin" class="widefat" name="team_linkedin" value="<?php echo $team_linkedin; ?>" type="text">
</div>

<div class="team_field">
<label for="team_dribbble"><?php esc_html_e("Dribbble Profile URL", 'collective'); ?></label>
<input id="team_dribbble" class="widefat" name="team_dribbble" value="<?php echo $team_dribbble; ?>" type="text">
</div>

<div class="team_field">
<label for="team_github"><?php esc_html_e("Github Profile URL", 'collective'); ?></label>
<input id="team_github" class="widefat" name="team_github" value="<?php echo $team_github; ?>" type="text">
</div>

</div>

<?php
}
add_action('save_post','team_save_meta');
function team_save_meta($postID) {
    if ( is_admin() ) {
    	if ( isset($_POST['team_title']) ) {
    	    update_post_meta($postID,'team_title',
    	                        $_POST['team_title']);
    	}
        if ( isset($_POST['team_link']) ) {
            update_post_meta($postID,'team_link',
                                $_POST['team_link']);
        }
        if ( isset($_POST['team_email']) ) {
            update_post_meta($postID,'team_email',
                                $_POST['team_email']);
        }
        if ( isset($_POST['team_facebook']) ) {
            update_post_meta($postID,'team_facebook',
                                $_POST['team_facebook']);
        }
        if ( isset($_POST['team_twitter_name']) ) {
            update_post_meta($postID,'team_twitter_name',
                                $_POST['team_twitter_name']);
        }
        if ( isset($_POST['team_twitter_link']) ) {
            update_post_meta($postID,'team_twitter_link',
                                $_POST['team_twitter_link']);
        }
        if ( isset($_POST['team_twitter_id']) ) {
            update_post_meta($postID,'team_twitter_id',
                                $_POST['team_twitter_id']);
        }
        if ( isset($_POST['team_google']) ) {
            update_post_meta($postID,'team_google',
                                $_POST['team_google']);
        }
        if ( isset($_POST['team_linkedin']) ) {
            update_post_meta($postID,'team_linkedin',
                                $_POST['team_linkedin']);
        }
        if ( isset($_POST['team_dribbble']) ) {
            update_post_meta($postID,'team_dribbble',
                                $_POST['team_dribbble']);
        }
        if ( isset($_POST['team_github']) ) {
            update_post_meta($postID,'team_github',
                                $_POST['team_github']);
        }

    }
}
?>