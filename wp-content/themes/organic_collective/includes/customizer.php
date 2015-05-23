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
					'show_option_none'  => __( '&mdash; Select &mdash;', 'organicthemes' ),
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
					'show_option_none'  => __( '&mdash; Select &mdash;', 'organicthemes' ),
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
	        '2000' 		=> __( '2 Seconds', 'organicthemes' ),
	        '4000' 		=> __( '4 Seconds', 'organicthemes' ),
	        '6000' 		=> __( '6 Seconds', 'organicthemes' ),
	        '8000' 		=> __( '8 Seconds', 'organicthemes' ),
	        '10000' 	=> __( '10 Seconds', 'organicthemes' ),
	        '12000' 	=> __( '12 Seconds', 'organicthemes' ),
	        '20000' 	=> __( '20 Seconds', 'organicthemes' ),
	        '30000' 	=> __( '30 Seconds', 'organicthemes' ),
	        '60000' 	=> __( '1 Minute', 'organicthemes' ),
	        '999999999'	=> __( 'Hold Frame', 'organicthemes' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function collective_sanitize_transition_style( $input ) {
	    $valid = array(
	        'fade' 		=> __( 'Fade', 'organicthemes' ),
	        'slide' 	=> __( 'Slide', 'organicthemes' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function collective_sanitize_columns( $input ) {
	    $valid = array(
	        'one' 		=> __( 'One Column', 'organicthemes' ),
	        'two' 		=> __( 'Two Columns', 'organicthemes' ),
	        'three' 	=> __( 'Three Columns', 'organicthemes' ),
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
	
	$wp_customize->add_section( 'collective_logo_section' , array(
		'title' 	=> __( 'Logo', 'organicthemes' ),
		'description' => __( 'Logo images have a max-height of 140px.', 'organicthemes' ),
		'priority' 	=> 10,
	) );

		// Logo uploader
		$wp_customize->add_setting( 'collective_logo', array(
			'default' 	=> get_template_directory_uri() . '/images/logo.png',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'collective_logo', array(
			'label' 	=> __( 'Logo', 'organicthemes' ),
			'section' 	=> 'collective_logo_section',
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
	// Home Page Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'collective_home_section' , array(
		'title'       => __( 'Home Page', 'organicthemes' ),
		'priority'    => 102,
	) );
	
		// Featured Page Left
		$wp_customize->add_setting( 'page_feature', array(
			'default' => '2',
			'sanitize_callback' => 'collective_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_feature', array(
			'label'		=> __( 'Featured Page Top', 'organicthemes' ),
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
			'label'		=> __( 'Team Section Title', 'organicthemes' ),
			'section'	=> 'collective_home_section',
			'settings'	=> 'team_title',
			'type'		=> 'text',
			'priority' => 40,
		) ) );
		
		// Featured Team Category
		$wp_customize->add_setting( 'category_team_home' , array(
			'default' => '-1',
			'sanitize_callback' => 'collective_sanitize_team',
		) );
		$wp_customize->add_control( new Collective_Taxonomy_Dropdown_Control( $wp_customize, 'category_team_home', array(
			'label'		=> __( 'Featured Team Category', 'organicthemes' ),
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
			'label' 	=> __( 'Team Background Pattern', 'organicthemes' ),
			'section' 	=> 'collective_home_section',
			'settings'	=> 'team_background',
			'priority'	=> 80,
		) ) );
	
		// Featured News Category
		$wp_customize->add_setting( 'category_news', array(
			'default' => '1',
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_news', array(
			'label'		=> __( 'Featured News Category', 'organicthemes' ),
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
			'label'		=> __( 'Featured News Posts Displayed', 'organicthemes' ),
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
			'label' 	=> __( 'News Background Pattern', 'organicthemes' ),
			'section' 	=> 'collective_home_section',
			'settings'	=> 'news_background',
			'priority'	=> 140,
		) ) );
		
		// Featured Page Bottom
		$wp_customize->add_setting( 'page_footer', array(
			'default' => '2',
			'sanitize_callback' => 'collective_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_footer', array(
			'label'		=> __( 'Featured Page Bottom', 'organicthemes' ),
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
		'title'       => __( 'Page Templates', 'organicthemes' ),
		'priority'    => 103,
	) );
	
		// Team Page Category
		$wp_customize->add_setting( 'category_team_page' , array(
			'default' => '-1',
			'sanitize_callback' => 'collective_sanitize_team',
		) );
		$wp_customize->add_control( new Collective_Taxonomy_Dropdown_Control( $wp_customize, 'category_team_page', array(
			'label'		=> __( 'Team Page Category', 'organicthemes' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'category_team_page',
			'type'		=> 'dropdown-categories',
			'priority' => 20,
			'args' => array(
				'taxonomy' => 'category-team',
			),
		) ) );
		
		// Blog Template Category
		$wp_customize->add_setting( 'category_blog' , array(
			'default' => '1',
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_blog', array(
			'label'		=> __( 'Blog Template Category', 'organicthemes' ),
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
			'label'		=> __( 'Blog Posts Displayed', 'organicthemes' ),
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
		    'label' => __( 'Portfolio Column Layout', 'organicthemes' ),
		    'section' => 'collective_templates_section',
		    'choices' => array(
		        'one' 		=> __( 'One Column', 'organicthemes' ),
		        'two' 		=> __( 'Two Columns', 'organicthemes' ),
		        'three' 	=> __( 'Three Columns', 'organicthemes' ),
		    ),
		    'priority' => 80,
		) ) );
		
		// Portfolio Template Category
		$wp_customize->add_setting( 'category_portfolio' , array(
			'default' => '1',
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_portfolio', array(
			'label'		=> __( 'Portfolio Template Category', 'organicthemes' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'category_portfolio',
			'type'		=> 'dropdown-categories',
			'priority' => 100,
		) ) );
		
		// Display Portfolio Info
		$wp_customize->add_setting( 'display_portfolio_info', array(
			'default'	=> true,
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_portfolio_info', array(
			'label'		=> __( 'Show Portfolio Title & Excerpt?', 'organicthemes' ),
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
		    'label' => __( 'Transition Interval', 'organicthemes' ),
		    'section' => 'collective_templates_section',
		    'choices' => array(
		        '2000' 		=> __( '2 Seconds', 'organicthemes' ),
		        '4000' 		=> __( '4 Seconds', 'organicthemes' ),
		        '6000' 		=> __( '6 Seconds', 'organicthemes' ),
		        '8000' 		=> __( '8 Seconds', 'organicthemes' ),
		        '10000' 	=> __( '10 Seconds', 'organicthemes' ),
		        '12000' 	=> __( '12 Seconds', 'organicthemes' ),
		        '20000' 	=> __( '20 Seconds', 'organicthemes' ),
		        '30000' 	=> __( '30 Seconds', 'organicthemes' ),
		        '60000' 	=> __( '1 Minute', 'organicthemes' ),
		        '999999999'	=> __( 'Hold Frame', 'organicthemes' ),
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
		    'label' => __( 'Transition Style', 'organicthemes' ),
		    'section' => 'collective_templates_section',
		    'choices' => array(
		        'fade' 		=> __( 'Fade', 'organicthemes' ),
		        'slide' 	=> __( 'Slide', 'organicthemes' ),
		    ),
		    'priority' => 160,
		) ) );
		
		// Featured Slideshow Category
		$wp_customize->add_setting( 'category_slideshow_home' , array(
			'sanitize_callback' => 'collective_sanitize_categories',
		) );
		$wp_customize->add_control( new Collective_Category_Dropdown_Control( $wp_customize, 'category_slideshow_home', array(
			'label'		=> __( 'Featured Slideshow Category', 'organicthemes' ),
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
			'label'		=> __( 'Featured Slideshow Posts Displayed', 'organicthemes' ),
			'section'	=> 'collective_templates_section',
			'settings'	=> 'postnumber_slideshow_home',
			'type'		=> 'number',
			'priority' => 200,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Layout
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'collective_layout_section' , array(
		'title'       => __( 'Layout', 'organicthemes' ),
		'priority'    => 104,
	) );
	
		// Display Site Title
		$wp_customize->add_setting( 'display_site_title', array(
			'default'	=> true,
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_site_title', array(
			'label'		=> __( 'Display Site Title?', 'organicthemes' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'display_site_title',
			'type'		=> 'checkbox',
			'priority' => 20,
		) ) );
		
		// Display Large Team Featured Image
		$wp_customize->add_setting( 'display_feature_team', array(
			'default'	=> false,
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_feature_team', array(
			'label'		=> __( 'Show Team Large Featured Image?', 'organicthemes' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'display_feature_team',
			'type'		=> 'checkbox',
			'priority' => 40,
		) ) );
		
		// Display Post Featured Image or Video
		$wp_customize->add_setting( 'display_feature_post', array(
			'default'	=> true,
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_feature_post', array(
			'label'		=> __( 'Show Post Featured Images?', 'organicthemes' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'display_feature_post',
			'type'		=> 'checkbox',
			'priority' => 60,
		) ) );
		
		// Enable CSS3 Full Width Background
		$wp_customize->add_setting( 'background_stretch', array(
			'default'	=> true,
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'background_stretch', array(
			'label'		=> __( 'Enable Full Width Background Image?', 'organicthemes' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'background_stretch',
			'type'		=> 'checkbox',
			'priority' => 80,
		) ) );
		
		// Enable Responsive Grid
		$wp_customize->add_setting( 'enable_responsive', array(
			'default'	=> true,
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_responsive', array(
			'label'		=> __( 'Enable Responsive Grid?', 'organicthemes' ),
			'section'	=> 'collective_layout_section',
			'settings'	=> 'enable_responsive',
			'type'		=> 'checkbox',
			'priority' => 100,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Social Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'collective_social_section' , array(
		'title'       => __( 'Social Links', 'organicthemes' ),
		'priority'    => 105,
	) );
		
		// Display Social Share Buttons on Single Posts
		$wp_customize->add_setting( 'display_social_post', array(
			'default'	=> true,
			'sanitize_callback' => 'collective_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_social_post', array(
			'label'		=> __( 'Show Share Buttons on Single Posts?', 'organicthemes' ),
			'section'	=> 'collective_social_section',
			'settings'	=> 'display_social_post',
			'type'		=> 'checkbox',
			'priority' => 20,
		) ) );
		
		// Twitter User
		$wp_customize->add_setting( 'collective_user_twitter', array(
			 'default'	=> 'OrganicThemes', 
			 'sanitize_callback' => 'collective_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'collective_user_twitter', array(
			'label'		=> __( 'Twitter User', 'organicthemes' ),
			'section'	=> 'collective_social_section',
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