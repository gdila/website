<?php
/**
* Theme customizer with real-time update
*
* Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
*
* @package Collective
* @since Collective 2.0
*/
function collective_theme_customizer( $wp_customize ) {

	// Category Dropdown Control
	class Collective_Category_Dropdown_Control extends WP_Customize_Control {
	public $type = 'dropdown-categories';

	public function render_content() {
		$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => esc_html__( '&mdash; Select &mdash;', 'collective' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}

	// Custom Taxonomy Dropdown Control
	class Collective_Taxonomy_Dropdown_Control extends WP_Customize_Control {
	public $type = 'dropdown-taxonomy';

	public function render_content() {
		$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => esc_html__( '&mdash; Select &mdash;', 'collective' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
					'taxonomy' 			=> 'category-team',
				)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}

	// Numerical Control
	class Collective_Customizer_Number_Control extends WP_Customize_Control {

		public $type = 'number';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
			</label>
			<?php
		}

	}

	function collective_sanitize_categories( $input ) {
		$categories = get_terms( 'category', array('fields' => 'ids', 'get' => 'all') );

	   if ( in_array( $input, $categories ) ) {
	       return $input;
	   } else {
	   	return '';
	   }
	}

	function collective_sanitize_team( $input ) {
		$categories = get_terms( 'category-team', array('fields' => 'ids', 'get' => 'all') );

	   if ( in_array( $input, $categories ) ) {
	       return $input;
	   } else {
	   	return '';
	   }
	}

	function collective_sanitize_pages( $input ) {
		$pages = get_all_page_ids();

	    if ( in_array( $input, $pages ) ) {
	        return $input;
	    } else {
	    	return '';
	    }
	}

	function collective_sanitize_transition_interval( $input ) {
	    $valid = array(
	        '2000' 		=> esc_html__( '2 Seconds', 'collective' ),
	        '4000' 		=> esc_html__( '4 Seconds', 'collective' ),
	        '6000' 		=> esc_html__( '6 Seconds', 'collective' ),
	        '8000' 		=> esc_html__( '8 Seconds', 'collective' ),
	        '10000' 	=> esc_html__( '10 Seconds', 'collective' ),
	        '12000' 	=> esc_html__( '12 Seconds', 'collective' ),
	        '20000' 	=> esc_html__( '20 Seconds', 'collective' ),
	        '30000' 	=> esc_html__( '30 Seconds', 'collective' ),
	        '60000' 	=> esc_html__( '1 Minute', 'collective' ),
	        '999999999'	=> esc_html__( 'Hold Frame', 'collective' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function collective_sanitize_transition_style( $input ) {
	    $valid = array(
	        'fade' 		=> esc_html__( 'Fade', 'collective' ),
	        'slide' 	=> esc_html__( 'Slide', 'collective' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function collective_sanitize_columns( $input ) {
	    $valid = array(
	        'one' 		=> esc_html__( 'One Column', 'collective' ),
	        'two' 		=> esc_html__( 'Two Columns', 'collective' ),
	        'three' 	=> esc_html__( 'Three Columns', 'collective' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function collective_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	function collective_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}

	// Set site name and description text to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';

	// Set site title color to be previewed in real-time
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//-------------------------------------------------------------------------------------------------------------------//
	// Logo Section
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'title_tagline' , array(
		'title' 	=> esc_html__( 'Site Identity', 'collective' ),
		'description' => esc_html__( 'Logo images have a max-height of 140px.', 'collective' ),
		'priority' 	=> 1,
	) );

		// Logo uploader
		$wp_customize->add_setting( 'collective_logo', array(
			'default' 	=> get_template_directory_uri() . '/images/logo.png',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'collective_logo', array(
			'label' 	=> esc_html__( 'Logo', 'collective' ),
			'section' 	=> 'title_tagline',
			'settings'	=> 'collective_logo',
			'priority'	=> 20,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Colors Section
	//-------------------------------------------------------------------------------------------------------------------//

		// Link Color
		$wp_customize->add_setting( 'link_color', array(
	        'default' => '#009999',
	        'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
	        'label' => 'Link Color',
	        'section' => 'colors',
	        'settings' => 'link_color',
	        'priority'    => 50,
	    ) ) );

	    // Link Hover Color
	    $wp_customize->add_setting( 'link_hover_color', array(
	        'default' => '#006666',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
	        'label' => 'Link Hover Color',
	        'section' => 'colors',
	        'settings' => 'link_hover_color',
	        'priority'    => 60,
	    ) ) );

	    // Heading Link Color
	    $wp_customize->add_setting( 'heading_link_color', array(
	        'default' => '#333333',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_link_color', array(
	        'label' => 'Heading Link Color',
	        'section' => 'colors',
	        'settings' => 'heading_link_color',
	        'priority'    => 70,
	    ) ) );

	    // Heading Link Hover Color
	    $wp_customize->add_setting( 'heading_link_hover_color', array(
	        'default' => '#009999',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_link_hover_color', array(
	        'label' => 'Heading Link Hover Color',
	        'section' => 'colors',
	        'settings' => 'heading_link_hover_color',
	        'priority'    => 80,
	    ) ) );

	    // Highlight Color
	    $wp_customize->add_setting( 'highlight_color', array(
	        'default' => '#33cccc',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_color', array(
	        'label' => 'Highlight & Button Color',
	        'section' => 'colors',
	        'settings' => 'highlight_color',
	        'priority'    => 90,
	    ) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Theme Options Panel
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_panel( 'collective_theme_options', array(
	    'priority' 			=> 2,
	    'capability' 		=> 'edit_theme_options',
	    'theme_supports'	=> '',
	    'title' 			=> esc_html__( 'Theme Options', 'collective' ),
	    'description' 		=> esc_html__( 'This panel allows you to customize specific areas of the Collective Theme.', 'collective' ),
	) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Home Page Section
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'collective_home_section' , array(
		'title'     => esc_html__( 'Home Page', 'collective' ),
		'priority'  => 101,
		'panel' 	=> 'collective_theme_options',
	) );

		// Featured Page Top
		$wp_customize->add_setting( 'page_feature', array(
			'default' => '0',
			'sanitize_callback' => 'collective_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_feature', array(
			'label'		=> esc_html__( 'Featured Page Top', 'collective' ),
			'section'	=> 'collective_home_section',
			'settings'	=> 'page_feature',
			'type'		=> 'dropdown-pages',
			'priority' => 20,
		) ) );

		// Featured Team Title
		$wp_customize->add_setting( 'team_title', array(
			 'default'	=> 'My Team',
			 'sanitize_callback' => 'collective_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'team_title', array(
			'label'		=> esc_html__( 'Team Section Title', 'collective' ),
			'section'	=> 'collective_home_section',
			'settings'	=> 'team_title',
			'type'		=> 'text',
			'priority' => 40,
		) ) );

		// Featured Team Category
		$wp_customize->add_setting( 'category_team_home' , array(
			'default' => '0',
			'sanitize_callback' => 'collective_sanitize_team',
		) );
		$wp_customize->add_control( new Collective_Taxonomy_Dropdown_Control( $wp_customize, 'category_team_home', array(
			'label'		=> esc_html__( 'Featured Team Category', 'collective' ),
			'section'	=> 'collective_home_section',
			'settings'	=> 'category_team_home',
			'type'		=> 'dropdown-categories',
			'priority' => 60,
			'args' => array(
				'taxonomy' => 'category-team',
			),
		) ) );

		// Featured Team Background
		$wp_customize->add_setting( 'team_background', array(
			'default' 	=> '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'team_background', array(
			'label' 	=> esc_html__( 'Team Background Pattern', 'collective' ),
			'section' 	=> 'collective_home_section',
			'settings'	=> 'team_background',
			'priority'	=> 80,
		) ) );

		// Featured News Category
		$wp_customize->add_setting( 'category_news', array(
			'default' => '0',
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_news', array(
			'label'		=> esc_html__( 'Featured News Category', 'collective' ),
			'section'	=> 'collective_home_section',
			'settings'	=> 'category_news',
			'type'		=> 'dropdown-categories',
			'priority' => 100,
		) ) );

		// Featured News Posts Displayed
		$wp_customize->add_setting( 'postnumber_news', array(
			'default' => '3',
			'sanitize_callback' => 'collective_sanitize_text',
		) );
		$wp_customize->add_control( new Collective_Customizer_Number_Control( $wp_customize, 'postnumber_news', array(
			'label'		=> esc_html__( 'Featured News Posts Displayed', 'collective' ),
			'section'	=> 'collective_home_section',
			'settings'	=> 'postnumber_news',
			'type'		=> 'number',
			'priority' => 120,
		) ) );

		// Featured News Background
		$wp_customize->add_setting( 'news_background', array(
			'default' 	=> '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'news_background', array(
			'label' 	=> esc_html__( 'News Background Pattern', 'collective' ),
			'section' 	=> 'collective_home_section',
			'settings'	=> 'news_background',
			'priority'	=> 140,
		) ) );

		// Featured Page Bottom
		$wp_customize->add_setting( 'page_footer', array(
			'default' => '0',
			'sanitize_callback' => 'collective_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_footer', array(
			'label'		=> esc_html__( 'Featured Page Bottom', 'collective' ),
			'section'	=> 'collective_home_section',
			'settings'	=> 'page_footer',
			'type'		=> 'dropdown-pages',
			'priority' => 160,
		) ) );

		// Featured Page Bottom Background Color
		$wp_customize->add_setting( 'page_footer_bg', array(
		    'default' => '#33cccc',
		    'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_footer_bg', array(
		    'label' => 'Featured Page Bottom Background',
		    'section' => 'collective_home_section',
		    'settings' => 'page_footer_bg',
		    'priority'    => 180,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Page Templates
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'collective_templates_section' , array(
		'title'     => esc_html__( 'Page Templates', 'collective' ),
		'priority'  => 102,
		'panel' 	=> 'collective_theme_options',
	) );

		// Blog Template Category
		$wp_customize->add_setting( 'category_blog' , array(
			'default' => '0',
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_blog', array(
			'label'		=> esc_html__( 'Blog Template Category', 'collective' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'category_blog',
			'type'		=> 'dropdown-categories',
			'priority' => 40,
		) ) );

		// Blog Posts Displayed
		$wp_customize->add_setting( 'postnumber_blog', array(
			'default' => '10',
			'sanitize_callback' => 'collective_sanitize_text',
		) );
		$wp_customize->add_control( new Collective_Customizer_Number_Control( $wp_customize, 'postnumber_blog', array(
			'label'		=> esc_html__( 'Blog Posts Displayed', 'collective' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'postnumber_blog',
			'type'		=> 'number',
			'priority' => 60,
		) ) );

		// Portfolio Column Layout
		$wp_customize->add_setting( 'portfolio_columns', array(
		    'default' => 'three',
		    'sanitize_callback' => 'collective_sanitize_columns',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'portfolio_columns', array(
		    'type' => 'radio',
		    'label' => esc_html__( 'Portfolio Column Layout', 'collective' ),
		    'section' => 'collective_templates_section',
		    'choices' => array(
		        'one' 		=> esc_html__( 'One Column', 'collective' ),
		        'two' 		=> esc_html__( 'Two Columns', 'collective' ),
		        'three' 	=> esc_html__( 'Three Columns', 'collective' ),
		    ),
		    'priority' => 80,
		) ) );

		// Portfolio Template Category
		$wp_customize->add_setting( 'category_portfolio' , array(
			'default' => '0',
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_portfolio', array(
			'label'		=> esc_html__( 'Portfolio Template Category', 'collective' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'category_portfolio',
			'type'		=> 'dropdown-categories',
			'priority' => 100,
		) ) );

		// Display Portfolio Info
		$wp_customize->add_setting( 'display_portfolio_info', array(
			'default'	=> '1',
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_portfolio_info', array(
			'label'		=> esc_html__( 'Show Portfolio Title & Excerpt?', 'collective' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'display_portfolio_info',
			'type'		=> 'checkbox',
			'priority' => 120,
		) ) );

		// Slider Transition Interval
		$wp_customize->add_setting( 'transition_interval', array(
		    'default' => '8000',
		    'sanitize_callback' => 'collective_sanitize_transition_interval',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'transition_interval', array(
		    'type' => 'select',
		    'label' => esc_html__( 'Transition Interval', 'collective' ),
		    'section' => 'collective_templates_section',
		    'choices' => array(
		        '2000' 		=> esc_html__( '2 Seconds', 'collective' ),
		        '4000' 		=> esc_html__( '4 Seconds', 'collective' ),
		        '6000' 		=> esc_html__( '6 Seconds', 'collective' ),
		        '8000' 		=> esc_html__( '8 Seconds', 'collective' ),
		        '10000' 	=> esc_html__( '10 Seconds', 'collective' ),
		        '12000' 	=> esc_html__( '12 Seconds', 'collective' ),
		        '20000' 	=> esc_html__( '20 Seconds', 'collective' ),
		        '30000' 	=> esc_html__( '30 Seconds', 'collective' ),
		        '60000' 	=> esc_html__( '1 Minute', 'collective' ),
		        '999999999'	=> esc_html__( 'Hold Frame', 'collective' ),
		    ),
		    'priority' => 140,
		) ) );

		// Slider Transition Style
		$wp_customize->add_setting( 'transition_style', array(
		    'default' => 'fade',
		    'sanitize_callback' => 'collective_sanitize_transition_style',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'transition_style', array(
		    'type' => 'select',
		    'label' => esc_html__( 'Transition Style', 'collective' ),
		    'section' => 'collective_templates_section',
		    'choices' => array(
		        'fade' 		=> esc_html__( 'Fade', 'collective' ),
		        'slide' 	=> esc_html__( 'Slide', 'collective' ),
		    ),
		    'priority' => 160,
		) ) );

		// Featured Slideshow Category
		$wp_customize->add_setting( 'category_slideshow_home' , array(
			'default' => '0',
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_slideshow_home', array(
			'label'		=> esc_html__( 'Featured Slideshow Category', 'collective' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'category_slideshow_home',
			'type'		=> 'dropdown-categories',
			'priority' => 180,
		) ) );

		// Featured Slideshow Posts Displayed
		$wp_customize->add_setting( 'postnumber_slideshow_home', array(
			'default' => '10',
			'sanitize_callback' => 'collective_sanitize_text',
		) );
		$wp_customize->add_control( new Collective_Customizer_Number_Control( $wp_customize, 'postnumber_slideshow_home', array(
			'label'		=> esc_html__( 'Featured Slideshow Posts Displayed', 'collective' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'postnumber_slideshow_home',
			'type'		=> 'number',
			'priority' => 200,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Misc Settings
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'collective_layout_section' , array(
		'title'     => esc_html__( 'Misc Settings', 'collective' ),
		'priority'  => 103,
		'panel' 	=> 'collective_theme_options',
	) );

		// Display Site Title
		$wp_customize->add_setting( 'display_site_title', array(
			'default'	=> '1',
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_site_title', array(
			'label'		=> esc_html__( 'Display Site Title?', 'collective' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'display_site_title',
			'type'		=> 'checkbox',
			'priority' => 20,
		) ) );

		// Display Large Team Featured Image
		$wp_customize->add_setting( 'display_feature_team', array(
			'default'	=> '',
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_feature_team', array(
			'label'		=> esc_html__( 'Show Team Large Featured Image?', 'collective' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'display_feature_team',
			'type'		=> 'checkbox',
			'priority' => 40,
		) ) );

		// Display Post Featured Image or Video
		$wp_customize->add_setting( 'display_feature_post', array(
			'default'	=> '1',
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_feature_post', array(
			'label'		=> esc_html__( 'Show Post Featured Images?', 'collective' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'display_feature_post',
			'type'		=> 'checkbox',
			'priority' => 60,
		) ) );

	// Social Section
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'collective_social_section' , array(
		'title'       => __( 'Social Links', 'organicthemes' ),
		'priority'    => 105,
	) );

		// Display Social Share Buttons on Single Posts
		$wp_customize->add_setting( 'display_social_post', array(
			'default'	=> '1',
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_social_post', array(
			'label'		=> esc_html__( 'Show Share Buttons on Single Posts?', 'collective' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'display_social_post',
			'type'		=> 'checkbox',
			'priority' => 80,
		) ) );

		// Twitter User
		$wp_customize->add_setting( 'collective_user_twitter', array(
			 'default'	=> 'OrganicThemes',
			 'sanitize_callback' => 'collective_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'collective_user_twitter', array(
			'label'		=> esc_html__( 'Twitter User', 'collective' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'collective_user_twitter',
			'type'		=> 'text',
			'priority' => 100,
		) ) );

}
add_action('customize_register', 'collective_theme_customizer');

/**
* Binds JavaScript handlers to make Customizer preview reload changes
* asynchronously.
*/
function collective_customize_preview_js() {
	wp_enqueue_script( 'collective-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ) );
}
add_action( 'customize_preview_init', 'collective_customize_preview_js' );